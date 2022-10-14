<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function characterTraits(): BelongsToMany
    {
        return $this->belongsToMany(CharacterTrait::class)->withPivot('traitLevel');
    }

    public function advices(): BelongsToMany
    {
        return $this->belongsToMany(Advice::class);
    }
}
