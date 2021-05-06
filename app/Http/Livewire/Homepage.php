<?php

namespace App\Http\Livewire;

use App\Models\Keranjang;
use App\Models\Produk;
use Livewire\Component;

class Homepage extends Component
{
    public $produk = [];
    public $pencarian;
    public $keranjang;

    public function mount() {
        $this->keranjang = Keranjang::where('user_id', auth()->user()->id)->count();
    }

    public function keranjang($id)
    {
        $produk = Produk::findOrFail($id);

        Keranjang::create([
            'user_id' => auth()->user()->id,
            'produk_id' => $produk->id,
            'total_harga' => $produk->harga,
            'status' => 0,
        ]);

        return redirect()->to('keranjang');
    }

    public function render()
    {

        if ($this->pencarian) {
            $this->produk = Produk::where('nama_produk', 'like', '%' . $this->pencarian . '%')
                ->get();
        } else {
            $this->produk = Produk::get();
        }


        return view('livewire.homepage')
            ->extends('layouts.master')->section('content');
    }
}
