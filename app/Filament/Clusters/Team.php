<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Team extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Users';
}
