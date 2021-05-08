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
                        <h2>Ongkos Kirim</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="product-content-left">
                        <div class="woocommerce">
                            <form wire:submit.prevent="getOngkir">
                                <div id="customer_details" class="col2-set">
                                    <div class="col1">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Tambahkan Ongkos Kirim</h3>

                                            <p
                                                class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                <label for="provinsi">Silahkan Pilih Provinsi Anda
                                                </label>
                                                <select class="country_to_state country_select" id="provinsi"
                                                    wire:model="provinsiId">
                                                    <option value="0">-PILIH PROVINSI-</option>
                                                    @forelse ($daftarProvinsi as $dp)
                                                    <option value="{{ $dp['province_id'] }}">{{ $dp['province'] }}
                                                    </option>
                                                    @empty
                                                    <option value="0">Provinsi Tidak Ada</option>
                                                    @endforelse
                                                </select>
                                            </p>

                                            <p
                                                class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                <label for="kota">Silahkan Pilih Kota Anda
                                                </label>
                                                <select class="country_to_state country_select" id="kota"
                                                    wire:model="kotaId">
                                                    <option value="">-PILIH KABUPATEN/KOTA-</option>
                                                    @if ($provinsiId)
                                                    @forelse ($daftarKota as $dk)
                                                    <option value="{{ $dk['city_id'] }}">{{ $dk['city_name'] }}</option>
                                                    @empty
                                                    <option value="">PILIH KABUPATEN/KOTA</option>
                                                    @endforelse
                                                    @endif
                                                </select>
                                            </p>

                                            <p
                                                class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                <label for="jasa">Jasa Kurir
                                                </label>
                                                <select class="country_to_state country_select" id="jasa"
                                                    wire:model="jasa">
                                                    <option value="">-PILIH JASA PENGIRIMAN-</option>
                                                    <option value="jne">JNE</option>
                                                    <option value="pos">Pos Indonesia</option>
                                                    <option value="tiki">TIKI</option>
                                                </select>
                                            </p>
                                        </div>
                                        <button type="submit" class="btn btn-success">Lihat Ongkos Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if ($result)
                <section class="products mb-5">
                    <div class="row mt-4">
                        @foreach ($result as $r)
                        <div class="col-md-3 ml-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div>
                                        <h5>{{ $namaJasa }}</h5>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <h5><strong>{{ $r['biaya'] }}</strong></h5>
                                            <h6><strong>{{ $r['etd'] }}</strong></h6>
                                            <h6><strong>{{ $r['description'] }}</strong></h6>
                                        </div>
                                    </div>
                                    <div class="row mt-2 mr-5">
                                        <button class="btn btn-success btn-block"
                                            wire:click="saveOngkir({{ $r['biaya'] }})">
                                            Tambah Ongkir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>
        </div>
    </div>
</div>