<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = ['id', 'judul', 'penulis', 'harga', 'tgl_terbit','created_at','update_at','update_at','filename','filepath'];
    protected $casts = [
        'tgl_terbit'=>'date'
    ];
    protected $dates = ['tgl_terbit'];

    public function galleries():HasMany{
        return $this->hasMany(Gallery::class, 'books_id','id');
    }
}
