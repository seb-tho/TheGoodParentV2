<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CharacterTrait extends Model
{
    use HasFactory;

//    protected $guarded = [];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)->withPivot('traitLevel');
    }

    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class)->withPivot('traitLevel');
    }
}
