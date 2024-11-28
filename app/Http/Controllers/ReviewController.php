<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create()
    {
        $books = Buku::all();
        return view('reviews.create', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'review_text' => 'required|min:5|max:500',
            'tags' => 'required|string',
        ]);
        
        // Pisahkan tags dengan koma, bersihkan spasi, dan hilangkan duplikasi
        $tagsArray = array_unique(array_map('trim', explode(',', $validated['tags'])));
        
        // Simpan review
        Review::create([
            'book_id' => $validated['book_id'],
            'user_id' => Auth::id(),
            'review_text' => $validated['review_text'],
            'tags' => $tagsArray,
        ]);
        return redirect()->route('reviews.create')->with('success', 'Review berhasil disimpan.');
    }

        // Menampilkan review berdasarkan reviewer
        public function byReviewer($username)
        {
            $user = User::where('name', $username)->firstOrFail();
            $reviews = Review::with('book')
            ->where('user_id', $user->id)
            ->paginate(10);
    
            return view('reviews.byReviewer', compact('user', 'reviews'));
        }
    
        // Menampilkan review berdasarkan tag
        public function byTag($tag)
        {
            $reviews = Review::with('book')
                ->whereJsonContains('tags', $tag)
                ->paginate(10);
    
            return view('reviews.byTag', compact('tag', 'reviews'));
        }
}
