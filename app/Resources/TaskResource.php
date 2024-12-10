<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {


        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'status'=>$this->status,
            'manager_name'=>$this->manager?$this->manager->full_name:'No Manager',
            'employee_name' => $this->employee?$this->employee->full_name:'No Employee',
        ];
    }
}
