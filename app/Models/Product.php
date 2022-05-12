<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah',
        'judul_buku',
        'harga',
        'penerbit',
        'penulis',
        'tahun_terbit',
        'gambar'
    ];
}
