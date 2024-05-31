<?php

namespace App\Filament\User\Resources\EmployeeResource\Pages;

use App\Filament\User\Resources\EmployeeResource;
use App\Models\EmployeeLeave;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;

class LeavesEmployee extends Page implements HasTable
{
    use InteractsWithRecord;
    use InteractsWithTable;

    protected static string $resource = EmployeeResource::class;

    protected static string $view = 'filament.user.resources.employee-resource.pages.leaves';

    protected static ?string $navigationIcon = 'heroicon-c-exclamation-circle';

    public function mount(int | string $record)
    {
        $this->record = $this->resolveRecord($record);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Apply Leaves')
                    ->schema([
                        DatePicker::make('start_date')->required()->format('d/m/Y'),
                        DatePicker::make('end_date')->required()->format('d/m/Y'),
                        TextInput::make('duration')->required(),
                        Textarea::make('purpose')->required(),
                    ])
                    ->columns(2)             
                ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(EmployeeLeave::where('employee_id',$this->record->id)->orderBy('id','DESC'))
            ->columns([
                TextColumn::make('start_date')->label('Start Date'),
                TextColumn::make('end_date')->label('End Date'),
                TextColumn::make('duration')->label('Duration'),
                TextColumn::make('purpose')->label('Purpose'),

            ]);
    }


}