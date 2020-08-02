@extends('layouts.backend')

@section('body')
@section('scripts')
@include('layouts.scripts.frontend')

<script>
	$('.buttons-search').on('click',function(){
		console.log('ampas')
		var query = $('input[name="search_berita"]').val();

		$.ajax({
		    url: '{{ url($pageUrl) }}',
		    type: 'GET',
		    data: {querys:'query'},
		    success: function(resp){
		    },
		    error : function(resp){
		    }
		  });
	});
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
	@include('partials.backend.header')
    <div class="body-content outer-top-xs" id="top-banner-and-menu" style="z-index: -1">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-9 sidebar">
            @yield('content-frontend-left')
          </div>
          <div class="col-xs-12 col-sm-12 col-md-3 homebanner-holder" >
			<!--@include('partials.backend.partial-content.content-sidebar-right')-->


          </div>
          <div class="col-xs-12 col-sm-12 col-md-12" >
            @yield('content-frontend')
          </div>
        </div>
      </div>
    </div>
	@include('partials.backend.footer')


@endsection
