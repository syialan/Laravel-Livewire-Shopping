<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TambahProduk extends Component
{
    use WithFileUploads;

    public $nama_produk, $harga, $berat, $gambar;

    public function mount()
    {
        if (auth()->user()->level !== 1) {
            return redirect()->to('');
        }
    }

    public function tambahProduk()
    {
        $this->validate([
            'nama_produk' => 'required',
            'harga'       => 'required',
            'berat'       => 'required',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $namaGambar = time() . '.' . $this->gambar->extension();
        Storage::disk('public')->putFileAs('photos', $this->gambar, $namaGambar);


        Produk::create([
            'nama_produk' => $this->nama_produk,
            'harga'       => $this->harga,
            'berat'       => $this->berat,
            'gambar'      => $namaGambar,
        ]);

        return redirect()->to('');
    }

    public function render()
    {
        return view('livewire.tambah-produk')
            ->extends('layouts.master')->section('content');
    }
}
