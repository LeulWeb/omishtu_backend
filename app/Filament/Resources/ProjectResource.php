<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\ProjectResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProjectResource\RelationManagers;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;


class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    /*
                'title',
'slug',
'summary',
'image',
'description',
'is_top',
'label',
'link',
    
    */

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                

                Group::make()->schema([
                    Section::make()->schema([
                        TextInput::make('title')
                    ->required()
                    ->live(true)
                    ->unique(ignoreRecord: true)
                    ->afterStateUpdated(function(string $operation, $state, Forms\Set $set){
                        if($operation != 'create'){
                            return ;
                        }
                        $set('slug', Str::slug($state));
                    }),
                    // Make slug 
                    TextInput::make('slug')->disabled()->dehydrated()->required()->unique(Project::class, 'slug', ignoreRecord: true),
    
                    // summary
                    Textarea::make('summary'),
                    RichEditor::make('description'),
                    ])
                ]),

                Group::make()->schema([
                    Section::make('')->schema([
                        //Description
                 FileUpload::make('image')->disk('public')->directory('project')->imageEditor(),
                     TextInput::make('link')->url(),
                 Toggle::make('is_top')->label('Top project')->default(false),
                 CheckboxList::make('label')
                 ->options([
                     'AI' => 'Artificial Intelligence',
                     'management' => 'Management System',
                     'ecommerce' => 'Ecommerce',
                     'customer_engagement' => 'Customer Engagement & Relationship',
                     'data_analysis' => 'Data Analysis',
                     'automation_control' => 'Automation & Control',
                 ])->columns(2)
                ]),
             
                
               
                ]),
                 
               


                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->circular(),
                TextColumn::make('title')->searchable()->sortable(),
                IconColumn::make('is_top')->boolean(),
                TextColumn::make('link'),
                CheckboxColumn::make('label')

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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }    
}
