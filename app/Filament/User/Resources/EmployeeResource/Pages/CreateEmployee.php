<?php

namespace App\Filament\User\Resources\EmployeeResource\Pages;

use App\Filament\User\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
}
