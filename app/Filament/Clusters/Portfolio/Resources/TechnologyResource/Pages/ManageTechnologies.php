<?php

namespace App\Filament\Clusters\Portfolio\Resources\TechnologyResource\Pages;

use App\Filament\Clusters\Portfolio\Resources\TechnologyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTechnologies extends ManageRecords
{
    protected static string $resource = TechnologyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
