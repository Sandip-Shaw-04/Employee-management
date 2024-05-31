<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employeeDetail(): HasOne
    {
        return $this->hasOne(EmployeeDetail::class);
    }

    public function employeeSalary(): HasOne
    {
        return $this->hasOne(EmployeeSalaryStructure::class);
    }

    public function attandences(): HasMany
    {
        return $this->hasMany(Attandence::class);
    }
}
