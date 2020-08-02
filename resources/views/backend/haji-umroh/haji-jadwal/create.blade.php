

<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Pilih Paket</label>
						<select name="paket_id" class="form-control watcher ui fluid search transparent dropdown">
							{!! \App\Models\HajiUmroh\HajiPaket::options('type_paket', 'id', [], 'Pilih Paket') !!}
						</select>
					</div>
					<div class="form-group">
						<label for="">Judul</label>
						<input type="text" name="judul" class="form-control" placeholder="Judul" required="">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label for="">Tanggal</label>
								<input type="text" class="form-control range" readonly placeholder="Tanggal" required="">
								<input type="hidden" id="tgl_berangkat" name="tgl_berangkat" class="form-control" placeholder="Tanggal Berangkat" required="">
								<input type="hidden" id="tgl_pulang" name="tgl_pulang" class="form-control" placeholder="Tanggal Pulang" required="">
							</div>
							<div class="col-md-6">
								<label for="">Total Hari</label>
								<input type="text" id="total_hari" readonly name="total_hari" class="form-control" placeholder="Total Hari" required="">
							</div>
						</div>
					</div>
					<div class="form-group">
					<label for="">Harga Dalam Kurs ($ DOLAR)</label>
					  <input type="number" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga" placeholder="Harga Dalam Kurs ($ DOLAR)" required="">
					</div>
					
					<div class="form-group">
						<label for="">Keterangan</label>
						<textarea name="keterangan" class="form-control summernote" rows="2"></textarea>
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
