<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'icon'
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_technology');
    }
}
