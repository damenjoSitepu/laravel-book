<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name',
        'isbn',
        'released_at', 
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'released_at' => 'datetime',
    ];

    protected  $appends = [
        'formatted_released_at',
    ];

    /**
     * Get the formatted released_at date.
     *
     * @return string|NULL
     */
    public function getFormattedReleasedAtAttribute(): ?string
    {
        return $this->released_at ? $this->released_at->format('Y-m-d') : NULL;
    }
}
