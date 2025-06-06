<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'image_url',
        'event_url',
        'is_featured',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
        'is_featured' => 'boolean', // Ensure this is present and set to boolean
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
