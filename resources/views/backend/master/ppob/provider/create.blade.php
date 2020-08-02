
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Code</label>
						<input type="text" name="code" class="form-control" placeholder="Code" required="">
					</div>
					<div class="form-group">
						<label for="">Type Data Operator</label>
						<input type="text" name="type" class="form-control" placeholder="Type Data Operator" required="">
					</div>
					<div class="form-group">
						<label for="">Operator</label>
						<input type="text" name="name" class="form-control" placeholder="Operator" required="">
					</div>
					<div class="form-group">
						<label for="">Jaringan Operator</label>
						<input type="text" name="status" class="form-control" placeholder="Jaringan Operator" required="">
					</div>
					<div class="form-group">
						<label for="">Deskripsi</label>
						<textarea name="deskripsi" class="form-control summernote" rows="2">
							
						</textarea>
					</div>

					
					<div class="form-group">
						@include('partials.file-tab.attachment')
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
