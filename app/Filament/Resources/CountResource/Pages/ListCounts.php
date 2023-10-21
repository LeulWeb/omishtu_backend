<?php

namespace App\Filament\Resources\CountResource\Pages;

use App\Filament\Resources\CountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCounts extends ListRecords
{
    protected static string $resource = CountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
