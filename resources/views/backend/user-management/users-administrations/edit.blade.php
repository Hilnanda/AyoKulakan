
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama" required="" value="{{ $record->nama or '' }}">
						
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Jenis Kelamin</label>
						 	<select name="gender" class="form-control" placeholder="Jenis Kelamin" required>
				            	<option selected="selected">- Pilih Jenis Kelamin -</option>
					              <option value="Laki - Laki" {{ ($record->gender == 'Laki - Laki') ? 'selected' : '' }}>Laki - Laki</option>
					              <option value="Perempuan" {{ ($record->gender == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
				          	</select>
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" name="username" class="form-control" placeholder="Username" required=""  value="{{ $record->username or '' }}">
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Email </label>
						<input type="email" name="email" class="form-control" placeholder="Email" required="" value="{{ $record->email or '' }}">
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">No Telp / HP </label>
						<input type="number" name="hp" class="form-control" placeholder="No Telp / HP" required="" value="{{ $record->hp or '' }}" min="0">
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Akses</label>
						 	<select name="status" class="form-control" placeholder="Jenis Kelamin" required>
				            	<option selected="selected">- Pilih Akses User -</option>
					              <option value="1010" {{ ($record->status == '1010') ? 'selected' : '' }}>Administration</option>
					              <option value="1011" {{ ($record->status == '1011') ? 'selected' : '' }}>CS</option>
				          	</select>
					</div>		
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Alamat</label>
						<textarea class="form-control" name="alamat" rows="1">{{ $record->alamat or '' }}</textarea>
					</div>		
				</div>
				<div class="col-md-8">
					<div class="form-group">
						@include('partials.file-tab.foto-users',['label' => 'Lampiran Foto', 'shows' => true])
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