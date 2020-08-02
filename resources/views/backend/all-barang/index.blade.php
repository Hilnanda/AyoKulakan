@extends('layouts.grid')

@section('js-filters')
d.nama_lapak = $("input[name='filter[nama_lapak]']").val();
d.nama = $("input[name='filter[nama]']").val();
d.id_kategori = $("select[name='filter[id_kategori]']").val();
d.id_sub_kategori = $("select[name='filter[id_sub_kategori]']").val();
d.id_child_kategori = $("select[name='filter[id_child_kategori]']").val();
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
    <input type="text" name="filter[nama_lapak]" class="form-control" placeholder="Nama Lapak" aria-label="" aria-describedby="">
  </div>
  <div class="input-group">
    <input type="text" name="filter[nama]" class="form-control" placeholder="Nama Barang" aria-label="" aria-describedby="">
  </div>
  <div class="input-group">
    <select name="filter[id_kategori]" class="form-control child target dynamic-more-than-5-select" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_sub_kategori,id_child_kategori">
				{!! \App\Models\Master\KategoriBarang::options('nama', 'id', [], ('Kategori Barang')) !!}
		</select>		
  </div>
  <!-- <div class="input-group">
		<select name="filter[id_sub_kategori]" class="form-control child target id_sub_kategori" required="" data-dropup-auto="false" data-size="10" data-style="none">
			{!! \App\Models\Master\KategoriBarangSub::options('nama', 'id', [], ('Sub Kategori Barang')) !!}
		</select>	
		<div id="id_sub_kategori">
			
		</div>									
	</div>
	<div class="input-group">
		<select name="filter[id_child_kategori]" class="form-control child target id_child_kategori" required="" data-dropup-auto="false" data-size="10" data-style="none">
			{!! \App\Models\Master\KategoriBarangChild::options('nama', 'id', [], ('Sub Child Kategori Barang')) !!}
		</select>	
		<div id="id_child_kategori">
			
		</div>	
	</div> -->
  <div class="btn-group mr-2" role="group" >
    <button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="fa fa-search"></i></button>
    <button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="fa fa-close"></i></button>
  </div>
</div>

<!-- <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
	<div class="col-6">
		<input type="text" name="filter[nama_lapak]" class="form-control" placeholder="Nama Lapak" aria-label="" aria-describedby="">
	</div>
	<div class="col-6">
		<input type="text" name="filter[nama]" class="form-control" placeholder="Nama Barang" aria-label="" aria-describedby="">
	</div>
	<div class="col-3">
		<select name="filter[id_kategori]" class="form-control child target dynamic-more-than-5-select" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_sub_kategori,id_child_kategori">
				{!! \App\Models\Master\KategoriBarang::options('nama', 'id', [], ('Kategori Barang')) !!}
		</select>					
	</div>
	<div class="col-3">
		<select name="filter[id_sub_kategori]" class="form-control child target id_sub_kategori" required="" data-dropup-auto="false" data-size="10" data-style="none">
			{!! \App\Models\Master\KategoriBarangSub::options('nama', 'id', [], ('Sub Kategori Barang')) !!}
		</select>	
		<div id="id_sub_kategori">
			
		</div>									
	</div>
	<div class="col-3">
		<select name="filter[id_child_kategori]" class="form-control child target id_child_kategori" required="" data-dropup-auto="false" data-size="10" data-style="none">
			{!! \App\Models\Master\KategoriBarangChild::options('nama', 'id', [], ('Sub Child Kategori Barang')) !!}
		</select>	
		<div id="id_child_kategori">
			
		</div>	
	</div>
	<div class="btn-group btn-group-lg" role="group" >
		<button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="ion-ios-search"></i></button>
		<button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="ion-android-refresh"></i></button>
	</div>
</div> -->
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