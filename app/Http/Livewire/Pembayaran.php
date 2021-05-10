<?php

namespace App\Http\Livewire;

use App\Models\Keranjang;
use Livewire\Component;

class Pembayaran extends Component
{
    public $snapToken;
    public $keranjang;
    public $vaNumber, $grossAmount, $bank, $transactionStatus, $transactionTime, $deadline;

    public function mount($id)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'YOUR_API_KEY_SERVER';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        if (isset($_GET['resultData'])) {
            $currentStatus           = json_decode($_GET['resultData'], true);
            $orderId                 = $currentStatus['order_id'];
            $this->keranjang         = Keranjang::where('id', $orderId)->first();
            $this->keranjang->status = 2;
            $this->keranjang->update();
        } else {
            $this->keranjang = Keranjang::findOrFail($id);
        }

        if (!empty($this->keranjang)) {
            if ($this->keranjang->status == 1) {
                $params = array(
                    'transaction_details' => array(
                        'order_id'     => $this->keranjang->id,
                        'gross_amount' => $this->keranjang->total_harga,
                    ),
                    'customer_details' => array(
                        'first_name' => 'Kpd. Saudara/i...',
                        'last_name'  => auth()->user()->name,
                        'email'      => auth()->user()->email,
                        'phone'      => '08123456789',
                    ),
                );
                $this->snapToken = \Midtrans\Snap::getSnapToken($params);
            } elseif ($this->keranjang->status == 2) {
                $status = \Midtrans\Transaction::status($this->keranjang->id);
                $status = json_decode(json_encode($status), true);

                $this->vaNumber          = $status['va_numbers'][0]['va_number'];
                $this->grossAmount       = $status['gross_amount'];
                $this->bank              = $status['va_numbers'][0]['bank'];
                $this->transactionStatus = $status['transaction_status'];
                $transactionTime         = $status['transaction_time'];
                $this->deadline          = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transactionTime)));
            }
        }
    }

    public function render()
    {
        return view('livewire.pembayaran')
            ->extends('layouts.master')->section('content');
    }
}
