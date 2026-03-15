<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'category',
        'stock',
        'cover',
    ];

    public function rentals()
    {
        return $this->hasMany(BookRental::class);
    }
}
