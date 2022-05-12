<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        // ini buat nampilin cart
        $data = DB::table('carts')
            ->select('carts.*', 'users.name', 'products.*', 'carts.id as idcart')
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->get();

        $cart = Cart::where('user_id', auth()->user()->id)->get();

        return view('cart.index', compact('data', 'cart'));
    }

    public function simpan(Request $request)
    {
        if (Auth::check()) {
            # jika sudah login maka proses
            $produk = Product::find($request->product_id);
            $kurang = $produk->jumlah - 1;
            $produk->update(['jumlah' => $kurang]);
            if ($produk->jumlah <= 0) {
                # jika jumlah produk sudah 0, maka habis
                return redirect()->route('listbuku')->with('salah', 'produk sudah habis');
            } else {
                # jika produk masih ada, maka bisa ditambah ke keranjang
                Cart::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $request->product_id
                ]);
            }

            return redirect()->route('listbuku')->with('success', 'buku dimasukan ke keranjang');
        } else {
            # jika belum login maka proses login
            return redirect()->route('login');
        }
    }

    public function destroy($id)
    {
        $check = Cart::find($id);
        if (empty($check)) {
            # jika data kosong atau id salah maka
            return redirect()->route('lihatcart')->with('salah', 'product tidak ada pada data');
        } else {
            # jika product id ada maka
            // dd($check->product_id);
            $produk = Product::find($check->product_id);
            $kurang = $produk->jumlah + 1;
            $produk->update(['jumlah' => $kurang]);
            $check->delete();
            return redirect()->route('lihatcart')->with('success', 'Item dihapus dari keranjang');
        }
    }
}
