<?php

namespace App\Filament\Widgets;

use App\Enums\StatusEnum;
use App\Models\CourseEnrollment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StudentsChart extends ChartWidget
{
    protected static ?string $heading = 'Enrollment';

    protected static ?int $sort = 3;


    protected function getData(): array
    {

        $data = CourseEnrollment::select('status', DB::raw('count(*) as count'))->groupBy('status')->pluck('count','status')
        ->toArray();

        return [
            'datasets'=>[
                [
                    'label'=>'Enrollments',
                    'data'=> array_values($data)
                ]
                ],
                'labels'=>StatusEnum::cases()
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
