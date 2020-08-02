
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Kategori Sewa</label>
						<select name="trans_kategori_id" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\Master\KategoriRental::options('nama', 'id', [], ('Pilih Kategori Sewa')) !!}
					</select>					
					</div>		
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Nama Kategori Sewa</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama Kategori Sewa" required="">
						
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