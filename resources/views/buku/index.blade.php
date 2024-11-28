@extends('auth.layouts')

@section('content')
<body class="bg-light">
    @if(Session::has('pesanSimpan'))
        <div class="alert alert-success">{{Session::get('pesanSimpan')}}</div>
    @else
    @if(Session::has('pesanHapus'))
        <div class="alert alert-danger">{{Session::get('pesanHapus')}}</div>
    @else
        
    @endif
    @endif
    <h1 class="text-center pt-2 pb-3 text-dark fs-2 fw-bold">Daftar Buku yang Tersedia</h1>
    <form action="{{ route('buku.search') }}" method="get">
        @csrf
        <div class="input-group mb-3" style="float: right; width: 30%;">
            <input type="text" name="kata" class="form-control" placeholder="Cari ..." aria-label="Search">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
    <form method="get" id="tagForm">
        @csrf
        <div class="input-group mb-3" style="float: right; width: 30%; margin-top: 10px;">
            <input type="text" name="tag" class="form-control" placeholder="Cari berdasarkan tag..." aria-label="Search by Tag" id="tag">
            <button class="btn btn-outline-secondary" type="submit">Search by Tag</button>
        </div>
    </form>
    <script>
        // Menambahkan tag yang diketikkan ke dalam URL
        document.getElementById('tagForm').addEventListener('submit', function (event) {
            const tagValue = document.getElementById('tag').value.trim(); // Ambil nilai tag
            if (tagValue) {
                this.action = '/tag/' + tagValue; // Ganti action form dengan URL yang sesuai
            } else {
                event.preventDefault(); // Jika tag kosong, jangan submit form
                alert('Silakan masukkan tag yang valid');
            }
        });
    </script>
    
    <form method="get" id="reviewerForm">
        @csrf
        <div class="input-group mb-3" style="float: right; width: 30%; margin-top: 10px;">
            <input type="text" name="reviewer" class="form-control" placeholder="Cari berdasarkan reviewer..." aria-label="Search by Reviewer" id="reviewer">
            <button class="btn btn-outline-secondary" type="submit">Search by Reviewer</button>
        </div>
    </form>
    
    <script>
        document.getElementById('reviewerForm').addEventListener('submit', function (event) {
            const reviewerValue = document.getElementById('reviewer').value.trim();
            if (reviewerValue) {
                this.action = '/reviewer/' + reviewerValue;
            } else {
                event.preventDefault();
                alert('Silakan masukkan nama reviewer yang valid');
            }
        });
    </script>
    
    
    <table class="table table-secondary table-hover table-striped">
        <thead>
            <tr>
                <th class="ps-5 text-center">Nomor</th>
                <th class="text-center">Cover</th>
                <th class="text-center">Judul Buku</th>
                <th class="text-center">Penulis</th>
                <th class="pe-5 text-center">Harga</th>
                <th class="text-center">Tanggal Terbit</th>
                @if (Auth::user()->level=='admin')
                    <th class="pe-5 text-center">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @php
        @endphp
        @foreach($data_buku as $index => $buku)
            <tr>
                <td class="ps-5 text-center">{{$buku->id}}</td>
                <td class="relative h-10 w-10">
                    <img class = "h-full w-full rounded-full object-cover object-center" src="{{asset($buku->filepath)}}" alt=""/>
                </td>
                <td class="text-center">{{ $buku->judul }}</td>
                <td class="text-center">{{ $buku->penulis }}</td>
                <td class="text-center">{{ "Rp ".number_format($buku->harga, 0, ',', '.') }}</td>
                <td class="text-center">{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                @if (Auth::user()->level=='admin')
                    <td class="pe-5 text-center">
                        <form action="{{route('buku.destroy',$buku->id)}}" method="POST">
                            @csrf
                            <a class="btn btn-primary" href="{{route('buku.edit', $buku->id)}}" >Edit</a>
                            @method('DELETE')
                            <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-end pe-5"><b>Total Banyaknya Buku :</b> {{ $jumlah_buku }}</td>
            </tr>
            <tr>
                <td colspan="7" class="text-end pe-5"><b>Total Harga Buku :</b> {{"Rp ".number_format($total_harga, 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    <div>{{$data_buku->links('pagination::bootstrap-5')}}</div>
    @if (Auth::user()->level=='admin')
        <a href="{{route('buku.create')}}" class="btn btn-primary float-end">Tambah Buku</a>
    @endif
    @if (Auth::user()->level=='admin'|| Auth::user()->level == 'internal_reviewer')
        <a href="{{route('reviews.create')}}" class="btn btn-primary float-end">Buat Review</a>
    @endif
</body>
@endsection