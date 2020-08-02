
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
							<option value="Tentang" {{ ($record->kategori == 'Tentang') ? 'selected' : '' }}>Tentang</option>
							<option value="Aturan Pengguna" {{ ($record->kategori == 'Aturan Pengguna') ? 'selected' : '' }}>Aturan Pengguna</option>
							<option value="Kebijakan Privasi" {{ ($record->kategori == 'Kebijakan Privasi') ? 'selected' : '' }}>Kebijakan Privasi</option>
							<option value="Identitas Brand" {{ ($record->kategori == 'Identitas Brand') ? 'selected' : '' }}>Identitas Brand</option>
							<option value="Kontak Kami" {{ ($record->kategori == 'Kontak Kami') ? 'selected' : '' }}>Kontak Kami</option>
							<option value="Tentang Haji & Umroh" {{ ($record->kategori == 'Tentang Haji & Umroh') ? 'selected' : '' }}>Tentang Haji & Umroh</option>

						</select>
						
					</div>	
					<div class="form-group shows-inputs">
						<div class="shows-input">
						@if($record->kategori == 'Kontak Kami')
							<div class="form-group ">
								<label for="">Email</label>
								<input type="email" name="email" class="form-control" placeholder="Email" required="" value="{{ $record->email or '' }}">
								
							</div>	
							<div class="form-group">
								<label for="">Phone</label>
								<input type="number" name="phone" class="form-control" placeholder="Phone" required="" value="{{ $record->phone or '' }}">
							</div>
							<div class="form-group">
								<label for="">Fax</label>
								<input type="text" name="fax" class="form-control" placeholder="fax" required="" value="{{ $record->fax or '' }}">
							</div>
						@endif
						</div>

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