<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Toko Buku</title>
</head>
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
    <table class="table table-secondary table-hover table-striped">
        <thead>
            <tr>
                <th class="ps-5 text-center">Nomor</th>
                <th class="text-center">Judul Buku</th>
                <th class="text-center">Penulis</th>
                <th class="pe-5 text-center">Harga</th>
                <th class="text-center">Tanggal Terbit</th>
                <th class="pe-5 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @php
        @endphp
        @foreach($data_buku as $index => $buku)
            <tr>
                <td class="ps-5 text-center">{{$buku->id}}</td>
                <td class="text-center">{{ $buku->judul }}</td>
                <td class="text-center">{{ $buku->penulis }}</td>
                <td class="text-center">{{ "Rp ".number_format($buku->harga, 0, ',', '.') }}</td>
                <td class="text-center">{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                <td class="pe-5 text-center">
                    <form action="{{route('buku.destroy',$buku->id)}}" method="POST">
                        @csrf
                        <a class="btn btn-primary" href="{{route('buku.edit', $buku->id)}}" >Edit</a>
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>{{$data_buku->links('pagination::bootstrap-5')}}</div>
    <a href="{{route('buku.create')}}" class="btn btn-primary float-end">Tambah Buku</a>
    @if(count($data_buku))
        <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive">
            Ditemukan <strong>{{ count($data_buku) }}</strong> data dengan kata: <strong>{{ $cari }}</strong>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h5>Data "{{ $cari }}" tidak ditemukan</h5>
            <a href="/buku" class="btn btn-warning">Kembali</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</body>
</html>