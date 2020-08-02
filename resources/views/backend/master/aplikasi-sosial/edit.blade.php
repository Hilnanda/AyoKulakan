
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Link</label>
						<input type="link" name="link" class="form-control" placeholder="Link Sosial Media" required="" value="{{ $record->link or '' }}">
						
					</div>	
					<div class="form-group">
						<label for="">Kategori Sosial Media</label>
						<select name="sosial_media" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
							<option>Pilih Kategori</option>
							<option value="FB" {{ ($record->sosial_media == 'FB') ? 'selected' : '' }}>FB</option>
							<option value="Twitter" {{ ($record->sosial_media == 'Twitter') ? 'selected' : '' }}>Twitter</option>
							<option value="Instagram" {{ ($record->sosial_media == 'Instagram') ? 'selected' : '' }}>Instagram</option>
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