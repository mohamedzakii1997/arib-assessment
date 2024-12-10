<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


class DepartmentResource extends JsonResource
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
            'name'=>$this->name,
            'manager_name'=>$this->manager?$this->manager->full_name:'No Manager',
            'employees_count' => $this->employees->count(),
            'sum_of_salaries' => $this->employees->sum('salary'),

        ];
    }
}
