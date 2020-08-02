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

@section('head-others')
<div class="alert alert-danger" role="alert">
  <!-- <h4 class="alert-heading">Peringatan !</h4> -->
  <p>Silahkan lakukan pengiriman barang, setelah <b>STATUS ORDER > TRANSAKSI BERHASIL</b>, jika diluar itu melakukan pengiriman, tanpa membaca dan memahami apa yang ayokulakan peringati, maka <b>PIHAK AYOKULAKAN</b> tidak ikut bertanggung jawab atas apa yang terjadi.</p>
  <hr>
  <p class="mb-0">Salam Hangat Ayokulakan.com</p>
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