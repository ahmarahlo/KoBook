<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookRental extends Model
{
    protected $table = 'book_rental';

    protected $fillable = [
        'book_id',
        'user_id',
        'borrow_date',
        'return_date',
        'actual_return_date',
        'status',
        'fine',
    ];

    protected $casts = [
        'borrow_date' => 'datetime',
        'return_date' => 'datetime',
        'actual_return_date' => 'datetime',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
