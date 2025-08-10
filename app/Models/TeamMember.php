<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'position',
        'department',
        'bio',
        'image_url',
        'social_links',
        'sort_order',
        'is_active'
    ];

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
