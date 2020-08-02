
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Nama Peserta</label>
						<input type="text" name="name" class="form-control" placeholder="Nama Peserta" value="{{ $record->name or '' }}">					
					</div>	
					<div class="form-group">
						<label for="">NIK</label>
						<input type="text" name="nik" class="form-control" placeholder="NIK" required="" value="{{$record->nik}}">
					</div>
					<div class="form-group">
						<label for="">KK</label>
						<input type="text" name="kk" class="form-control" placeholder="KK" required="" value="{{$record->kk}}">
					</div>

					<div class="form-group">
						<label for="">Keterangan Penyakit</label>
						<textarea name="keterangan_penyakit" class="form-control summernote" rows="2">{!!$record->keterangan_penyakit!!}</textarea>
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