
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="status" value="1013">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama" required="">
						
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Jenis Kelamin</label>
						<select name="gender" class="form-control" placeholder="Jenis Kelamin" required>
							<option selected="selected">- Pilih Jenis Kelamin -</option>
							<option value="Laki - Laki" >Laki - Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" name="username" class="form-control" placeholder="Username" required="">
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Email </label>
						<input type="email" name="email" class="form-control" placeholder="Email" required="">
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">No Telp / HP </label>
						<input type="number" name="hp" class="form-control" placeholder="No Telp / HP" required="" min="0">
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Alamat</label>
						<textarea class="form-control" name="alamat" rows="1"></textarea>
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Password </label>
						<input type="password" name="password" class="form-control" placeholder="Password" required="">
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Konfirmasi Password </label>
						<input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required="">
					</div>		
				</div>
				<div class="col-md-12">
					<div class="form-group">
						@include('partials.file-tab.foto-users',['label' => 'Lampiran Foto','shows' => false])
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