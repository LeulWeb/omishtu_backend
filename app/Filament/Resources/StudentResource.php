<?php

namespace App\Filament\Resources;

use App\Enums\GenderEnum;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PHPUnit\Metadata\Group;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Training';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('full_name')->label('Full Name')->required(),
                        Forms\Components\TextInput::make('phone')->label('Phone Number')->required()->unique('students','email'),
                        Forms\Components\TextInput::make('email')->label('Email')->email()->required(),
                        Forms\Components\Radio::make('gender')->label('Gender')->options([
                            GenderEnum::MALE->value=>'Male',
                            GenderEnum::FEMALE->value=>'Female'
                        ])->inline()
                    ]),

                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('occupation')->label('Occupation')->required(),
                        Forms\Components\TextInput::make('education')->label('Education')->required(),
                    ]),

                ]),

                //Second columns
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Profile')->schema([
                        Forms\Components\FileUpload::make('profile')->disk('public')->directory('students_profile')->image()->imageEditor(),
                    ]),


                    Forms\Components\Section::make('Address')->schema([
                        Forms\Components\TextInput::make('city')->required(),
                        Forms\Components\TextInput::make('sub_city')->required(),
                        Forms\Components\TextInput::make('wereda')->required(),

                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile')->disk('public')->circular(),
                Tables\Columns\TextColumn::make('full_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
