<?php

namespace App\Filament\Clusters\Team\Resources\TeamMemberResource\Pages;

use App\Filament\Clusters\Team\Resources\TeamMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTeamMember extends CreateRecord
{
    protected static string $resource = TeamMemberResource::class;
}
