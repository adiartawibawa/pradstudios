<?php

namespace App\Filament\Clusters\Content\Resources\InsightResource\Pages;

use App\Filament\Clusters\Content\Resources\InsightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInsights extends ListRecords
{
    protected static string $resource = InsightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
