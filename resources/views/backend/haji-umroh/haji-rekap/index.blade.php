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



@section('init-modal')

<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datepicker/datepicker3.css') }}">
<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
	initModal = function(){	
		months = [ "January", "February", "March", "April", "May", "June", 
		"July", "August", "September", "October", "November", "December" ];
		$.fn.datepicker.dates['id'] = {
			days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
			daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
			daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
			months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
			monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			today: "Today",
			clear: "Clear",
			format: "mm/dd/yyyy",
			titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
			weekStart: 0
		};

		$('.bots-date').datepicker({
			autoclose: true,
			language:'id',
			format: 'MM dd, yyyy'
		});
	};
</script>
@append