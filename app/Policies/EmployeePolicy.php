<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;

class EmployeePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User | Admin $user, Employee $employee)
    {
        if($user instanceof Admin){
            return true;
        }
        
        return $user->employee_id === $employee->id;
    }
}
