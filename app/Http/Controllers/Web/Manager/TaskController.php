<?php

namespace App\Http\Controllers\Web\Manager;

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

    public function create($employee_id)
    {

        return view('manager.tasks.create', compact('employee_id'));

    }


    public function store(TaskRequest $request)
    {
        $response  = $this->task_service->store($request);
        $result = $response->getData(true);
        $task = $result['data'];
        return redirect()->route('employee.index');

    }


}
