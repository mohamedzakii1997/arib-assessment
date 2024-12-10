<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\UpdateEmployeeRequest;

use App\Services\DepartmentService;


class DepartmentController extends Controller
{


    private $department_service;

    public function __construct(DepartmentService $department_service)
    {
        $this->department_service = $department_service;

    }


    public function index(PaginationRequest $request)
    {
        return $this->department_service->index();
    }

    public function store(DepartmentRequest $request)
    {
        return $this->department_service->store($request);
    }


    public function show($id)
    {
        return $this->department_service->show($id);
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        return $this->department_service->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->department_service->delete($id);
    }
}
