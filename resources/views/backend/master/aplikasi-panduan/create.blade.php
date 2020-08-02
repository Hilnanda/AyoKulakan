
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Judul</label>
						<input type="text" name="judul" class="form-control" placeholder="Judul" required="">
						
					</div>	
					<div class="form-group">
						<label for="">Deskripsi</label>
						<textarea name="deskripsi" class="form-control summernote" rows="2"></textarea>
						
					</div>	
					<div class="form-group">
						<label for="">Kategori Aplikasi</label>
						<select name="kategori" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
							<option>Pilih Kategori</option>
							<option value="FAQ">FAQ</option>
							<option value="Panduan Pelapak">Panduan Pelapak</option>
							<option value="Panduan Pembeli">Panduan Pembeli</option>
							<option value="Buka Bantuan">Buka Bantuan</option>
							<option value="Panduan Haji & Umroh">Panduan Haji & Umroh</option>
							<option value="Panduan Kurir">Panduan Kurir</option>
							<option value="Panduan Rental">Panduan Sewa</option>
							<option value="Panduan Kaki Lima">Panduan Kaki Lima</option>
						</select>
						
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
