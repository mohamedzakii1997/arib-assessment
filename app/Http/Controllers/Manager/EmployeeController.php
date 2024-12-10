<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Repositories\EmployeeRepository;
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
        return $this->employee_service->index();
    }

    public function store(EmployeeRequest $request)
    {
        return $this->employee_service->store($request);
    }


    public function show($id)
    {
        return $this->employee_service->show($id);
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        return $this->employee_service->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->employee_service->delete($id);
    }
}
