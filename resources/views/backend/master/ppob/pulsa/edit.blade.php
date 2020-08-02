
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Pulsa Code</label>
						<input type="text" name="pulsa_code" class="form-control" placeholder="Pulsa Code" required="" value="{{ $record->pulsa_code or '' }}">
					</div>

					<div class="form-group">
						<label for="">Pulsa OP</label>
						<input type="text" name="pulsa_op" class="form-control" placeholder="Pulsa OP" required="" value="{{ $record->pulsa_op or '' }}">
					</div>
					<div class="form-group">
						<label for="">Pulsa Nominal</label>
						<input type="text" name="pulsa_nominal" class="form-control" placeholder="Pulsa Nominal" required="" value="{{ $record->pulsa_nominal or '' }}">
					</div>	
					<div class="form-group">
						<label for="">Pulsa Price</label>
						<input type="text" name="pulsa_price" class="form-control" placeholder="Pulsa Price" required="" value="{{ $record->pulsa_price or '' }}">
					</div>
					<div class="form-group">
						<label for="">Pulsa Type</label>
						<input type="text" name="pulsa_type" class="form-control" placeholder="Pulsa Type" required="" value="{{ $record->pulsa_type or '' }}">
					</div>
					<div class="form-group">
						<label for="">Masa Aktif</label>
						<input type="text" name="masaaktif" class="form-control" placeholder="Masa Aktif" required="" value="{{ $record->masaaktif or '' }}">
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