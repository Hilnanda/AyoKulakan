@extends('layouts.grid')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datepicker/datepicker3.css') }}">
@append

@section('js')
<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
	$('.bots-date').datepicker({
	    format: 'yyyy-mm-dd',
	    todayHighlight: true,
	    autoclose: true,
	  });
</script>
@append


@section('js-filters')
    d.order_id = $("input[name='filter[order_id]']").val();
    d.lapak = $("input[name='filter[lapak]']").val();
    d.barang = $("input[name='filter[barang]']").val();
    d.created_at = $("input[name='filter[created_at]']").val();
@endsection


@section('rules')
	<script type="text/javascript">
		formRules = {
			judul: ['empty'],
		};
	</script>
@endsection


@section('filters')
<div class="btn-toolbar mb-5" role="toolbar" aria-label="Toolbar with button groups">
	{{-- <div class="input-group">
		<input type="text" name="filter[airport_name]" class="form-control" placeholder="Airport Name" aria-label="" aria-describedby="">
	</div>&nbsp; --}}
	<div class="input-group">
		<input type="text" name="filter[order_id]" class="form-control" placeholder="Order Id" aria-label="" aria-describedby="">
	</div>&nbsp;
	<div class="input-group">
		<input type="text" name="filter[lapak]" class="form-control" placeholder="Nama Lapak" aria-label="" aria-describedby="">
	</div>&nbsp;
	{{-- <div class="input-group">
		<input type="text" name="filter[barang]" class="form-control" placeholder="Nama Barang" aria-label="" aria-describedby="">
	</div>&nbsp; --}}
	<div class="input-group">
		<input type="text" name="filter[created_at]" class="form-control bots-date" placeholder="Tanggal Dibuat" aria-label="" aria-describedby="">
	</div>&nbsp;
	<div class="btn-group mr-2" role="group" >
		<button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="fa fa-search"></i></button>
    <button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="fa fa-close"></i></button>
	</div>
</div>
@endsection

