<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {


        $data = [];

        if ($this->role == 'employee')
        {
            $data['tasks'] = TaskResource::collection($this->tasks);

        }

        return [
            'id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'department_id'=>$this->department_id,
            'full_name'=>$this->full_name,
            'salary'=>$this->salary,
            'role'=>$this->role,
            'image'=>$this->image ? url(Storage::url($this->image)) : null,
            'manager_name'=>$this->department?$this->department->manager->full_name:'No Manager',

        ] + $data;
    }
}
