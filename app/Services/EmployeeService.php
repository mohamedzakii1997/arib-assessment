<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\EmployeeRepository;
use App\Resources\UserResource;
use App\Traits\ApiResponses;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;


class EmployeeService extends LaravelServiceClass
{
    use ApiResponses;
    private $employee_repo;


    public function __construct(EmployeeRepository $employee_repo)
    {
        $this->employee_repo = $employee_repo;

    }

    public function index($web = null)
    {
        if (!request()->has('get_free_managers') && request()->get_free_managers == 1 )
        $conditions = ['department_id'=>auth()->user()->managedDepartment->id];
        elseif ($web)
            $conditions = ['department_id'=>auth()->user()->managedDepartment->id];
        else
            $conditions = [];

        if (request('is_pagination')) {
            list($items, $pagination) = parent::paginate($this->employee_repo, false,$conditions);
        } else {
            $items = parent::list($this->employee_repo, false,$conditions);
            $pagination = null;
        }

        $items->load(['department.manager']);

        return $this->ok('employees list',UserResource::collection($items),$pagination);

    }

    public function store($request = null)
    {
        return    DB::transaction(function() use($request) {

            $validatedData = $request->validated();
            $validatedDataWithoutFile = Arr::except($validatedData, ['image']);

            if (isset($validatedData['department_id']) && $validatedData['department_id'] != null && $validatedData['role'] == 'manager'){
                $validatedDataWithoutFile = Arr::except($validatedData, ['department_id']);
            }

            $emp = $this->employee_repo->create($validatedDataWithoutFile);



            if(isset($request->image)) {
                $this->handleUploadMainImage($request->image, $emp->id);
            }


            $emp->load(['department.manager']);

            return $this->ok('employee created',UserResource::make($emp));
        });

    }

    public function show($id)
    {

        $conditions = ['department_id'=>auth()->user()->managedDepartment->id];
        $item = $this->employee_repo->get($id, $conditions, 'id', ['department.manager']);

        $item = UserResource::make($item);
        return $this->ok('employee display',$item);
    }

    public function update($id, $request = null)
    {
       // dd($request->all());
        return    DB::transaction(function() use($request, $id) {

            $validatedData = $request->validated();
            $validatedDataWithoutFile = Arr::except($validatedData, ['image']);

            if (isset($validatedData['department_id']) && $validatedData['department_id'] != null && $validatedData['role'] == 'manager'){
                $validatedDataWithoutFile = Arr::except($validatedData, ['department_id']);
            }

            $emp = $this->employee_repo->update($id, $validatedDataWithoutFile);

            if(isset($request->image)) {

                if ($emp->image != null){
                    $this->removeImageFromStorage($emp);
                }

                $this->handleUploadMainImage($request->image, $emp->id);
            }



            $emp->load(['department.manager']);

            return $this->ok('employee updated',UserResource::make($emp));
        });
    }



    public function delete($id)
    {
        try {
            $this->employee_repo->delete($id);
            return $this->ok('employee deleted');
        }
        catch (CannotDeleteProductException $exception) {
            Log::error($exception);
            return $this->error($exception->getMessage(),200);

        }
    }




    protected function removeImageFromStorage($old_model)
    {
        if(\Storage::disk('public')->exists($old_model->image))
        {
            unset($old_model->image);
            $old_model->image = null ;
            $old_model->save();
        }

    }



    protected function handleUploadMainImage($image,$emp_id)
    {
        $imagePath = $image->store('users', 'public');
        $emp = $this->employee_repo->get($emp_id);
        $emp->image = $imagePath ;
        $emp->save();

    }



}
