<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Count;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CountResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CountResource\RelationManagers;

class CountResource extends Resource
{
    protected static ?string $model = Count::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    /*
        'customers',
'projects',
'students',
'courses',
'staff'
    
    */

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               TextInput::make('year')->rules(['numeric',Rule::in(range(date('Y') - 100, date('Y'))),]),
               TextInput::make('customers')->helperText('clients'),
               TextInput::make('projects')->helperText('websites and application built'),
               TextInput::make('students')->helperText('students that took training'),
               TextInput::make('staff')->helperText('employees and interns'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
                TextColumn::make('year'),
                TextColumn::make('customers'),
                TextColumn::make('projects'),
                TextColumn::make('students'),
                TextColumn::make('staff'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCounts::route('/'),
            'create' => Pages\CreateCount::route('/create'),
            'edit' => Pages\EditCount::route('/{record}/edit'),
        ];
    }    
}
