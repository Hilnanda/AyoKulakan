
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Pengansur</label>
						<select name="user_id" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\User::options('nama', 'id', ['selected' => $record->user_id, ['filters' => ['user_id' => $record->user_id]]], ('Pilih Pengangsur')) !!}
						</select>						
					</div>
					<div class="form-group">
						<label for="">Nama Peserta</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama Peserta" value="{{ $record->nama or '' }}">					
					</div>
					<div class="form-group">
						<label for="">Umur Peserta</label>
						<input type="text" name="umur" class="form-control" placeholder="Umur Peserta" value="{{ $record->umur or '' }}">					
					</div>	
					<div class="form-group">
						<label for="">Paket</label>
						<select name="id_paket" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\HajiUmroh\HajiPaket::options('type_paket', 'id', ['selected' => $record->id_paket, ['filters' => ['id_paket' => $record->id_paket]]], ('Pilih Paket')) !!}
						</select>						
					</div>
					<div class="form-group">
						<label for="">Jadwal</label>
						<select name="id_jadwal" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\HajiUmroh\HajiJadwal::options('judul', 'id', ['selected' => $record->id_jadwal, ['filters' => ['id_jadwal' => $record->id_jadwal]]], ('Pilih Jadwal')) !!}
						</select>					
					</div>
					<div class="form-group">
						<label for="">Pilih Status</label>
						<select name="status" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							<option value="">Pilih Status</option>
							<option value="1" {{ ($record->status == 1) ? 'selected' : '' }}>Belum Lunas</option>
							<option value="2" {{ ($record->status == 2) ? 'selected' : '' }}>Sudah Lunas</option>
							<option value="3" {{ ($record->status == 3) ? 'selected' : '' }}>Hold</option>
							<option value="4" {{ ($record->status == 4) ? 'selected' : '' }}>Cancle</option>
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