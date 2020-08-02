
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Kategori Barang</label>
						<select name="id_kategori" class="form-control child target selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-child="showSubKategori" data-namas='id_sub_kategori'>
							{!! \App\Models\Master\KategoriBarang::options('nama', 'id', [], ('Pilih Kategori Barang')) !!}
					</select>					
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Sub Kategori Barang</label>
						<select class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
						</select>	
						<div id="showSubKategori">
							
						</div>					
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Nama Child Kategori Barang</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama Child Kategori Barang" required="">
						
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