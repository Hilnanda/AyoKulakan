@extends('layouts.backend')

@section('body')
@section('scripts')
@include('layouts.scripts.frontend')

<script>
	$('.card').find('.three.buttons').slideUp(1)
	$('.layout.buttons button').tab()
	$('table').tablesort()
	$('.filter .rangestart').calendar({
		type: 'date',
        text: {
          months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        },
		endCalendar: $('.filter .rangeend')
	});
	$('.filter .rangeend').calendar({
		type: 'date',
        text: {
          months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        },
		startCalendar: $('.filter .rangestart')
	});

	$('a.card').hover(function() {
		$(this).find('.three.buttons').slideDown(100)
	}, function(){
		$(this).find('.three.buttons').slideUp(100)
	});
</script>
@endsection

<header>
	@include('partials.backend.header-error')
	@yield('content')
	@include('partials.backend.footer')
</header>

@endsection
