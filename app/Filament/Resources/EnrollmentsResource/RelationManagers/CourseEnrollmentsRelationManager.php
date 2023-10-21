<?php

namespace App\Filament\Resources\EnrollmentsResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\GenderEnum;
use App\Enums\StatusEnum;
use Filament\Tables\Table;
use App\Enums\PaymentStatusEnum;
use Faker\Provider\ar_EG\Payment;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CourseEnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'courseEnrollments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('course_id')->relationship('course','title'),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                TextInput::make('unit_price'),
                Select::make('status')->options([
                    StatusEnum::NEW->value=>'New',
                    StatusEnum::ONGOING->value=>'Ongoing',
                    StatusEnum::COMPLETED->value=>'Completed',
                    StatusEnum::DECLINED->value=>'Declined',
                ]),
                Select::make('payment_status')->options([
                    PaymentStatusEnum::UNPAID->value=>'Unpaid',
                    PaymentStatusEnum::PAID->value=>'paid',
                    PaymentStatusEnum::REFUND->value=>'Refund',
                    PaymentStatusEnum::PARTIAL->value=>'Partial'
                ]),
                TextInput::make('paid_amount'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Enrolled Courses')
            ->columns([
                Tables\Columns\TextColumn::make('course.title'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('payment_status')->label('Payment Status'),
                Tables\Columns\TextColumn::make('paid_amount')->label('Payed'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
