@extends('layouts.grid')

@section('script')
<script type="text/javascript">
	function convertToRupiah(angka)
		{
			var rupiah = '';    
			var angkarev = angka.toString().split('').reverse().join('');
			for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
				return rupiah.split('',rupiah.length-1).reverse().join('');
		}

		function convertToAngka(rupiah)
		{
			return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
		}

		$(document).ready(function(){
			var uangs = $('.duits').text()
			var converts = convertToRupiah(convertToAngka(uangs));
			$('.duits').val(converts);  
		});
		
		$('.summernote').summernote({
			height: 50,
		});
</script>
@endsection

@section('filters')
<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
  <div class="input-group">
    <input type="text" name="filter[nama]" class="form-control" placeholder="Nama Sewa" aria-label="" aria-describedby="">
  </div>&nbsp;
  <div class="btn-group mr-2" role="group" >
    <button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="fa fa-search"></i></button>
    <button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="fa fa-close"></i></button>
  </div>
</div>
@endsection

@section('js-filters')
    d.nama = $("input[name='filter[nama]']").val();
@endsection


@section('rules')
	<script type="text/javascript">
		formRules = {
			judul: ['empty'],
		};
	</script>
@endsection

@if(!$lapak)
	@section('head-others')
	<div class="alert alert-warning" role="alert">
	  <h4 class="alert-heading">Silahkan Lengkapi Data Lapak Anda Terlebih Dahulu !</h4>
	  <p class="mb-0">Salam Hangat Ayokulakan.com</p>
	</div>
	@endsection
	@section('toolbars')

	@endsection
@else
	@section('toolbars')
		<button type="button" class="btn btn-success add button"><i class="fa fa-plus"></i> Buat {!! $title or 'new' !!}</button>
	@endsection
@endif