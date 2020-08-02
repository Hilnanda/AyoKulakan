@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty'],
    };
</script>
@endsection

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
<div class="terms-conditions-page">
    <div class="row">
        <div class="col-md-12 terms-conditions">
            <h2 class="heading-title">Detail Orderan</h2>
            <center><h4 class="">Untuk No Order <span class="text-danger">{{ $record->order_id or '' }}</span> Status <span class="text-danger">{{ $status->transaction_status or '' }}</span></h4></center>
            <center><h4 class="">Batas Pembayaran Terakhir Pada <span class="text-danger">{{ $batasPembayaran }}</span></h4></center>

            <div class="container">
                <div class="content-ayokulakan">
                    <form id="dataFormPage" action="{{ url($pageUrl.'store-mt') }}" method="POST">
                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="checkbox-form">
                                    <h3>Data Pemesan</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group country-select mb-30">
                                                <label>Nama <span class="required">*</span></label>
                                                <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $user->nama or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group country-select mb-30">
                                                <label>Negara <span class="required">*</span></label>
                                                <input type="text" name="negara" class="form-control" placeholder="Negara" value="{{ $user->negara->negara or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group country-select mb-30">
                                                <label>Provinsi <span class="required">*</span></label>
                                                <input type="text" name="provinsi" class="form-control" placeholder="Provinsi" value="{{ $user->provinsi->provinsi or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group country-select mb-30">
                                                <label>Kabupaten / Kota <span class="required">*</span></label>
                                                <input type="text" name="kota" class="form-control" placeholder="Kabupaten / Kota" value="{{ $user->kota->kota or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group country-select mb-30">
                                                <label>Kecamatan <span class="required">*</span></label>
                                                <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan" value="{{ $user->kecamatan->kecamatan or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group checkout-form-list">
                                                <label>Alamat <span class="required">*</span></label>
                                                <textarea name="alamat" placeholder="Alamat" class="form-control" readonly="">{{ $user->alamat or '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group checkout-form-list mb-30">
                                                <label>Kode Pos <span class="required">*</span></label>
                                                <input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos" value="{{ $user->kode_pos or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group checkout-form-list mb-30">
                                                <label>Email <span class="required">*</span></label>
                                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group checkout-form-list mb-30">
                                                <label>No Hp  <span class="required">*</span></label>
                                                <input type="text" name="hp" class="form-control" placeholder="No Hp" value="{{ $user->hp or '' }}" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="checkout-progress-sidebar ">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="unicase-checkout-title">Pesanan Anda</h4>
                                        </div>
                                        <div class="">
                                            <ul class="nav nav-checkout-progress list-unstyled">
                                                @if($record->detail->count() > 0)
                                                    @foreach($record->detail as $k => $value)
                                                        <li>
                                                            <div class="col-md-8">
                                                                <a href="javascript:void(0)">
                                                                    @if($value->form_type == 'img_rental')
                                                                        {{ $value->form->judul or '' }} <strong class="product-quantity">( {{ $value->jumlah_barang or '' }} ) x {{ $value->form->harga_sewa or '' }}</strong>
                                                                    @else
                                                                        {{ $value->form->nama_barang or '' }} <strong class="product-quantity">( {{ $value->jumlah_barang or '' }} ) x {{ $value->form->harga_barang or '' }}</strong>
                                                                    @endif
                                                                </a>
                                                            </div>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <span class="amount">Rp.
                                                                    @if($value->form_type == 'img_barang')
                                                                        {{ $value->form->harga_barang * $value->jumlah_barang }}
                                                                    @elseif($value->form_type == 'img_rental')
                                                                        {{ $value->form->harga_sewa * $value->jumlah_barang }}
                                                                    @else
                                                                        {{ $value->form->jadwal->harga or '' }}
                                                                    @endif
                                                                </span>
                                                        </li><hr>
                                                    @endforeach
                                                    <li>
                                                        <div class="col-md-8">
                                                            <a href="javascript:void(0)">
                                                                @if($record->kurir)
                                                                    ({{ $record->kurir->form->nama or '' }}) - {{  $record->kurir->kurir_child_tipe  }} ({{ $record->kurir->kurir_child_hari }})
                                                                @endif
                                                            </a>
                                                        </div>&nbsp;&nbsp;&nbsp;
                                                        <span class="amount">Rp.
                                                            @if($record->kurir)
                                                                {{  $record->kurir->kurir_child_harga  }}
                                                            @endif  
                                                        </span>
                                                        </a>
                                                    </li>
                                                @elseif($record->kereta)
                                                    @if(count($record->kereta) > 0)
                                                    @foreach($record->kereta as $k => $value)
                                                    <li>
                                                            Tiket Kereta Tujuan ({{ $value->org or '' }} | {{ $value->dest or '' }})
                                                            <span class="amount">Rp. {{ $value->ticketPrice or '' }}</span>
                                                    </li>
                                                    @endforeach
                                                    @endif
                                                @elseif($record->prepaid)
                                                <li>
                                                        ({{ $record->prepaid->form->pulsa_op or '' }} | {{ $record->prepaid->form->pulsa_nominal or '' }})
                                                        <span class="amount">Rp. {{ $record->prepaid->form->pulsa_price or '' }}</span>
                                                </li>
                                                @elseif($record->postpaid)
                                                <li>
                                                        ({{ $record->postpaid->type or '' }} | {{ $record->postpaid->pelanggan or '' }} - {{ $record->postpaid->tr_name or '' }}) - Periode {{ Carbon\Carbon::parse($record->postpaid->period)->format('Y-m') }}
                                                        <span class="amount">Rp. {{ $record->postpaid->ttl_harga or '' }}</span>
                                                </li>
                                                @endif
                                            </ul><br>
                                             @php
                                                $total = 0;
                                                    if($record->detail->count() > 0){
                                                    foreach($record->detail as $k => $value){
                                                    $total += $value->total_harga;
                                                }
                                            }
                                            @endphp
                                            <ul>
                                                <li>
                                                    <b>
                                                        <strong><h5>Total Orderan : Rp. {{ $record->total_harga }}</h5></strong>
                                                    </b>
                                                </li>
                                            </ul>

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
</div>
@endsection
