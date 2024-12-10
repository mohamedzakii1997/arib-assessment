<?php

namespace App\Http\Requests;

use App\Rules\EmployeeInManagerDepartment;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|string|max:255',
            'description'=>'required|string|max:255',
            'employee_id' => [
                'required',
                'integer',
                'exists:users,id',
                new EmployeeInManagerDepartment(),
            ],

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }




}
