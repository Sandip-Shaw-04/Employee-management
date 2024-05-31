<?php

namespace App\Filament\User\Resources\EmployeeResource\Pages;

use App\Filament\User\Resources\EmployeeResource;
use App\Models\Attandence as ModelsAttandence;
use App\Models\Employee;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Attandence extends Page implements HasTable
{
    use InteractsWithRecord;
    use InteractsWithTable;

    protected static string $resource = EmployeeResource::class;

    protected static string $view = 'filament.user.resources.employee-resource.pages.attandence';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public function mount(int | string $record)
    {
        $this->record = $this->resolveRecord($record);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ModelsAttandence::where('employee_id',$this->record->id)->orderBy('id','DESC'))
            ->columns([
                TextColumn::make('start_date')->label('Start Date'),
                TextColumn::make('end_date')->label('End Date'),
                TextColumn::make('duration')->label('Duration'),
            ]);
    }
}
