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
<link rel="stylesheet" type="text/css" href="{{ url('/plugins/daterangepicker/daterangepicker.css') }}">
<script type="text/javascript" src="{{ url('/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('/plugins/daterangepicker/moments.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datepicker/datepicker3.css') }}">
<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
	initModal = function(){	
		$('.awal').datepicker();


		var berangkat = $('#tgl_berangkat').val();
		var pulang = $('#tgl_pulang').val();


		if(berangkat){
			berangkat = $('#tgl_berangkat').val();
		}else{
			berangkat = moment().startOf('day');
		}

		if(pulang){
			pulang = $('#tgl_pulang').val();
		}else{
			pulang = moment().endOf('day');
		}

        
		$('.range').daterangepicker({
				startDate : moment(berangkat),
        		endDate : moment(pulang),
        		format : 'MM/DD/YYYY'
			
			},function(start, end){

				var a = moment( start.format('MM/DD/YYYY'));
				var b = moment( end.format('MM/DD/YYYY'));
				var c = Math.abs( a.diff(b, 'days'));

				$('#tgl_berangkat').val(a._i);
				$('#tgl_pulang').val(b._i);
				$('#total_hari').val(c+1);

			});

		$('.uang').on('keyup', function(){
			var v = this.value;
			if(v){
				this.value = v.replace(/[^0-9]/g, '');
			}

		})


	};
</script>
@append


