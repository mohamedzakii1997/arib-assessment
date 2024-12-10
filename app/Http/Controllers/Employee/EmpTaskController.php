<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\UpdateEmployeeRequest;

use App\Http\Requests\UpdateTaskRequest;
use App\Services\DepartmentService;
use App\Services\TaskService;


class EmpTaskController extends Controller
{


    private $task_service;

    public function __construct(TaskService $task_service)
    {
        $this->task_service = $task_service;

    }


    public function index(PaginationRequest $request)
    {
        return $this->task_service->index();
    }


    public function show($id)
    {
        return $this->task_service->show($id);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        return $this->task_service->update($id, $request);
    }

}
