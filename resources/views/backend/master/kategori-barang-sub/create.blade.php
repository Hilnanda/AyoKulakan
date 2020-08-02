
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Kategori Barang</label>
						<select name="id_kategori" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\Master\KategoriBarang::options('kat_nama', 'id', [], ('Pilih Kategori Barang')) !!}
					</select>					
					</div>		
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Nama Kategori Barang</label>
						<input type="text" name="sub_nama" class="form-control" placeholder="Nama Kategori Barang" required="">
						
					</div>		
				</div>
				<div class="col-md-12">
					<div class="form-group">
						@include('partials.file-tab.attachment')
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