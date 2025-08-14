<?php

namespace App\Filament\Clusters\Contact\Resources\ContactSubmissionResource\Pages;

use App\Filament\Clusters\Contact\Resources\ContactSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageContactSubmissions extends ManageRecords
{
    protected static string $resource = ContactSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
