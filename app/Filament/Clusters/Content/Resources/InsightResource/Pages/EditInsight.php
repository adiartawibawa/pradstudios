<?php

namespace App\Filament\Clusters\Content\Resources\InsightResource\Pages;

use App\Filament\Clusters\Content\Resources\InsightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInsight extends EditRecord
{
    protected static string $resource = InsightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
