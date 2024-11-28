<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Polyfill\Intl\Idn\Idn;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'book_id', 'user_id', 'review_text', 'tags', 'review_date', 'created_at', 'updated_at'];
    protected $casts = [
        'tags' => 'array',
    ];
    public function user()
    {
    return $this->belongsTo(User::class, 'user_id');
    }
    public function book(): BelongsTo
    {
    return $this->belongsTo(Buku::class, 'book_id', 'id');
    }
}
