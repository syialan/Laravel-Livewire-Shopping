<?php

namespace App\Http\Livewire;

use App\Models\Keranjang;
use Livewire\Component;

class KeranjangUser extends Component
{
    public $keranjang = [];

    public function destroy($pesananId)
    {
        $pesanan = Keranjang::findOrFail($pesananId);
        $pesanan->delete();
    }

    public function render()
    {
        $this->keranjang = Keranjang::where('user_id', auth()->user()->id)->get();

        return view('livewire.keranjang-user')
            ->extends('layouts.master')->section('content');
    }
}
