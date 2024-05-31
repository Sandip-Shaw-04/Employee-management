<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Enums\Department;
use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected static bool $canCreateAnother = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Employee Details')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('designation')
                                ->required()
                                ->maxLength(255),
                            DatePicker::make('doj')
                                ->label('Date Of Joining')
                                ->required(),
                            TextInput::make('company_name')
                                ->maxLength(255),
                            Select::make('department')
                                ->options(Department::class)->required(),
                            Select::make('gender')
                                ->options([
                                    'Male' => 'Male',
                                    'Female' => 'Female',
                                ])->required(),
                            FileUpload::make('image')
                                ->label('Photo')
                                ->image()
                                ->required(),
                        ]),
                    Wizard\Step::make('Employee Address')
                        ->schema([
                            Section::make('Address')
                                ->relationship('employeeDetail')
                                ->schema([
                                    TextInput::make('address_1')
                                    ->required()
                                    ->maxLength(255),
                                    TextInput::make('address_2')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('contact_no')
                                        ->required()
                                        ->maxLength(10),
                                    TextInput::make('alt_contact_no')
                                        ->label('Alternative Number')
                                        ->required()
                                        ->maxLength(10),
                                    TextInput::make('pincode')
                                        ->required()
                                        ->maxLength(6),
                                    TextInput::make('email')
                                        ->required()
                                        ->maxLength(100),
                                    ])->columns(2),
                            ]),
                    Wizard\Step::make('Salary Structure')
                        ->schema([
                            Section::make('Salary')
                            ->relationship('employeeSalary')
                            ->schema([
                                TextInput::make('basic_salary')
                                    ->label('Basic Salary')
                                    ->required()
                                    ->maxLength(20),
                                TextInput::make('ta')
                                    ->label('T.A')
                                    ->maxLength(15),
                                TextInput::make('da')
                                    ->label('D.A')
                                    ->maxLength(10),
                                TextInput::make('med')
                                    ->label('Mediclaim')
                                    ->maxLength(10),
                                TextInput::make('pf')
                                    ->label('PF')
                                    ->maxLength(10),
                                TextInput::make('others')
                                    ->label('Others Allowance')
                                    ->maxLength(10),
                                TextInput::make('gross_salary')
                                    ->label('Gross Salary')
                                    ->required()
                                    ->maxLength(10),
                                TextInput::make('net_salary')
                                    ->label('Net Salary')
                                    ->required()
                                    ->maxLength(10),
                            ])->columns(2),    
                        ]),
                ])->columns(2)->columnSpan(2)
                ->submitAction(new HtmlString(Blade::render(<<<BLADE
                        <x-filament::button
                            type="submit"
                            size="sm"
                        >
                            Submit
                        </x-filament::button>
                    BLADE))),
               
            ]);
    }
}
