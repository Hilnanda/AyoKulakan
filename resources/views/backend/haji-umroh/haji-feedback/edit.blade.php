
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
						<select name="user_id" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\User::options('nama', 'id', ['selected' => $record->user_id, ['filters' => ['user_id' => $record->user_id]]], ('Pilih User')) !!}
						</select>	
					</div>
					<div class="form-group">
						<label for="">Rating</label>
						<input type="number" name="rating" class="form-control" placeholder="Tanggal Berangkat" min="0" max="5" required=""value="{{$record->rating}}">
					</div>
					<div class="form-group">
						<label for="">Keterangan</label>
						<textarea name="keterangan" class="form-control summernote" rows="2">{!!$record->keterangan!!}</textarea>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-outline-secondary " data-dismiss="modal" aria-label="Close"><i class="ion-android-close"></i> Tutup</button>
	<button type="button" class="btn btn-success save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
</div>
</div>
</div>
</div>