<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
       return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('id',Auth::user()->employee_id))
            ->columns([
                ImageColumn::make('image')->label('Photo'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('designation')
                    ->searchable(),
                TextColumn::make('doj')
                    ->date()
                    ->sortable(),            
                TextColumn::make('department')
                    ->badge()
                    ->searchable(),
                TextColumn::make('gender')
                    ->searchable(),  
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewEmployee::class,
            Pages\Attandence::class,
            Pages\LeavesEmployee::class,
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

   

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'leave' => Pages\LeavesEmployee::route('/{record}/leave'),
            'attandence' => Pages\Attandence::route('/{record}/attandence')
        ];
    }
}
