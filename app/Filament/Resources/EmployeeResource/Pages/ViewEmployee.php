<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Employee Information')
                        ->schema([
                            TextEntry::make('name')->label('Name'),
                            TextEntry::make('designation')->label('Designation'),
                            TextEntry::make('doj')->label('Date of Joining'),
                            TextEntry::make('company_name')->label('Comapany Name'),
                            TextEntry::make('department')->label('Department')->badge(),
                            TextEntry::make('gender')->label('Gender')->badge(),
                            ImageEntry::make('image')->label('Photo')->width(200)->height(200),
                        ])->columns(3),

                Section::make('Employee Details')
                        ->schema([
                            TextEntry::make('employeeDetail.address_1')->label('Address 1'),
                            TextEntry::make('employeeDetail.address_2')->label('Address 2')->default('N/A'),
                            TextEntry::make('employeeDetail.pincode')->label('Pincode'),
                            TextEntry::make('employeeDetail.contact_no')->label('Contact No'),
                            TextEntry::make('employeeDetail.alt_contact_no')->label('Alternative No')->default('N/A'),
                            TextEntry::make('employeeDetail.email')->label('Email'),

                        ])->columns(3),

                Section::make('Employee Details')
                        ->schema([
                            TextEntry::make('employeeSalary.basic_salary')->label('Address 1'),
                            TextEntry::make('employeeSalary.ta')->label('T.A')->default('N/A'),
                            TextEntry::make('employeeSalary.da')->label('D.A')->default('N/A'),
                            TextEntry::make('employeeSalary.med')->label('Mediclaim')->default('N/A'),
                            TextEntry::make('employeeSalary.pf')->label('PF')->default('N/A')->default('N/A'),
                            TextEntry::make('employeeSalary.others')->label('Others Allowance')->default('N/A'),
                            TextEntry::make('employeeSalary.gross_salary')->label('Gross Salary'),
                            TextEntry::make('employeeSalary.net_salary')->label('Net Salary'),


                        ])->columns(3),
                ]);
    }
}