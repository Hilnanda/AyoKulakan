
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Wilayah Negara</label>
						<select name="id_negara" class="form-control child target dynamic-more-than-5-select selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota">
							{!! \App\Models\Master\WilayahNegara::options('negara', 'id', [], ('Pilih Wilayah Negara')) !!}
					</select>					
					</div>		
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Wilayah Provinsi</label>
						<select class="form-control child target id_provinsi selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
						</select>	
						<div id="id_provinsi">
							
						</div>					
					</div>		
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Wilayah Kota</label>
						<select class="form-control child target id_kota selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
						</select>	
						<div id="id_kota">
							
						</div>					
					</div>		
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Nama Kecamatan</label>
						<input type="text" name="kecamatan" class="form-control" placeholder="Nama Kecamatan" required="">
						
					</div>		
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-outline-secondary " data-dismiss="modal" aria-label="Close"><i class="ion-android-close"></i> Tutup</button>
	<button type="button" class="btn btn-outline-success save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
</div>
</div>
</div>
</div>