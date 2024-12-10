<?php

namespace App\Services;


use App\Repositories\DepartmentRepository;

use App\Repositories\TaskRepository;
use App\Resources\DepartmentResource;
use App\Resources\TaskResource;
use App\Resources\UserResource;
use App\Traits\ApiResponses;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




class TaskService extends LaravelServiceClass
{
    use ApiResponses;
    private $task_repo;


    public function __construct(TaskRepository $task_repo)
    {
        $this->task_repo = $task_repo;

    }

    public function index()
    {
        $conditions = ['employee_id'=>auth()->user()->id];
        if (request('is_pagination')) {
            list($items, $pagination) = parent::paginate($this->task_repo, false,$conditions);
        } else {
            $items = parent::list($this->task_repo, false,$conditions);
            $pagination = null;
        }

        $items->load(['manager','employee']);

        return $this->ok('tasks list',TaskResource::collection($items),$pagination);

    }

    public function store($request = null)
    {
        return    DB::transaction(function() use($request) {

            $validatedData = $request->validated();


            $task = $this->task_repo->create($validatedData + ['manager_id'=>auth()->user()->id]);



            $task->load(['manager','employee']);

            return $this->ok('task created',TaskResource::make($task));
        });

    }

    public function show($id)
    {


        $item = $this->task_repo->get($id);

        $item = TaskResource::make($item);
        return $this->ok('task display',$item);
    }

    public function update($id, $request = null)
    {

        return    DB::transaction(function() use($request, $id) {

            $validatedData = $request->validated();


            $task = $this->task_repo->update($id, $validatedData);

            $task->load(['manager','employee']);

            return $this->ok('task updated',TaskResource::make($task));
        });
    }






}
