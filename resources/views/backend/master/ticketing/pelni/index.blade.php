@extends('layouts.grid')

@section('js-filters')
    d.name = $("input[name='filter[name]']").val();
    d.code = $("input[name='filter[code]']").val();
  
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
	
	<div class="input-group">
		<input type="text" name="filter[name]" class="form-control" placeholder="Name" aria-label="" aria-describedby="">
	</div>&nbsp;
	<div class="input-group">
		<input type="text" name="filter[code]" class="form-control" placeholder="Code" aria-label="" aria-describedby="">
	</div>&nbsp;

	<div class="btn-group mr-2" role="group" >
		<button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="fa fa-search"></i></button>
		<button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="fa fa-close"></i></button>
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