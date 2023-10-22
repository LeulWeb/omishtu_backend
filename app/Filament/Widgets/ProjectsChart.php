<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class ProjectsChart extends ChartWidget
{
    protected static ?string $heading = 'Projects';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = $this->getProjectsPerMonth();
        return [
            "datasets"=>[
                [
                    "label"=>"Projects",
                    "data"=>$data['projectsPerMonth'],
                ] 
            ],
             "labels"=>$data['months']

        ];
    }

    protected function getType(): string
    {
        return 'line';
    }



    // functions for getting the projects per month
    private function getProjectsPerMonth(): array{
        $now = Carbon::now();
        $projectsPerMonth = [];
        $months = collect(range(1,12))->map(function($month) use($now, $projectsPerMonth){
            $count = Project::whereMonth('created_at', Carbon::parse($now->month($month)->format('Y-m')))->count();

            $projectsPerMonth[] = $count;

            return $now->month($month)->format("M");
        })->toArray();

        return [
            'projectsPerMonth'=>$projectsPerMonth,
            'months'=>$months
        ];
    }

}
