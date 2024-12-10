<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\UpdateEmployeeRequest;

use App\Services\DepartmentService;
use App\Services\TaskService;


class TaskController extends Controller
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

    public function store(TaskRequest $request)
    {
        return $this->task_service->store($request);
    }


}
