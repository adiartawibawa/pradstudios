<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'is_published'
    ];

    protected function casts(): array
    {
        return [
            'seo_keywords' => 'array',
            'is_published' => 'boolean',
        ];
    }
}
