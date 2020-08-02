
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Code</label>
						<input type="text" name="code" class="form-control" placeholder="Code" required="" value="{{ $record->code or '' }}">
					</div>

					<div class="form-group">
						<label for="">Name</label>
						<input type="text" name="name" class="form-control" placeholder="Name" required="" value="{{ $record->name or '' }}">
					</div>
					<div class="form-group">
						<label for="">Fee</label>
						<input type="text" name="fee" class="form-control" placeholder="Fee" required="" value="{{ $record->fee or '' }}">
					</div>	
					<div class="form-group">
						<label for="">Komisi</label>
						<input type="text" name="komisi" class="form-control" placeholder="Komisi" required="" value="{{ $record->komisi or '' }}">
					</div>
					<div class="form-group">
						<label for="">Type</label>
						<input type="text" name="type" class="form-control" placeholder="Type" required="" value="{{ $record->type or '' }}">
					</div>
					<div class="form-group">
						<label for="">Province</label>
						<input type="text" name="province" class="form-control" placeholder="Province" required="" value="{{ $record->province or '' }}">
					</div>	
					<div class="form-group">
						<label for="">Status</label>
						<input type="text" name="status" class="form-control" placeholder="Status" required="" readonly="" value="{{ $record->status or '' }}">
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