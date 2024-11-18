<?php

namespace App\Http\Controllers\Api;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;

class BookApiController extends Controller
{
    public function index(){
        $books = Buku::latest()->paginate(5);

        return new BookResource(true, 'List Data Buku', $books);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|integer',
            'tgl_terbit' => 'required|date',
            'filename' => 'nullable|string|max:255',
            'filepath' => 'nullable|string|max:255',
        ]);
    
        $book = Buku::create($validatedData);
    
        return new BookResource(true, 'Buku berhasil ditambahkan', $book);
    }
}
