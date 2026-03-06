<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'url', 'github', 'tags', 'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(ProjectFile::class);
    }
}
