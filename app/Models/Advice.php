<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Advice extends Model
{
    use HasFactory;

    public function lifeEvents(): belongsToMany
    {
        return $this->belongsToMany(LifeEvent::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
