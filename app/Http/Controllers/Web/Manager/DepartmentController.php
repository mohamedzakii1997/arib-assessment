<?php

namespace App\Http\Controllers\Web\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Repositories\EmployeeRepository;
use App\Resources\DepartmentResource;
use App\Resources\UserResource;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{


    private $department_service;


    public function __construct(DepartmentService $department_service)
    {
        $this->department_service = $department_service;

    }


    public function index(PaginationRequest $request)
    {
       // Session::forget('dept_error');
        $response  = $this->department_service->index();
        $result = $response->getData(true);
        $depts = $result['data'];
        return view('manager.departments.index', compact('depts'));

    }

    public function create(Request $request)
    {

        $users =  User::doesntHave('managedDepartment')->where('department_id',null)->get();
        $free_managers = UserResource::collection($users);

        return view('manager.departments.create', compact('free_managers'));


    }

    public function store(DepartmentRequest $request)
    {

        $response  = $this->department_service->store($request);
        $result = $response->getData(true);
        $department = $result['data'];
        return redirect()->route('department.index');
    }


    public function show($id)
    {
        $response  = $this->department_service->show($id);
        $result = $response->getData(true);
        $dept = $result['data'];
        $users =  User::doesntHave('managedDepartment')->where('department_id',null)->get();
        $free_managers = UserResource::collection($users);
        return view('manager.departments.show', compact('dept','free_managers'));
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        $response  = $this->department_service->update($id,$request);
        $result = $response->getData(true);
        $dept = $result['data'];
        return redirect()->route('department.index');
    }

    public function destroy($id)
    {
        $response  = $this->department_service->delete($id);
        $result = $response->getData(true);

        if ($result['status'] == 422){
            Session::flash('dept_error',$result['message']);
        }

        return redirect()->route('department.index');
    }
}
