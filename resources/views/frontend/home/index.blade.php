@extends('layouts.scaffold-sidebar-left')

@section('js')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<!-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script> -->

<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>


<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY&callback=initMap"></script> -->


<script type="text/javascript">
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
$('.bots-month').datepicker({
	autoclose: true,
	minViewMode: 1,
	format: 'MM',
	language:'id'
});
$('.bots-date').datepicker({
	format: 'yyyy-mm-dd',
	todayHighlight: true,
	autoclose: true,
});
var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

$('.start-date').datepicker({
	format: 'yyyy-mm-dd',
	todayHighlight: true,
	startDate: today,
	autoclose: true,
}).on('changeDate', function (selected) {
	var minDate = new Date(selected.date.valueOf());
	$('.end-date').datepicker('setStartDate', minDate);
});

$('.end-date').datepicker({
	format: 'yyyy-mm-dd',
	todayHighlight: true,
	autoclose: true
}).on('changeDate', function (selected) {
	var maxDate = new Date(selected.date.valueOf());
	$('.start-date').datepicker('setEndDate', maxDate);
});
$('.input-daterange').datepicker({
	format: 'yyyy-mm-dd',
	todayHighlight: true,
	startDate: today,
	autoclose: true,

});


$(document).on('change','.pswt-dewasa',function(){
	if($(this).val() == 7){
		$('.pswt-anak').val('');
		$('.pswt-anak').attr('disabled','true');
	}else{
		$('.pswt-anak').removeAttr('disabled');
		var maxAnak = 7 - $(this).val();
		$('.pswt-anak').attr('max',maxAnak);

		if($(this).val() < 4){
			$('.pswt-bayi').attr('max',$(this).val());
		}else{
			$('.pswt-bayi').attr('max',4);
		}
		$('.pswt-bayi').val('');

	}
});

$(document).on('change','.pswt-anak',function(){
	if($(this).val() == 6){
		$('.pswt-dewasa').attr('max',1);
		$('.pswt-dewasa').attr('disabled','true');
	}else{
		$('.pswt-dewasa').removeAttr('disabled');
		var maxDewasa = 7 - $(this).val();
		$('.pswt-dewasa').attr('max',maxDewasa);
		var checkDewasa = $('.pswt-dewasa').val();
		if(checkDewasa < 4){
			$('.pswt-bayi').attr('max',checkDewasa);
		}else{
			$('.pswt-bayi').attr('max',4);
		}
	}
});

$(document).on('change','.pswt-bayi',function(){
	var checkDewasa = $('.pswt-dewasa').val();
	if(checkDewasa >= 4){
		$('.pswt-bayi').attr('max',4);
	}else{
		$('.pswt-bayi').attr('max',checkDewasa);
	}
});
// var dataOb = {};
// var flightArr = [];

// var ipData = $.getJSON('https://ipapi.co/json/', function(data) {
// 	flightArr.push({lat: 21.422487, lng: 39.826206},{lat: data.latitude, lng: data.longitude});
//   	var map = new google.maps.Map(document.getElementById('map'), {
// 		zoom: 2,
// 		center: {lat: -6.135200, lng: 106.813301},
// 		mapTypeId: 'terrain'
// 	});

// 	var flightPath = new google.maps.Polyline({
// 		path: flightArr,
// 		geodesic: true,
// 		strokeColor: '#FF0000',
// 		strokeOpacity: 1.0,
// 		strokeWeight: 2
// 	});

// 	flightPath.setMap(map);
// });

$(document).ready(function(){
	$('.selectpicker').selectpicker();
	$(".spinner-number").inputSpinner();
	$(".spinner-number").attr('readonly','true');
	$('.owl-two').owlCarousel({
	  center: true,
	  items:1,
	  dots:false,
	  autoWidth:true,
	  loop:true,
      margin:10,
      nav:true,
        responsive:{
		0:{
			items:1
		},
		600:{
			items:1,
		},
		900:{
			items:1,
		}
	}
	});

});

$(document).ready(function(){
	$('#togles-kategori').on('mouseenter', function(){
		console.log('berhasil');
	})
});

</script>
@append

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
formRules = {
	judul: ['empty'],
};
</script>
@endsection

@section('content-frontend-top')
@include('frontend.home.partial.slider')
@include('frontend.home.partial.policy')
@endsection

@section('content-frontend')
@include('frontend.home.partial.slider-iklan')
@endsection
@section('content-frontend2')
{{-- @include('frontend.home.partial.kategori') --}}
@include('frontend.home.partial.product-area-perikanan')
@include('frontend.home.partial.iklan')
@include('frontend.home.partial.product-area-perkebunan-pertanian')
@include('frontend.home.partial.iklan1')
@include('frontend.home.partial.product-area-tabs')
@endsection