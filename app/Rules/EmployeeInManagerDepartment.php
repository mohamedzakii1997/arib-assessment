<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class EmployeeInManagerDepartment implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // Get the logged-in manager's department ID
        $user = User::find(auth()->user()->id);
        $managerDepartment = $user->managedDepartment?$user->managedDepartment->id:null;

        // Check if the employee belongs to the same department
        $employee = User::find($value);

        if (!$employee || $employee->department_id !== $managerDepartment) {
            $fail("The selected employee does not belong to your department.");
        }

    }
}
