@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="coin-tab" data-toggle="tab" href="#coin" role="tab" aria-controls="coin" aria-selected="false">Coin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="transaksi-tab" data-toggle="tab" href="#transaksi" role="tab" aria-controls="transaksi" aria-selected="false">Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="DaftarTransaksi-tab" data-toggle="tab" href="#DaftarTransaksi" role="tab" aria-controls="DaftarTransaksi" aria-selected="false">Daftar Transaksi</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        </br>
                        <div class="tab-pane fade" id="coin" role="tabpanel" aria-labelledby="coin-tab">Harga :
                            <form action="{{ route('store') }}" method="POST">
                                @csrf
                                <input type="text" name="coin" value="" placeholder="Masukan harga"> =
                                <label for="">1 QC</label>
                                </br>
                                <button type="submit" class="btn btn-primary btn-sm"> Save </button>
                                </br>
                            </form>
                            <hr>


                        @if(!empty($coins) && !empty($coinnew))
                        <table border="2" class="table">
                            <thead class="thead-light">
                            <tr>
                                <td colspan="4">Last Price = {{ $coinnew->harga }}</td>
                            </tr>
                            <tr>
                                <th> ID </th>
                                <th> Nama </th>
                                <th> Harga </th>
                                <th> Created at </th>
                            </tr>
                            @foreach($coins as $coin)
                            <tr>
                                <td> {{ $coin->id }} </td>
                                <td> {{ $coin->nama }} </td>
                                <td> {{ $coin->harga }} </td>
                                <td> {{ $coin->created_at }} </td>
                            </tr>
                            
                            @endforeach
                        </table>
                        @endif
                        </div>

                        <div class="tab-pane fade" id="transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
                            <form action="{{ route('nota') }}" method="POST">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <input type="text" class="form-control" placeholder="Nama Pembeli" name="nama_pembeli">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamat">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <input type="email" class="form-control" placeholder="Email" name="email">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <input type="number" class="form-control" placeholder="No KTP" name="ktp">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <input type="number" class="form-control" placeholder="Jumlah Pembelian" id="koin" name="pembelian">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <input type="text" class="form-control" placeholder="Total Coin" id="total" name="total_coin">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <button type="submit" class="btn btn-primary"> Save </button>
                                        </div>
                                    </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="DaftarTransaksi" role="tabpanel" aria-labelledby="DaftarTransaksi-tab">
                            <table border="2" class="table table-responsive">
                            <thead class="thead-light">
                            <tr>
                                <td colspan="8">
                                    Total IDR = Rp. {{ $totalTransaksi[0]->total_idr }} <br>
                                    Total Pembelian Coin = {{ $totalTransaksi[0]->total_pembelian_coin }}
                                </td>
                            </tr>
                            <tr>
                                <th> ID </th>
                                <th> Nama Pembeli </th>
                                <th> Alamat </th>
                                <th> Email </th>
                                <th> No KTP </th>
                                <th> Jumlah Beli </th>
                                <th> Total Coin </th>
                                <th> Created at </th>
                            </tr>
                            
                            @foreach($transaksis as $transaksi)
                            <tr>
                                <td> {{ $transaksi->id }} </td>
                                <td> {{ $transaksi->nama_pembeli }} </td>
                                <td> {{ $transaksi->alamat }} </td>
                                <td> {{ $transaksi->email }} </td>
                                <td> {{ $transaksi->no_KTP }} </td>
                                <td> {{ $transaksi->jumlah_beli }} </td>
                                <td> {{ $transaksi->total_coin }} </td>
                                <td> {{ $transaksi->created_at }} </td>
                            </tr>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection @section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#koin').on('keyup', function(e) {
            var userInput = e.target.value;

            $.ajax({
                url: '{{ route("get.last.price") }}',
                dataType: 'json',
                type: 'GET',
                success: function(data) {
                    $('#total').val(userInput / data[0].harga);
                }
            });

        });
    });
</script>
@endsection