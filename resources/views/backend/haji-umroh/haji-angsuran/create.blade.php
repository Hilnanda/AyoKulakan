

<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Pengansur</label>
						<select name="user_id" class="form-control watcher ui fluid search transparent dropdown">
							{!! \App\Models\User::options('nama', 'id', [], 'Pilih User') !!}
						</select>						
					</div>
					<div class="form-group">
						<label for="">Nama Peserta</label>
						<input type="text" class="form-control" name="nama" placeholder="Nama Peserta">					
					</div>
					<div class="form-group">
						<label for="">Umur Peserta</label>
						<input type="text" class="form-control" name="umur" placeholder="Umur Peserta">					
					</div>	
					<div class="form-group">
						<label for="">Paket</label>
						<select name="id_paket" class="form-control watcher ui fluid search transparent dropdown">
							{!! \App\Models\HajiUmroh\HajiPaket::options('type_paket', 'id', [], 'Pilih Paket') !!}
						</select>						
					</div>
					<div class="form-group">
						<label for="">Jadwal</label>
						<select name="id_jadwal" class="form-control watcher ui fluid search transparent dropdown">
							{!! \App\Models\HajiUmroh\HajiJadwal::options('judul', 'id', [], 'Pilih Jadwal') !!}
						</select>						
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
