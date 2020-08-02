
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Judul</label>
						<input type="text" name="judul" class="form-control" placeholder="Judul" required="" value="{{ $record->judul or '' }}">
						
					</div>	
					<div class="form-group">
						<label for="">Deskripsi</label>
						<textarea name="deskripsi" class="form-control summernote" rows="2">{{ $record->deskripsi or '' }}</textarea>
						
					</div>	
					<div class="form-group">
						<label for="">Kategori Aplikasi</label>
						<select name="kategori" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
							<option>Pilih Kategori</option>
							
							<option value="FAQ" {{ ($record->kategori == 'FAQ') ? 'selected' : '' }}>FAQ</option>
							<option value="Panduan Pelapak" {{ ($record->kategori == 'Panduan Pelapak') ? 'selected' : '' }}>Panduan Pelapak</option>
							<option value="Panduan Pembeli" {{ ($record->kategori == 'Panduan Pembeli') ? 'selected' : '' }}>Panduan Pembeli</option>
							<option value="Buka Bantuan" {{ ($record->kategori == 'Buka Bantuan') ? 'selected' : '' }}>Buka Bantuan</option>
							<option value="Panduan Haji & Umroh" {{ ($record->kategori == 'Panduan Haji & Umroh') ? 'selected' : '' }}>Panduan Haji & Umroh</option>
							<option value="Panduan Kurir" {{ ($record->kategori == 'Panduan Kurir') ? 'selected' : '' }}>Panduan Kurir</option>
							<option value="Panduan Rental" {{ ($record->kategori == 'Panduan Rental') ? 'selected' : '' }}>Panduan Sewa</option>
							<option value="Panduan Kaki Lima" {{ ($record->kategori == 'Panduan Kaki Lima') ? 'selected' : '' }}>Panduan Kaki Lima</option>
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