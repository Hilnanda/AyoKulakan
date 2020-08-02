

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
						<label for="">Tanggal Pembayaran</label>
						<input type="text" name="tgl_pembayaran" placeholder="Tanggal Pembayaran" class="bots-date form-control">					
					</div>
					<div class="form-group">
						<label for="">Uang Pembayaran</label>
						<input type="text" name="uang_pembayaran" class="form-control" placeholder="Uang Pembayaran">					
						<input type="hidden" name="status" placeholder="Uang Pembayaran" value="1">					
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
