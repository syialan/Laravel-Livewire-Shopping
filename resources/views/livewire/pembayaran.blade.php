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
    <div class="product-big-title-area mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Pembayaran</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if ($keranjang->status == 1)
            <div class="row">
                <div class="col-md-12">
                    <button id="pay-button" class="btn btn-primary center-block">
                        Lanjutkan Pembayaran!
                    </button>
                </div>
            </div>
            @elseif($keranjang->status == 2)
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <table class="table" style="border-top: hidden">
                                <tr>
                                    <td>Virtual Account</td>
                                    <td>:</td>
                                    <td>{{ $vaNumber }}</td>
                                </tr>
                                <tr>
                                    <td>Bank</td>
                                    <td>:</td>
                                    <td>{{ $bank }}</td>
                                </tr>
                                <tr>
                                    <td>Total Harga</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($grossAmount) }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>{{ $transactionStatus }}</td>
                                </tr>
                                <tr>
                                    <td>Batas Waktu Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ $deadline }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<form id="payment-form" method="get" action="Payment">
    <input type="hidden" name="resultData" id="result-data" value="">
</form>

<body>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_API_KEY_CLIENT">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');
            function changeResult(type, data) {
                $("#result-type").val(type);
                $("#result-data").val(JSON.stringify(data));
            }

            snap.pay('<?= $snapToken ?>', {
                onSuccess: function (result) {
                    changeResult('success', result);
                    console.log(result.status_message);
                    console.log(result);
                    $("#payment-form").submit();
                },
                onPending: function (result) {
                    changeResult('pending', result);
                    console.log(result.status_message);
                    $("#payment-form").submit();
                },
                onError: function (result) {
                    changeResult('error', result);
                    console.log(result.status_message);
                    $("#payment-form").submit();
                }
            });
    
};
    </script>
</body>