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
                            <a href="cart.html">Keranjang</a>
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
                        <h2>Produk Saya</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="product-content-left">
                        <div class="woocommerce">
                            <form wire:submit.prevent="tambahProduk">

                                <div id="customer_details">
                                    <div class="col-md-12">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Tambah Produk</h3>

                                            <p class="form-row form-row-first validate-required">
                                                <label for="nama_produk">Nama Produk
                                                </label>
                                                <input type="text" value="{{ old('nama_produk') }}"
                                                    placeholder="Silahkan diisi Nama Produknya" id="nama_produk"
                                                    wire:model="nama_produk"
                                                    class="input-text @error('nama_produk') is-invalid @enderror">
                                                @error('nama_produk')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </p>

                                            <p class="form-row form-row-last validate-required">
                                                <label for="harga">Harga Produk
                                                </label>
                                                <input type="number" min="0" value="{{ old('harga') }}"
                                                    placeholder="silahkan diisi Harganya" id="harga" wire:model="harga"
                                                    class="input-text @error('harga') is-invalid @enderror">
                                                @error('harga')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </p>

                                            <p class="form-row form-row-wide">
                                                <label for="berat">Berat Produk</label>
                                                <input type="number" min="0" value="{{ old('berat') }}"
                                                    placeholder="Silahkan diisi Beratnya" id="berat" wire:model="berat"
                                                    class="input-text @error('berat') is-invalid @enderror">
                                                @error('berat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </p>

                                            <p class="form-row form-row-wide address-field validate-required">
                                                <label for="gambar">Foto Produk</label>
                                                <input type="file" value="{{ old('gambar') }}"
                                                    placeholder="Silahkan Diisi Foto Produk" id="gambar"
                                                    wire:model="gambar"
                                                    class="input-text @error('gambar') is-invalid @enderror">
                                                    @error('gambar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </p>
                                        </div>
                                        <button type="submit" class="btn btn-success">SIMPAN PRODUK</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>