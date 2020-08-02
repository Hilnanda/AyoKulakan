
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Pilih Paket</label>
						<select name="paket_id" class="form-control watcher ui fluid search transparent dropdown">
							{!! \App\Models\HajiUmroh\HajiPaket::options('type_paket', 'id', ['selected' => $record->paket_id], 'Pilih Paket') !!}
						</select>
					</div>
					<div class="form-group">
						<label for="">Judul</label>
						<input type="text" name="judul" class="form-control" placeholder="Judul" required="" value="{{$record->judul}}">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label for="">Tanggal</label>
								<input type="text" class="form-control range" readonly placeholder="Tanggal" required="">
								<input type="hidden" id="tgl_berangkat" name="tgl_berangkat" class="form-control" placeholder="Tanggal Berangkat" value="{{$record->tgl_berangkat}}">
								<input type="hidden" id="tgl_pulang" name="tgl_pulang" class="form-control" placeholder="Tanggal Pulang" value="{{$record->tgl_pulang}}">
							</div>
							<div class="col-md-6">
								<label for="">Total Hari</label>
								<input type="text" id="total_hari" readonly name="total_hari" class="form-control" placeholder="Total Hari" required="" value="{{$record->total_hari}}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Harga</label>
						<input type="text" name="harga" class="form-control uang" placeholder="Harga" required=""value="{{$record->harga}}">
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