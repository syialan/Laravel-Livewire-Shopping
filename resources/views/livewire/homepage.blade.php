<div class="container">
    <div class="site-branding-area mb-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1>
                            LaraWire - Shopping
                        </h1>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="{{ url('keranjang') }}">Keranjang<i class="fa fa-shopping-cart"></i> <span
                                class="product-count">{{ $keranjang }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End site branding area -->
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
    <div class="single-product-area">
        <div class="container">
            <div class="row">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Cari Produk</h2>
                    <form action="#">
                        <input type="text" wire:model="pencarian" placeholder="Mulailah Mencari Produk...">
                    </form>
                </div>
                @forelse ($produk as $p)
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="{{ asset('storage/photos/'.$p->gambar) }}" alt="">
                        </div>
                        <h2><a href="">{{ $p->nama_produk }}</a></h2>
                        <div class="product-carousel-price">
                            <ins>Rp. {{ number_format($p->harga) }}</ins> <ins>Berat : {{ $p->berat }} Kg</ins>
                        </div>

                        <div class="product-option-shop">
                            <button class="btn btn-primary" wire:click="keranjang({{ $p->id }})">Keranjangin</button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="justify-content center">Data Produk Tidak Ada</div>
                @endforelse
            </div>
        </div>
    </div>
</div>