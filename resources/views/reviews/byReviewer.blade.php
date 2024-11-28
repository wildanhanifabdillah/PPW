@extends('auth.layouts')

@section('content')
<body class="bg-light">
    @if(Session::has('pesanSimpan'))
        <div class="alert alert-success">{{Session::get('pesanSimpan')}}</div>
    @elseif(Session::has('pesanHapus'))
        <div class="alert alert-danger">{{Session::get('pesanHapus')}}</div>
    @endif

    <h1 class="text-center pt-2 pb-3 text-dark fs-2 fw-bold">Daftar Buku yang Direview oleh {{ $user->name }}</h1>
    
    <table class="table table-secondary table-hover table-striped">
        <thead>
            <tr>
                <th class="ps-5 text-center">Nomor</th>
                <th class="text-center">Cover</th>
                <th class="text-center">Judul Buku</th>
                <th class="text-center">Penulis</th>
                <th class="text-center">Tanggal Terbit</th>
                <th class="text-center">Review</th>
            </tr>
        </thead>
        <tbody>
        @foreach($reviews as $review)
            <tr>
                <td class="ps-5 text-center">{{ $review->book->id }}</td>
                <td class="text-center">
                    <img class="h-full w-full rounded-full object-cover object-center" src="{{ asset($review->book->filepath) }}" alt=""/>
                </td>
                <td class="text-center">{{ $review->book->judul }}</td>
                <td class="text-center">{{ $review->book->penulis }}</td>
                <td class="text-center">{{ $review->book->tgl_terbit->format('d/m/Y') }}</td>
                <td class="text-center">{{ $review-> review_text }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div>{{ $reviews->links('pagination::bootstrap-5') }}</div>
</body>
@endsection
