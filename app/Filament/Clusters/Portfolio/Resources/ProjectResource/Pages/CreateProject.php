<?php

namespace App\Filament\Clusters\Portfolio\Resources\ProjectResource\Pages;

use App\Filament\Clusters\Portfolio\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
}
