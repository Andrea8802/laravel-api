<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'cash_out'
    ];

    public function genres()
    {
        return $this->BelongsTo(Genre::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}