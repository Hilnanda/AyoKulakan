@extends('layouts.scaffold')

@section('css')
<style>
    .outer-top {
        margin-top: 200px;
    }

    @media screen and (max-width: 768px) {
        .outer-top {
            margin-top: 400px;
        }
    }
</style>
@endsection

@section('content-frontend')
{{-- <main class="outer-top"></main> --}}
<div class="terms-conditions-page">
    <div class="row">
        <div class="col-md-12 terms-conditions">
            <h2 class="heading-title">Checkout</h2>
            <form id="dataFormPage" action="{{ url($pageUrl.'store-mt') }}" method="POST">
            {!! csrf_field() !!}
                <div class="container">
                    <div class="checkout-box ">
                        <div class="row">
                            <div class="col-md-8">
                                @php
                                    $i = 0;
                                    $totalHarga = 0;
                                @endphp
                                @foreach($record as $k => $value)
                                    @php
                                        $i++;
                                        $lapak = \App\Models\Lapak\Lapak::find($k);
                                        $totalBerat = 0;
                                    @endphp
                                    @if($lapak)
                                    <div class="panel-group checkout-steps" id="accordion">
                                        <div class="panel panel-default checkout-step-0{{$i}}">
                                            <div class="panel-heading">
                                                <h4 class="unicase-checkout-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                                                        <span>{{ $i }}</span>Lapak {{ $lapak->nama_lapak }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="4" class="heading-title">Data Barang</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if(count($value) > 0)
                                                                            @foreach($value as $k1 => $value1)
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][lapak_id]" value="{{ $lapak->id }}">
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][barang][{{$i}}][id]" value="{{ $value1->form->id }}">
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][barang][{{$i}}][name]" value="{{ $value1->form->nama_barang }}">
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][barang][{{$i}}][price]" value="{{ $value1->form->harga_barang }}">
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][barang][{{$i}}][quantity]" value="{{ $value1->jumlah_barang }}">
                                                                                <tr>
                                                                                    <td class="col-md-2">
                                                                                        <img src="{{ ($value1->form->attacOne) ? url('storage/'.$value1->form->attacOne->url) : asset('img/no-images.png') }}" style="max-height: 100px;max-width: 100px" alt="imga">
                                                                                    </td>
                                                                                    <td class="col-md-7">
                                                                                        <div class="product-name"><span><b>{{ $value1->form->nama_barang }}</b></span></div>
                                                                                        <div class="price">
                                                                                            Rp. {{ number_format($value1->form->harga_barang, 2, ',', '.') ?? 0 }}
                                                                                        </div>
                                                                                        <div class="price">
                                                                                            Jumlah Pembelian ( {{ $value1->jumlah_barang }} )
                                                                                        </div>
                                                                                        <div class="price">
                                                                                            Total Harga Pembelian  
                                                                                            @php
                                                                                                $harga = (int)$value1->form->harga_barang;
                                                                                                $jumlah = (int)$value1->jumlah_barang;
                                                                                                $total = $jumlah * $harga;
                                                                                                $totalHarga += $total;
                                                                                                $totalBerat += (int)$value1->form->berat_barang;
                                                                                            @endphp
                                                                                            ( Rp. {{ number_format($total, 2, ',', '.') ?? 0 }} )
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="checkout-progress-sidebar ">
                                                                <div class="panel-group">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="unicase-checkout-title">Pilih Data Pengiriman</h4>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <div class="row">
                                                                                <div class="form-group">
                                                                                  <select id="paket" name="item_details[{{ $lapak->id }}][kurir_code]" class="form-control pilihPengiriman" required="" data-dropup-auto="false" data-size="10" data-style="none" data-pengiriman="#appendPengiriman{{$i}}" data-lapak="{{ $lapak->id }}" data-berat="{{ $totalBerat }}" data-num="{{ $i }}">
                                                                                      {!! App\Models\Master\Rajaongkir::options('nama', 'code', [], 'Pilih Data Pengiriman') !!}
                                                                                  </select>
                                                                                  <input type="hidden" name="item_details[{{ $lapak->id }}][kurir_harga_child]" class="kurir_harga_child{{ $lapak->id }}">
                                                                                  <input type="hidden" name="item_details[{{ $lapak->id }}][kurir_hari_child]" class="kurir_hari_child{{ $lapak->id }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-12" id="appendPengiriman{{$i}}">
                                                             
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <div class="panel-group checkout-steps" id="accordion">
                                            <div class="panel panel-default checkout-step-0{{$i}}">
                                                <div class="panel-heading">
                                                    <h4 class="unicase-checkout-title">
                                                        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                                                            <span>{{ $i }}</span>Maaf Barang Yang Anda Pesan Tidak Tersedia, di Karenakan Lapak Penjual Tidak Tersedia.
                                                        </a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                
                            </div>
                            <div class="col-md-4">
                                <div class="checkout-progress-sidebar ">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="unicase-checkout-title">Data Diri</h4>
                                            </div>
                                            <div class="">
                                                <ul class="nav nav-checkout-progress list-unstyled">
                                                    <li><a>Nama : {{ $user->nama }}</a></li>
                                                    <li><a>Negara : {{ $user->negara->negara }}</a></li>
                                                    <li><a>Provinsi : {{ ($user->provinsi) ? $user->provinsi->provinsi : '' }}</a></li>
                                                    <li><a>Kabupaten : {{ ($user->kota) ? $user->kota->kota : '' }}</a></li>
                                                    <li><a>Kecamatan : {{ ($user->kecamatan) ? $user->kecamatan->kecamatan : '' }}</a></li>
                                                    <li><a>Alamat : {{ $user->alamat }}</a></li>
                                                    <li><a>Kode : {{ $user->kode_pos }}</a></li>
                                                    <li><a>Email : {{ $user->email }}</a></li>
                                                    <li><a>No : {{ $user->hp }}</a></li>
                                                </ul>    

                                                <input type="hidden" name="nama" value="{{ $user->nama or '' }}">
                                                <input type="hidden" name="negara" value="{{ $user->negara->negara or '' }}">
                                                <input type="hidden" name="provinsi" value="{{ $user->provinsi->provinsi or '' }}">
                                                <input type="hidden" name="kota" value="{{ $user->kota->kota or '' }}">
                                                <input type="hidden" name="kecamatan" value="{{ $user->kecamatan->kecamatan or '' }}">
                                                <input type="hidden" name="kode_pos" value="{{ $user->kode_pos or '' }}">
                                                <input type="hidden" name="email" value="{{ $user->email or '' }}">
                                                <input type="hidden" name="hp" value="{{ $user->hp or '' }}"> 
                                                <textarea name="alamat" readonly="" style="display: none">{{ $user->alamat or '' }}</textarea>

                                            </div>
                                            <div class="payment-method">
                                                <div class="payment-accordion">
                                                    <div class="order-button-payment">
                                                        <div class="btn btn-primary btn-lg btn-block checkout-btn">TOTAL HARGA : <b class="totalHarga">{{ $totalHarga }}</b></div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="payment-method">
                                                <div class="payment-accordion">
                                                    <div class="order-button-payment">
                                                        @if($record->count() > 0)
                                                        <button type="button" class="btn btn-success save-page save-frontend btn-lg btn-block" data-title="Lengkapi Data Profile Anda Sebelum Melakukan Pembayaran" data-confirm="Bayar" data-batal="Batal">Bayar</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div> 

                            </div> 

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection


@section('js')
<!-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script> -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
    $(document).on('change','.pilihPengiriman',function(){
        var dataAppend = $(this).data('pengiriman');
        var dataLapak = $(this).data('lapak');
        var dataBerat = $(this).data('berat');
        var dataNum = $(this).data('num');
        var result = $(this).val();
        
        $.ajax({
            url: '{{ url("keranjang/pengiriman") }}',
            type: 'GET',
            data: {
                kurir_id : result,
                dataAppend : dataAppend,
                lapak_id : dataLapak,
                berat : dataBerat,
                num : dataNum,
            },
            success: function(resp){
                $(dataAppend).html(resp);
            },
            error : function(resp){
            }
        });
    });

    $(document).on('change','.tipeKurir',function(){
        // var checkHargaKurir = $('.tipeKurir').data('harga').serializeArray();
        // console.log('checkHargaKurir',checkHargaKurir)
        var hari = $(this).data('hari');
        var harga = $(this).data('harga');
        var lapak = $(this).data('lapak');
        // var totalHarga = parseInt($('.totalHarga').text()) + harga;

        $('.kurir_harga_child'+lapak).val(harga);
        $('.kurir_hari_child'+lapak).val(hari);
        // $('.totalHarga').text(totalHarga);
    });
</script>
@endsection

