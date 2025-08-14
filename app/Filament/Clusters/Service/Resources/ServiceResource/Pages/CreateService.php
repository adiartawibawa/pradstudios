<?php

namespace App\Filament\Clusters\Service\Resources\ServiceResource\Pages;

use App\Filament\Clusters\Service\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;
}
