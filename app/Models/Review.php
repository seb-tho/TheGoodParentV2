<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    public function advice(): BelongsTo
    {
        return $this->belongsTo(Advice::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
