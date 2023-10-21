<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Course;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CourseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Filament\Resources\CourseResource\RelationManagers\ChaptersRelationManager;
use Filament\Tables\Columns\ImageColumn;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected  static ?string $navigationGroup = 'Training';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form

    /*
      'title',
'description',
'image',
'students',
'lessons',
'projects',
'days',
'is_visible',
'icons',

     * */


    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Course')->schema([
                        Forms\Components\TextInput::make('title')->required()->unique('courses', 'title'),
                        Forms\Components\RichEditor::make('description'),
                        Forms\Components\FileUpload::make('image')->disk('public')->directory('course')->imageEditor(),

                    ])
                ]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Course')->schema([
                        Forms\Components\TextInput::make('students')->numeric()->helperText('Number of enrolled students'),
                        Forms\Components\TextInput::make('lessons')->numeric()->helperText('Number of lessons in the course'),
                        Forms\Components\TextInput::make('projects')->numeric()->helperText('Number of projects, in the course'),
                        Forms\Components\TextInput::make('days')->numeric()->helperText('Duration of the course in a days'),
                        Forms\Components\Toggle::make('is_visible')->default(true),
                    ])->columns(2),

                    Forms\Components\Section::make()->schema([
                        Forms\Components\FileUpload::make('icons')->disk('public')->directory('icons')->multiple()->imageEditor()
                    ])

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable(),
                TextColumn::make('students'),
                TextColumn::make('lessons'),
                TextColumn::make('projects'),
                TextColumn::make('days'),
                ImageColumn::make('icons')->circular()->stacked(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->slideOver(),
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
            ChaptersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
