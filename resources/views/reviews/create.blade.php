@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Formulir Review Buku</div>
            <div class="card-body">
                <form action="{{ route('reviews.store') }}" method="post">
                    @csrf
                    <!-- Dropdown Buku -->
                    <div class="mb-3 row">
                        <label for="book_id" class="col-md-4 col-form-label text-md-end text-start">Pilih Buku</label>
                        <div class="col-md-6">
                            <select class="form-control @error('book_id') is-invalid @enderror" id="book_id" name="book_id">
                                <option value="">-- Pilih Buku --</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>{{ $book->judul }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('book_id'))
                                <span class="text-danger">{{ $errors->first('book_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Text Area Review -->
                    <div class="mb-3 row">
                        <label for="review_text" class="col-md-4 col-form-label text-md-end text-start">Tulis Review</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('review_text') is-invalid @enderror" id="review_text" name="review_text" rows="5">{{ old('review_text') }}</textarea>
                            @if ($errors->has('review_text'))
                                <span class="text-danger">{{ $errors->first('review_text') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Multiple Input Tags -->
                    <div class="mb-3 row">
                        <label for="tags" class="col-md-4 col-form-label text-md-end text-start">Tags</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" placeholder="Pisahkan tag dengan koma (,)">
                            @if ($errors->has('tags'))
                                <span class="text-danger">{{ $errors->first('tags') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Simpan Review">
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
