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
<script>
	initModal = function(){
		
		$('select[name="kategori"]').change(function(){
			console.log('cek')
			var val = $('select[name="kategori"]').val();
			if(val == 'Kontak Kami'){
				var html = `
					<div class="shows-input">
						<div class="form-group ">
							<label for="">Email</label>
							<input type="email" name="email" class="form-control" placeholder="Email" required="">
							
						</div>	
						<div class="form-group">
							<label for="">Phone</label>
							<input type="number" name="phone" class="form-control" placeholder="Phone" required="">
						</div>
						<div class="form-group">
							<label for="">Fax</label>
							<input type="text" name="fax" class="form-control" placeholder="fax" required="">
						</div>
					</div>`;
				$('.shows-inputs').append(html);
			}else{
				$('.shows-input').remove();
			}
		});
		
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