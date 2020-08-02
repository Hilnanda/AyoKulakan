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
<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
	<div class="input-group">
		<input type="text" name="filter[airport_name]" class="form-control" placeholder="Name" aria-label="" aria-describedby="">
	</div>&nbsp; 
	<div class="input-group">
		<input type="text" name="filter[airport_code]" class="form-control" placeholder="Code" aria-label="" aria-describedby="">
	</div>&nbsp;
	<div class="btn-group mr-2" role="group" >
		<button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="fa fa-search"></i> Search</button>
		<button type="button" class="btn btn-danger reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="fa fa-close"></i> Clear</button>
		
	</div>
</div>
@endsection
