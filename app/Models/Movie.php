<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'genre', 'duration', 'cover'];

    // Additional properties for the model
    protected $casts = [
        'duration' => 'integer', // Cast 'duration' to integer
    ];

    // Constructor
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['cover'] = 'https://fastly.picsum.photos/id/247/300/200.jpg'; // Set a default for cover image
    }

}
