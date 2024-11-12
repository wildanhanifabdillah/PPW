<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function search(Request $request){
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul','like',"%".$cari."%")->orwhere('penulis','like',"%".$cari."%")->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage()-1);
        return view('buku.search', compact('jumlah_buku', 'data_buku', 'no', 'cari'));
    }
    public function index(){
        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id','asc')->paginate($batas);
        $no= $batas*($data_buku->currentPage()-1);
        // $data_buku = Buku::all()->sortBy('judul');
        // $jumlah_buku = $data_buku->count();
        $total_harga = $data_buku->sum('harga');
        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga', 'no'));
    }

    public function create(){
        return view('buku.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'thumbnail'=>'image|mimes:jpeg,jpg,png|max:2048',
            'judul'=>'required|string',
            'penulis'=>'required|string|max:30',
            'harga'=>'required|numeric',
            'tgl_terbit'=>'required|date'
        ]);

        $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uploads',$fileName,'public');

        Image::make(storage_path().'/app/public/uploads/'.$fileName)
            ->fit(240,320)
            ->save();
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->filename = $fileName;
        $buku->filepath = '/storage/'.$filePath;
        $buku->save();

        if($request->file('gallery')){
            foreach($request->file('gallery')as$key=>$file){
                $fileName=time().'_'.$file->getClientOriginalName();
                $filePath=$file->storeAs('uploads',$fileName,'public');
                $gallery = Gallery::create([
                    'nama_galeri'=> $fileName,
                    'path'       => '/storage/'.$filePath,
                    'foto'       => $fileName,
                    'books_id'   => $buku->id
                ]);
            }
        }
        return redirect('/buku')->with('pesanSimpan','Data Buku Berhasil disimpan ya kak');
    }
    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesanHapus','Data Buku Berhasil dihapus ya kak');
    }

    public function edit($id){
        $buku = Buku::find($id);
        return view('buku.edit',compact('buku'));
    }
    public function update(Request $request,$id){
        $buku = Buku::find($id);

        $request->validate([
            'thumbnail'=>'image|mimes:jpeg,jpg,png|max:2048'
        ]);
        $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uploads',$fileName,'public');

        Image::make(storage_path().'/app/public/uploads/'.$fileName)
            ->fit(240,320)
            ->save();

        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->filename = $fileName;
        $buku->filepath = '/storage/'.$filePath;
        $buku->save();

        if($request->file('gallery')){
            foreach($request->file('gallery')as$key=>$file){
                $fileName=time().'_'.$file->getClientOriginalName();
                $filePath=$file->storeAs('uploads',$fileName,'public');
                $gallery = Gallery::create([
                    'nama_galeri'=> $fileName,
                    'path'       => '/storage/'.$filePath,
                    'foto'       => $fileName,
                    'books_id'   => $id
                ]);
            }
        }
        
        return redirect('/buku')->with('pesanSimpan','Data Buku Berhasil disimpan ya kak');
    }
    public function deleteGalleryImage(Buku $buku, Gallery $gallery){
        if ($gallery->books_id !== $buku->id) {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan untuk buku ini.');
        }
        $storagePath = str_replace('/storage/', 'public/', $gallery->path);
        if (Storage::exists($storagePath)) {
            Storage::delete($storagePath);
        }
        $gallery->delete();
        return redirect()->route('buku.edit', $buku->id)->with('pesanHapus', 'Gambar berhasil dihapus.');
    }
}