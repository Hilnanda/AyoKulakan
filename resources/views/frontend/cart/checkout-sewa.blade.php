@extends('layouts.scaffold')

@section('js')
<!-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script> -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
// var inArr = ['image']
$(document).on('click', '.custom-file-input, .custom-file-label', function(e) {
    console.log('click')
    $(e.target).parent().find('input:text').click();
});
function removePictureStandard() {

    var pathinput = $('input[name="attachment_new[]"]').serializeArray();
    var map = $.map(pathinput,function(v,k){
        return v.value;
    });
    console.log('map',map);
    var formData = new FormData();

    $.ajax({
        url: '{{ url('picture/bulk-unlink') }}',
        type: "POST",
        data : {"_token":'{{ csrf_token() }}','filedelete':map},
        beforeSend : function () {

        },
        success: function(resp){

        },
        error : function(resp){
        },
    });
}

$(document).on('change', '.custom-file-input, .custom-file-label', function(e) {
    removePictureStandard();
    $('input[name="attachment_new[]"]').remove();
    $('.errors-files').remove();
    var file = $(e.target);
    var name = '';
    var pass = 0;
    var i = 0;
    var maxsize = {{convertfilesize()}};
    var failed = [];
    var success = [];
    var formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    var url = $(this).data('url');

    if(e.target.files.length > 0){
        var html = '<div class="alert alert-danger errors-files" role="alert"> ';
        $.each(e.target.files, function (index, filee) {
            var showclass = "success";
            if(filee.size > maxsize)
            {
                html += '<span style=""><i class="ion-close"></i> Sorry File '+ filee.name +' ( Failed to upload size above '+ "{{ini_get('upload_max_filesize')}}" +'B )</span><br>';
                failed.push(filee.name);
                i++;
                pass = i;
            }else if(filee.type.slice(0,5) !== 'image'){
                html += '<span style=""><i class="ion-close"></i> Sorry The File '+ filee.name +' (Must be image)</span><br>';
                failed.push(filee.name);
                i++;
                pass = i;
            }else{
                formData.append('picture['+index+']', filee);
                success.push(filee.name);
                name += filee.name + ', ';
            }
        });
        console.log('pass',pass)
        html+='</div>';
        if(pass > 0){
            $('#appendErrorFile').append(html);
        }
    }
// remove trailing ","
name = name.replace(/,\s*$/, '');
$('input:text', file.parent()).val(name);

if(success.length > 0){
    $.ajax({
        url: url,
        type: "POST",
        dataType: 'json',
        processData: false,
        contentType: false,
        timeout:15000,
        data : formData,
        success: function(resp){
            $.each(resp.url, function (index, value) {
                $('#inputGroupFile01').append(`<input type="hidden" class="path hidden input" name="attachment_new[]" value="`+ value +`"><input type="hidden" class="path hidden input" name="filenames[]" value="`+ resp.filename[index] +`">`);
            })
        },
        error: function(resp){
            var response = resp.responseJSON;
            if(typeof response === 'undefined'){
                var messagefILE = 'Sorry your file is to large maximum uploaded {{ini_get('upload_max_filesize')}}B';
                swal(
                    'Warning!',
                    ''+messagefILE,
                    'error'
                    );
            }
        },
    })
}

time = 5;
interval = setInterval(function(){
    time--;
        if(time == 0){
            clearInterval(interval);
            $('.errors-files').remove();
        }
    },1500)
});

$(document).ready(function(){
    $(document).on('change','.selectRajaongkir',function(){
        var valueKurir = $(this).val();
        var arrGram = $('.beratBarang').serializeArray();
        var origin = $('input[name="origin"]').val();
        var originType = $('input[name="originType"]').val();
        var destination = $('input[name="destination"]').val();
        var destinationType = $('input[name="destinationType"]').val();
        var valueGram = 0;
        if(arrGram.length > 0){
            $.each(arrGram,function(k,v){
                valueGram += parseInt(v.value);
            });
        }
        $.ajax({
            url: "{{ url('api/rajaongkir/cost') }}",
            type: "GET",
            data : {
                origin:origin,
                originType:originType,
                destination:destination,
                destinationType:destinationType,
                weight:valueGram,
                courier:valueKurir,
            },
            success: function(resp){
                var html = ``;
                if(resp){
                    if(resp.result){
                        if(resp.result.rajaongkir){
                            if(resp.result.rajaongkir.results.length > 0){
                                result = resp.result.rajaongkir.results;
                                $.each(result,function(k,v){
                                    if(v.costs.length > 0){
                                        $.each(v.costs,function(key1,val1){
                                            html += `<div class="col-md-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <input type="radio" class="tipeKurir" name="kurir_tipe" aria-label="..." value="`+val1.service+`" data-key="`+key1+`" data-title="`+v.name+`">
                                                            </span>
                                                        </div>
                                                        <div class="panel panel-default panel panel-body">
                                                            <h4 class="heading-title">`+val1.service+`</h4>`;
                                        
                                            if(val1.cost.length > 0){
                                                var result2 = val1.cost;
                                                $.each(result2,function(k2,v2){
                                                    html += `<input type="hidden" class="tipeKurirHarga`+key1+`" name="kurir_tipe_harga" value="`+v2.value+`">
                                                    <input type="hidden" class="tipeKurirHari`+key1+`" name="kurir_tipe_hari" value="`+v2.etd+`">
                                                    <h6 class="">`+v2.value+` ( `+v2.etd+` )</h6></div></div>`;  
                                                });
                                            }else{
                                                html += `</div></div>`;
                                            }
                                        });
                                    }
                                }); 
                            }
                        }
                    }
                }
                $('.appendTipeKurir').html(html);
            },
            error : function(resp){
                swal(
                    'Warning!',
                    'Tidak dapat memilih pengiriman silahkan lengkapi data diri anda terlebih dahulu',
                    'error'
                );
            },
        });
    });

    $(document).on('change','.tipeKurir',function(){
        var key = $(this).data('key');
        var title = $(this).data('title');
        var val = $(this).val();
        var harga = $('.tipeKurirHarga'+key).val(); 
        var hari = $('.tipeKurirHari'+key).val(); 
        $('.appendKurirPesanan').html(`
            <li>
                <div class="col-md-8">
                    <a href="javascript:void(0)">
                        `+title+' - '+val+' '+hari+` <strong class="product-quantity">`+harga+`</strong>
                    </a>
                </div>
                &nbsp;&nbsp;&nbsp;
                <span class="amount">Rp.
                    `+harga+`
                </span>
            </li><hr>
        `);
        var total = parseInt($('input[name="total_harga"]').val()) + parseInt(harga);
        $('input[name="kurir_child_tipe"]').val(val);
        $('input[name="kurir_child_harga"]').val(harga);
        $('input[name="kurir_child_hari"]').val(hari);
        $('.appendTotalHarga').html(`<h5>Total Orderan : Rp. `+total+`</h5>`);
    });
});
</script>
@append

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
            <h2 class="heading-title">Checkout</h2>

            <div class="container">
                <div class="content-ayokulakan">
                    <form id="dataFormPage" action="{{ url($pageUrl.'store-mt') }}" method="POST">
                        {!! csrf_field() !!}

                        <div class="row">
                            <!-- DETAIL BELANJA -->
                            <input type="hidden" name="origin" value="{{ ($user->kota) ? $user->kota->id : '' }}">
                            <input type="hidden" name="originType" value="city">
                            <input type="hidden" name="destination" value="{{ ($user->kecamatan) ? $user->kecamatan->id : '' }}">
                            <input type="hidden" name="destinationType" value="subdistrict">
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
                                        @if($record->where('form_type','img_rental')->count() > 0)
                                            <div class="col-md-12">
                                                <div class="form-group checkout-form-list mb-30 " id="appendErrorFile">
                                                    <label>Foto Ktp & KK (Kartu Keluarga)<span class="required">* Sertakan 2 Foto Tersebut</span></label>
                                                    <div class="form-group">
                                                        @include('partials.file-tab.attachment',['multi' => 'multiple','url' => 'upload'])
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
                                                    @if($record->count() > 0)
                                                    @foreach($record as $k => $value)
                                                    <li>
                                                        <div class="col-md-8">
                                                            <a href="javascript:void(0)">
                                                                @if($value->form_type == 'img_rental')
                                                                {{ $value->form->judul or '' }}
                                                                @endif
                                                                <strong class="product-quantity">(
                                                                    @if($value->form_type == 'img_rental')
                                                                    {{ $value->form->harga_sewa }}
                                                                    @endif
                                                                    ) × {{ $value->jumlah_barang }}
                                                                </strong>
                                                            </a>
                                                        </div>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <span class="amount">Rp.
                                                            @if($value->form_type == 'img_rental')
                                                            {{ $value->form->harga_sewa * $value->jumlah_barang }}
                                                            @endif
                                                        </span>
                                                    </li><hr>
                                                    @endforeach
                                                    @endif
                                                </ul>
                                                <ul class="appendKurirPesanan">
                                                </ul><br>
                                                <ul>
                                                    <li>
                                                        @php
                                                            $total = 0;
                                                            if($record->count() > 0){
                                                                foreach($record as $k => $value){
                                                                    if($value->form_type == 'img_rental'){
                                                                        $total += $value->jumlah_barang * $value->form->harga_sewa;
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        <b>
                                                            <input type="hidden" name="total_harga" value="{{ $total }}">
                                                            <strong class="appendTotalHarga"><h5>Total Orderan : Rp. {{ $total }}</h5></strong>
                                                        </b>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
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
            </form>
        </div>
    </div>
</div>
</div>
</div>

@endsection


