<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'page',
        'key',
        'title',
        'subtitle',
        'content',
        'extra',
        'sort_order',
        'is_active'
    ];

    protected function casts(): array
    {
        return [
            'extra' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
