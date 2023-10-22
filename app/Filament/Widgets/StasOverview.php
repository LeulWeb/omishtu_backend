<?php

namespace App\Filament\Widgets;

use App\Models\Count;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StasOverview extends BaseWidget
{
    protected static ?string $pollingInterval= '15s';
    protected static ?bool $islazy = true;
    protected static ?int $sort = 2;


    protected function getStats(): array
    {
        return [
            Stat::make('Clients', Count::where('year',date('Y'))->value('customers'))
            ->description('Total clients in '.date('Y'))
            ->descriptionIcon('heroicon-o-briefcase')
            ->chart(Count::pluck('customers')->toArray()),
            Stat::make('Projects', Count::where('year',date('Y'))->value('projects'))
            ->description('Total projects in '.date('Y'))
            ->descriptionIcon('heroicon-o-briefcase')
            ->chart(Count::pluck('projects')->toArray()),
            Stat::make('Students', Count::where('year',date('Y'))->value('students'))
            ->description('Total students in '.date('Y'))
            ->descriptionIcon('heroicon-o-briefcase')
            ->chart(Count::pluck('students')->toArray()),
            Stat::make('Staffs', Count::where('year',date('Y'))->value('students'))
            ->description('Total staffs in '.date('Y'))
            ->descriptionIcon('heroicon-o-briefcase')
            ->chart(Count::pluck('staff')->toArray()),
        ];
    }
}
