<div class="container">
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="{{ request()->is('/') ? 'active' : '' }}">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="{{ request()->is('keranjang') ? 'active' : '' }}">
                            <a href="{{ url('keranjang') }}">Keranjang</a>
                        </li>
                        @if (auth()->user())
                        @if (auth()->user()->level == 1)
                        <li class="{{ request()->is('tambah-produk') ? 'active' : '' }}">
                            <a href="{{ url('tambah-produk') }}">Tambah Produk</a>
                        </li>
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page title area -->


    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <table cellspacing="0" class="shop_table cart">
                            <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">Foto </th>
                                    <th class="product-created_at">Tanggal</th>
                                    <th class="product-name">Nama Produk</th>
                                    <th class="product-price">Harga</th>
                                    <th class="product-quantity">Berat</th>
                                    <th class="product-subtotal">Total Harga</th>
                                    <th class="product-aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($keranjang as $k)
                                <tr class="cart_item">
                                    <td class="product-remove">
                                        <button class="btn btn-danger btn-block"
                                            wire:click="destroy({{ $k->id }})">x</button>
                                    </td>
                                    <td class="product-thumbnail">
                                        @php
                                        $produk = \App\Models\Produk::where('id', $k->produk_id)->first();
                                        @endphp
                                        <img width="145" height="145" alt="poster_1_up" class="shop_thumbnail"
                                            src="{{ asset('storage/photos/'.$produk->gambar) }}">
                                    </td>
                                    <td class="product-name">
                                        <h5>{{ date('Y-m-d', strtotime($k->created_at)) }}</h5>
                                    </td>
                                    <td class="product-name">
                                        <h5>{{ $produk->nama_produk }}</h5>
                                    </td>

                                    <td class="product-price">
                                        <span class="amount">Rp. {{ number_format($produk->harga) }}</span>
                                    </td>

                                    <td class="product-quantity">
                                        <span class="amount">{{ $produk->berat }} Kg</span>
                                    </td>

                                    <td class="product-subtotal">
                                        <span class="amount">Rp. {{ number_format($k->total_harga) }}</span>
                                    </td>
                                    <td class="actions">
                                        @if ($k->status == 0)
                                        <a href="{{ url('ongkos-kirim/'. $k->id) }}"
                                            class="btn btn-warning">Checkout</a>
                                        @elseif($k->status == 1)
                                        <a href="{{ url('pembayaran/'. $k->id) }}"
                                            class="btn btn-primary">Pembayaran</a>
                                        @else
                                        <a href="{{ url('pembayaran/'. $k->id) }}" class="btn btn-primary">Lihat
                                            Status</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="justify-content center">Belum Ada Isinya</div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>