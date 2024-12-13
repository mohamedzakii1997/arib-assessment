<?php

namespace App\Http\Controllers\Web\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Repositories\EmployeeRepository;
use App\Resources\DepartmentResource;
use App\Resources\UserResource;
use App\Services\EmployeeService;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmployeeController extends Controller
{


    private $employee_service;

    public function __construct(EmployeeService $employee_service)
    {
        $this->employee_service = $employee_service;

    }


    public function index(PaginationRequest $request)
    {
        $response  = $this->employee_service->index($web=1);
        $result = $response->getData(true);
        $employees = $result['data'];
        return view('manager.employees.index', compact('employees'));

    }

    public function create()
    {

        $depts= DepartmentResource::collection(Department::all());
        return view('manager.employees.create', compact('depts'));


    }

    public function store(EmployeeRequest $request)
    {

        $response  = $this->employee_service->store($request);
        $result = $response->getData(true);
        $employee = $result['data'];
        return redirect()->route('employee.index');
    }


    public function show($id)
    {
        $response  = $this->employee_service->show($id);
        $result = $response->getData(true);
        $employee = $result['data'];
        $depts= DepartmentResource::collection(Department::all());
        return view('manager.employees.show', compact('employee','depts'));
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $response  = $this->employee_service->update($id,$request);
        $result = $response->getData(true);
        $employee = $result['data'];
       return redirect()->route('employee.index');
    }

    public function destroy($id)
    {
        $response  = $this->employee_service->delete($id);
        $result = $response->getData(true);

        return redirect()->route('employee.index');
    }
}
