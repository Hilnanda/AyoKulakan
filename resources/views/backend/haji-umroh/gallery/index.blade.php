@extends('layouts.grid')

@section('js-filters')
    d.nama = $("input[name='filter[nama]']").val();
@endsection

@section('filters')
	
@endsection
@section('rules')
	<script type="text/javascript">
		formRules = {
			judul: ['empty'],
		};
	</script>
@endsection


