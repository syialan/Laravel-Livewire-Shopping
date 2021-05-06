<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use Livewire\Component;

class Homepage extends Component
{
    public $produk = [];
    public $pencarian;

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
