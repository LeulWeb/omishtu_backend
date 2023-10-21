<?php

namespace App\Filament\Resources\CountResource\Pages;

use App\Filament\Resources\CountResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCount extends CreateRecord
{
    protected static string $resource = CountResource::class;
}
