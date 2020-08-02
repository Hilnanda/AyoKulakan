
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Nama Kategori Sewa</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama Kategori Sewa" required="" value="{{ $record->nama or '' }}">
						
					</div>
					<div class="form-group">
						<!-- <input type="file" name="image" id=""> -->
						@include('partials.file-tab.attachMany-without-delete')
					</div>	
					<!-- <button type="submit">simpan</button> -->		
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