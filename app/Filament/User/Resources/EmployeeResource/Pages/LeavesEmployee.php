<?php

namespace App\Filament\User\Resources\EmployeeResource\Pages;

use App\Enums\LeaveStatus;
use App\Filament\User\Resources\EmployeeResource;
use App\Models\EmployeeLeave;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Gate;

class LeavesEmployee extends Page implements HasTable
{
    use InteractsWithRecord;
    use InteractsWithTable;

    protected static string $resource = EmployeeResource::class;

    protected static string $view = 'filament.user.resources.employee-resource.pages.leaves';

    protected static ?string $navigationIcon = 'heroicon-c-exclamation-circle';

    public string $start_date = '';
    public string $end_date = '';
    public string $duration = '';
    public string $purpose = '';


    protected $rules = [
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'duration' => 'required|numeric',
        'purpose' => 'required|string|max:191',
    ];

    public function mount(int | string $record)
    {
        $this->record = $this->resolveRecord($record);
    }


    public static function canAccess(array $parameters = []): bool
    {
        return Gate::allows('canPerform', $parameters["record"]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Apply')
                    ->schema([
                        DatePicker::make('start_date')->required(),
                        DatePicker::make('end_date')->required()->afterOrEqual('start_date'),
                        TextInput::make('duration')->required()->rules(['numeric']),
                        Textarea::make('purpose')->required(),
                    ])
                    ->columns(2)             
                ]);
    }

   

    public function submit(): void
    {
        EmployeeLeave::create([
            'employee_id' => $this->getRecord()->id,
            'start_date' => $this->form->getState()['start_date'],
            'end_date' => $this->form->getState()['end_date'],
            'duration' => $this->form->getState()['duration'],
            'purpose' => $this->form->getState()['purpose'],
            'status' => LeaveStatus::NOT_APPROVED,
        ]);

        $this->start_date = '';
        $this->end_date = '';
        $this->duration = '';
        $this->purpose = '';
    
        $this->dispatch('leave-created'); 
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
                TextColumn::make('status')->label('Approved Status')->badge(),
            ])
            ->actions([
                DeleteAction::make($this->record)
            ]);
    }


}