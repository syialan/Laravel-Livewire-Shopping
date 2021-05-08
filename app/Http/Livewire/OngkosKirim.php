<?php

namespace App\Http\Livewire;

use App\Models\Keranjang;
use App\Models\Produk;
use Livewire\Component;

use Kavist\RajaOngkir\Facades\RajaOngkir;

class OngkosKirim extends Component
{
    public $keranjang;
    public $provinsiId, $kotaId, $jasa, $daftarProvinsi, $daftarKota, $namaJasa;
    public $result = [];

    public function mount($id)
    {
        $this->keranjang = Keranjang::findOrFail($id);
    }

    public function getOngkir()
    {
        if (!$this->provinsiId || !$this->kotaId || !$this->jasa) {
            return;
        }

        $produk = Produk::findOrFail($this->keranjang->produk_id);

        $cost = RajaOngkir::ongkosKirim([
            'origin' => 455, // ID kota/kabupaten asal
            'destination' => $this->kotaId, // ID kota/kabupaten tujuan
            'weight' => $produk->berat, // berat barang dalam gram
            'courier' => $this->jasa, // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        $this->namaJasa = $cost[0]['name'];

        foreach ($cost[0]['costs'] as $row) {
            $this->result[] = [
                'description' => $row['description'],
                'biaya'       => $row['cost'][0]['value'],
                'etd'         => $row['cost'][0]['etd'],
            ];
        }
    }

    public function saveOngkir($biayaPengiriman) {
        $this->keranjang->total_harga += $biayaPengiriman;
        $this->keranjang->status       = 1;
        $this->keranjang->update();

        return redirect()->to('keranjang');
    }

    public function render()
    {
        $rajaOngkir           = RajaOngkir::provinsi()->all();
        $this->daftarProvinsi = $rajaOngkir;

        if ($this->provinsiId) {
            $this->daftarKota = RajaOngkir::kota()->dariProvinsi($this->provinsiId)->get();
        }

        return view('livewire.ongkos-kirim')
            ->extends('layouts.master')->section('content');
    }
}
