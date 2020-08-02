@extends('layouts.grid')

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

@section('filters')
<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
	<div class="input-group">
		<input type="text" name="filter[nama]" class="form-control" placeholder="Nama Kota" aria-label="" aria-describedby="">
	</div>&nbsp;
	<div class="btn-group mr-2" role="group" >
		<button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="ion-ios-search"></i></button>
		<button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="ion-android-refresh"></i></button>
	</div>
</div>
@endsection