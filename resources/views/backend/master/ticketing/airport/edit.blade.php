
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Airport Name</label>
						<input type="text" name="airport_name" class="form-control" placeholder="Airport Name" required="" value="{{ $record->airport_name or '' }}">
					</div>

					<div class="form-group">
						<label for="">Airport Code</label>
						<input type="text" name="airport_code" class="form-control" placeholder="Airport Code" required="" value="{{ $record->airport_code or '' }}">
					</div>
					<div class="form-group">
						<label for="">Location Name</label>
						<input type="text" name="location_name" class="form-control" placeholder="Location Name" required="" value="{{ $record->location_name or '' }}">
					</div>	
					<div class="form-group">
						<label for="">Country Id</label>
						<input type="text" name="country_id" class="form-control" placeholder="Country Id" required="" value="{{ $record->country_id or '' }}">
					</div>
					<div class="form-group">
						<label for="">Country Name</label>
						<input type="text" name="country_name" class="form-control" placeholder="Country Name" required="" value="{{ $record->country_name or '' }}">
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