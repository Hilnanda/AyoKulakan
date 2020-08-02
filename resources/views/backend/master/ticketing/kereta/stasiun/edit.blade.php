
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Group Code</label>
						<input type="text" name="group_code" class="form-control" placeholder="Group Code" required="" value="{{ $record->group_code or '' }}">
					</div>

					<div class="form-group">
						<label for="">Code</label>
						<input type="text" name="code" class="form-control" placeholder="Code" required="" value="{{ $record->code or '' }}">
					</div>

					<div class="form-group">
						<label for="">Name</label>
						<input type="text" name="name" class="form-control" placeholder="Name" required="" value="{{ $record->name or '' }}">
					</div>
					
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