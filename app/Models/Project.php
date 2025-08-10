<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'description',
        'image_url',
        'category',
        'client_name',
        'project_date',
        'project_url',
        'case_study_url',
        'app_store_url',
        'play_store_url',
        'video_url',
        'sort_order',
        'is_featured',
        'is_published'
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'project_date' => 'date',
            'sort_order' => 'integer',
        ];
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'project_technology');
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function insights()
    {
        return $this->hasMany(Insight::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
