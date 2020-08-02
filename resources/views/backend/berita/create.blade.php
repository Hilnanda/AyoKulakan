

<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Judul</label>
						<input type="text" name="judul" class="form-control" placeholder="Judul" required="">
						
					</div>	
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Kategori Berita</label>
						<select name="kategori" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
							<option value="">Pilih Kategori</option>
							<option value="Slider">Slider</option>
							<option value="Berita">Berita</option>
							<option value="Diskon">Diskon</option>
							<option value="Iklan">Iklan</option>
							<option value="Promosi">Promosi</option>
						</select>
					</div>	
				</div>
				<div class="col-md-4">
					<div class="form-group">
						@include('partials.file-tab.attachment')
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Deskripsi</label>
						<textarea name="deskripsi" class="form-control summernote" rows="2"></textarea>
					</div>	
				</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary " data-dismiss="modal" aria-label="Close"><i class="ion-android-close"></i> Tutup</button>
	<button type="button" class="btn btn-success save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
</div>
</div>
</div>
</div>
