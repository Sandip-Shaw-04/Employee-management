<?php

namespace App\Policies;

use App\Enums\LeaveStatus;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployeePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User | Admin $user, Employee $employee): bool
    {
        if($user instanceof Admin){
            return true;
        }
        
        return $user->employee_id === $employee->id;
    }

    public function canPerform(User | Admin $user,Employee $employee)
    {
        if(! $this->view($user,$employee)){
            return false;
        }

        return Auth::user()->id === $employee->user_id;
    }

    public function canDeleteLeave(User | Admin $user,Employee $employee)
    {
        if(! $this->canPerform($user,$employee)){
            return false;
        }

        return $employee->employeeLeaves->contains(function ($leave) {
            //dump($leave->status === LeaveStatus::APPROVED);
            return $leave->status === LeaveStatus::APPROVED;
        });
    }
}
