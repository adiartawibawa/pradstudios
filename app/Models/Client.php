<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'logo_url',
        'website_url',
        'industry',
        'description',
        'project_id',
        'sort_order',
        'is_featured',
        'is_active'
    ];

    protected function casts(): array
    {
        return  [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
