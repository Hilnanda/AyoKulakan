@extends('layouts.grid')

@section('js-filters')
    d.nama = $("input[name='filter[nama]']").val();
@endsection

@section('head-others')
<div class="card">
  <div class="card-header">
    <center>Calon Haji / Umroh</center>
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>Nama Calon Jamaah Haji / Umroh Yang Belum Lunas Silahkan Harap Melunasi Pembayaran Berikut Nama & Total Pembayaran Yang Harus Di Penuhi Dari Paket & Jadwal Yang Telah Dipilih</p>
      @php
      $total = 0;
      @endphp
      @if($record->count() > 0)
      	@foreach($record as $k => $value)
      		@php	
      			
      			$total += $value->jadwal->harga;
      		@endphp
	      <footer class="blockquote-footer">{{ $value->name }} - <b>Paket ({{ $value->paket->type_paket or '' }}), Jadwal ({{ $value->jadwal->tgl_berangkat.' - '.$value->jadwal->tgl_pulang }})</b> - Harga ${{ $value->jadwal->harga or '' }} .</footer>
      	@endforeach
      @endif
      <br>
      <center>
      	<footer class="footer">Total Harga Yang Harus Di Bayar ${{ $total }}
  		</footer>
      </center><br>
  		<p>Untuk Melakukan Pembayaran Silahkan Transfer Ke NO REK Berikut Dengan Lampiran KODE <b>AyoHU72</b> Untuk Dapat Mengkonfirmasi Pembayaran:</p>
  		<footer class="blockquote-footer">
        <p>
          BCA : 2631441990<br>
          BRI : 0577-01-000665-58-2<br>
          Mandiri : 143-00-1892418-1<br>
          BNI : 0831787218
        </p>  
      </footer><br>
  		<p>*Jika Sudah Melakukan Pembayaran Silahkan HUB Kontak Kami </p>
    </blockquote>
  </div>
</div>
<br>
@endsection

@section('filters')
<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
	<div class="input-group">
		<input type="text" name="filter[nama]" class="form-control" placeholder="Nama" aria-label="" aria-describedby="">
	</div>&nbsp;
	<div class="btn-group mr-2" role="group" >
		<button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="ion-ios-search"></i></button>
		<button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="ion-android-refresh"></i></button>
	</div>
</div>
@endsection

@section('rules')
	<script type="text/javascript">
		formRules = {
			judul: ['empty'],
		};
	</script>
@endsection


@section('toolbars')

@endsection