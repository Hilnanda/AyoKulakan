
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
						<div class="form-group">
						<label for="">Tanggal Pembayaran</label>
						<input type="text" name="tgl_pembayaran" placeholder="Tanggal Pembayaran" class="bots-date form-control" value="{{ $record->tgl_pembayaran }}">					
					</div>
					<div class="form-group">
						<label for="">Uang Pembayaran</label>
						<input type="text" name="uang_pembayaran" class="form-control" placeholder="Uang Pembayaran" value="{{ $record->uang_pembayaran or '' }}">					
					</div>	
					<div class="form-group">
						<label for="">Status</label>
						<select  name="status" class="form-control child target changeSelects selectpicker">
							<option value="1" {{  $record->status == '1' ? 'selected' : '' }} >Belum Lunas</option>
							<option value="2" {{  $record->status == '2' ? 'selected' : '' }} >Sudah Lunas</option>
							<option value="3" {{  $record->status == '3' ? 'selected' : '' }} >Cancel</option>
							<option value="4" {{  $record->status == '4' ? 'selected' : '' }} >Hold</option>
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