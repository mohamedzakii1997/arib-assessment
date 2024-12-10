<?php

namespace App\Services;


use App\Repositories\DepartmentRepository;

use App\Resources\DepartmentResource;
use App\Resources\UserResource;
use App\Traits\ApiResponses;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




class DepartmentService extends LaravelServiceClass
{
    use ApiResponses;
    private $department_repo;


    public function __construct(DepartmentRepository $department_repo)
    {
        $this->department_repo = $department_repo;

    }

    public function index()
    {

        if (request('is_pagination')) {
            list($items, $pagination) = parent::paginate($this->department_repo, false);
        } else {
            $items = parent::list($this->department_repo, false);
            $pagination = null;
        }

        $items->load(['manager','employees']);

        return $this->ok('departments list',DepartmentResource::collection($items),$pagination);

    }

    public function store($request = null)
    {
        return    DB::transaction(function() use($request) {

            $validatedData = $request->validated();


            $dept = $this->department_repo->create($validatedData);



            $dept->load(['manager','employees']);

            return $this->ok('department created',DepartmentResource::make($dept));
        });

    }

    public function show($id)
    {


        $item = $this->department_repo->get($id);

        $item = DepartmentResource::make($item);
        return $this->ok('department display',$item);
    }

    public function update($id, $request = null)
    {

        return    DB::transaction(function() use($request, $id) {

            $validatedData = $request->validated();


            $emp = $this->department_repo->update($id, $validatedData);





            $emp->load(['manager','employees']);

            return $this->ok('department updated',DepartmentResource::make($emp));
        });
    }



    public function delete($id)
    {
        try {

            $item = $this->department_repo->get($id);
            if ($item->employees->count() > 0){
                return $this->error('you can not delete this dept as it has employees ! ',422);
            }else{
                $this->department_repo->delete($id);
                return $this->ok('department deleted');

            }

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
