<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        if (Auth::check()) {
            # jika sudah login maka
            $cart = Cart::where('user_id', auth()->user()->id)->get();
            return view('product.index', compact('data', 'cart'));
        } else {
            # code...
            return view('product.index', compact('data'));
        }
        
    }

    public function create()
    {
        return view('product.create');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required|unique:products',
            'penerbit' => 'required',
            'penulis' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:500',
            'tahun_terbit' => 'required',
            'gambar' => 'required|image|mimes:jpg,png'
        ]);

        $file = $request->file('gambar');
        $filename = time() .'.' . $file->getClientOriginalExtension();
        $file->move(public_path('Image'), $filename);

        // Product::create($request->all());

        Product::create([
            'judul_buku' => $request->judul_buku,
            'penerbit' => $request->penerbit,
            'penulis' => $request->penulis,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'tahun_terbit' => $request->tahun_terbit,
            'gambar' => $filename
        ]);

        return redirect()->route('listbuku')->with('success', 'buku berhasil di tambahkan');
    }
}
