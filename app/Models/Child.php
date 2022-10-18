<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Child extends Model
{
    use HasFactory;

    public function characterTraits(): BelongsToMany
    {
        return $this->belongsToMany(CharacterTrait::class)->withPivot('traitLevel');
    }

    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function events(): belongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
