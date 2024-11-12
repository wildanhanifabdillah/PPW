<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    protected $primaryKey = 'id';
    protected $table ='galeri';
    protected $fillable=['id','nama_galeri','path','foto','books_id'];
    public function books():BelongsTo{
        return $this->belongsTo(Buku::class, 'books_id', 'id');
    }
}
