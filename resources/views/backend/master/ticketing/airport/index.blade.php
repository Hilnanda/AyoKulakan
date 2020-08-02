@extends('layouts.grid')

@section('js-filters')
    d.airport_name = $("input[name='filter[airport_name]']").val();
    d.airport_code = $("input[name='filter[airport_code]']").val();
    d.country_name = $("input[name='filter[country_name]']").val();
    d.lokasi = $("input[name='filter[lokasi]']").val();
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
		<input type="text" name="filter[airport_code]" class="form-control" placeholder="Airport Code" aria-label="" aria-describedby="">
	</div>&nbsp;
	<div class="input-group">
		<input type="text" name="filter[lokasi]" class="form-control" placeholder="Lokasi" aria-label="" aria-describedby="">
	</div>&nbsp;
	<div class="input-group">
		<input type="text" name="filter[country_name]" class="form-control" placeholder="Country Name" aria-label="" aria-describedby="">
	</div>&nbsp;
	<div class="btn-group mr-2" role="group" >
		<button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="ion-ios-search"></i></button>
		<button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="ion-android-refresh"></i></button>
	</div>
</div>
@endsection

@section('toolbars')

@endsection

@section('init-modal')
<script>
	initModal = function(){
		
		$('.date').calendar({
			type: 'date',
			text: {
				months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
			},
		});
		$('.year').calendar({
			type: 'year',
		});
		$('.month').calendar({
			type: 'month',
			disableMonth: false, 
		});
		$('.summernote').summernote({
			height: 50,
		});
	};
</script>
@endsection