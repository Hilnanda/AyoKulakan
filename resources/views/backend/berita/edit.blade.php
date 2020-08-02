
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Judul</label>
						<input type="text" name="judul" class="form-control" placeholder="Judul" required="" value="{{ $record->judul or '' }}">	
					</div>	
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Kategori Berita</label>
						<select name="kategori" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
							<option value="">Pilih Kategori</option>
							<option {{ ($record->kategori == 'Slider') ? 'selected' : '' }} value="Slider">Slider</option>
							<option {{ ($record->kategori == 'Berita') ? 'selected' : '' }} value="Berita">Berita</option>
							<option {{ ($record->kategori == 'Diskon') ? 'selected' : '' }} value="Diskon">Diskon</option>
							<option {{ ($record->kategori == 'Iklan') ? 'selected' : '' }} value="Iklan">Iklan</option>
							<option {{ ($record->kategori == 'Promosi') ? 'selected' : '' }} value="Promosi">Promosi</option>
						</select>
					</div>	
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Deskripsi</label>
						<textarea name="deskripsi" class="form-control summernote" rows="2">{{ $record->deskripsi or '' }}</textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						@include('partials.file-tab.attachment-without-delete')
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