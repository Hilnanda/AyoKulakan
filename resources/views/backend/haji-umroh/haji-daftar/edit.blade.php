
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Pemesan</label>
						{{-- <select name="user_id" class="form-control watcher ui fluid search transparent dropdown">
							{!! \App\Models\User::options('nama', 'id', [], 'Pilih User') !!}
						</select>	 --}}		
						<select name="user_id" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\User::options('nama', 'id', ['selected' => $record->user_id, ['filters' => ['user_id' => $record->user_id]]], ('Pilih Pemesan')) !!}
						</select>			
					</div>	
					<div class="form-group">
						<label for="">Nama Peserta</label>
						<input type="text" name="name" class="form-control" placeholder="Nama Peserta" value="{{ $record->name or '' }}">					
					</div>	
					<div class="form-group">
						<label for="">Paket</label>
						{{-- <select name="user_id" class="form-control watcher ui fluid search transparent dropdown">
							{!! \App\Models\HajiUmroh\HajiPaket::options('type_paket', 'id', [], 'Pilih Paket') !!}
						</select>	 --}}
						<select name="id_paket" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\HajiUmroh\HajiPaket::options('type_paket', 'id', ['selected' => $record->id_paket, ['filters' => ['id_paket' => $record->id_paket]]], ('Pilih Paket')) !!}
						</select>						
					</div>
					<div class="form-group">
						<label for="">Jadwal</label>
						{{-- <select name="user_id" class="form-control watcher ui fluid search transparent dropdown">
							{!! \App\Models\HajiUmroh\HajiJadwal::options('judul', 'id', [], 'Pilih Jadwal') !!}
						</select>	 --}}
						<select name="id_jadwal" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\HajiUmroh\HajiJadwal::options('judul', 'id', ['selected' => $record->id_jadwal, ['filters' => ['id_jadwal' => $record->id_jadwal]]], ('Pilih Jadwal')) !!}
						</select>						
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