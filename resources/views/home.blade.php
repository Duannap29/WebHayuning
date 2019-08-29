@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="background-color: #eeeeee">
                        <li class="nav-item">
                            <a class="nav-link active show" id="coin-tab" data-toggle="tab" href="#coin" role="tab" aria-controls="coin" aria-selected="false"> <b> Coin </b> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="transaksi-tab" data-toggle="tab" href="#transaksi" role="tab" aria-controls="transaksi" aria-selected="false"> <b> Transaksi </b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="DaftarTransaksi-tab" data-toggle="tab" href="#DaftarTransaksi" role="tab" aria-controls="DaftarTransaksi" aria-selected="false"><b> Daftar Transaksi </b></a>
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
                            <tr>
                                <td colspan="4">Last Price = {{ $coinnew->harga }}</td>
                            </tr>
                            <table border="1" class="table table-stripped">
                                <thead class="bg-dark text-white text-center">
                                    <tr>
                                        <th width="5%"> ID </th>
                                        <th> Nama </th>
                                        <th> Harga </th>
                                        <th> Created at </th>
                                    </tr>
                                </thead>
                                </tbody>
                                @foreach($coins as $coin)
                                <tr>
                                    <td class="text-center"> {{ $coin->id }} </td>
                                    <td> {{ $coin->nama }} </td>
                                    <td class="text-center"> {{ $coin->harga }} </td>
                                    <td class="text-center"> {{ $coin->created_at }} </td>
                                </tr>
                        
                                @endforeach
                                </tbody>
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
                            <tr>
                                <td colspan="8">
                                    Total IDR = Rp. {{ $totalTransaksi[0]->total_idr }} <br>
                                    Total Pembelian Coin = {{ $totalTransaksi[0]->total_pembelian_coin }}
                                </td>
                            </tr>
                            <table border="1" class="table table-stripped">
                                <thead class="bg-dark text-white text-center">
                                    <tr>
                                        <th width="5%"> ID </th>
                                        <th> Nama Pembeli </th>
                                        <th> Alamat </th>
                                        <th> Email </th>
                                        <th> No KTP </th>
                                        <th> Jumlah Beli </th>
                                        <th> Total Coin </th>
                                        <th> Created at </th>
                                    </tr>
                                </thead>
                                </tbody>
                            
                            @foreach($transaksis as $transaksi)
                            <tr>
                                <td class="text-center"> {{ $transaksi->id }} </td>
                                <td> {{ $transaksi->nama_pembeli }} </td>
                                <td class="text-center"> {{ $transaksi->alamat }} </td>
                                <td class="text-center"> {{ $transaksi->email }} </td>
                                <td class="text-center"> {{ $transaksi->no_KTP }} </td>
                                <td class="text-center"> {{ $transaksi->jumlah_beli }} </td>
                                <td class="text-center"> {{ $transaksi->total_coin }} </td>
                                <td class="text-center"> {{ $transaksi->created_at }} </td>
                            </tr>
                            @endforeach
                            </tbody>
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