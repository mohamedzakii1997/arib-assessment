<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\UpdateEmployeeRequest;

use App\Http\Requests\UpdateTaskRequest;
use App\Services\DepartmentService;
use App\Services\TaskService;


class EmployeeTaskController extends Controller
{


    private $task_service;

    public function __construct(TaskService $task_service)
    {
        $this->task_service = $task_service;

    }


    public function index(PaginationRequest $request)
    {

        $response  = $this->task_service->index();
        $result = $response->getData(true);
        $tasks = $result['data'];
        return view('employee.tasks.index', compact('tasks'));

    }

    public function show($id)
    {
        $response  = $this->task_service->show($id);
        $result = $response->getData(true);
        $task = $result['data'];
        return view('employee.tasks.show', compact('task'));
    }



    public function update(UpdateTaskRequest $request, $id)
    {
        $response  = $this->task_service->update($id, $request);
        $result = $response->getData(true);
        $task = $result['data'];
        return redirect()->route('employee.task.index');
    }

}
