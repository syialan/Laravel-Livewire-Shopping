<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $fillable = [
        'user_id', 
        'produk_id', 
        'total_harga', 
        'status',
    ];

    public function produks()
    {
        return $this->belongsTo(Produk::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
