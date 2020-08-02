
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="alert alert-success" role="alert">
				<h4 class="alert-heading">Data User !</h4>
				<div class="row">
					<div class="col-md-6">
		                <div class="footer-menu">
							<ul>
							  <li><a>Nama : {{ $record->user->nama or '' }}</a></li>
							  <li><a>Email : {{ $record->user->email or '' }}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
		                <div class="footer-menu">
							<ul>
							  <li><a>Tlp : {{ $record->user->phone or '' }}</a></li>
							  <li><a>Alamat : {{ $record->user->alamat or '' }}</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
					<input type="hidden" name="user_id" value="{{ $record->user_id or '' }}">
			        
                  <div class="col-md-6">
                    <div class="form-group country-select mb-30">
                      <label>Nama Usaha <span class="required">*</span></label>
                      <input type="text" name="name" class="form-control" placeholder="Nama Usaha" value="{{ $record->name or '' }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group country-select mb-30">
                      <label>Tipe Usaha <span class="required">*</span></label>
                      <input type="text" name="type_usaha" class="form-control" placeholder="Tipe Usaha" value="{{ $record->type_usaha or '' }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group country-select mb-30">
                      <label>Lat <span class="required">*</span></label>
                      <input type="text" name="lat" class="form-control" placeholder="Lat" value="{{ $record->lat or '' }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group country-select mb-30">
                      <label>Lng <span class="required">*</span></label>
                      <input type="text" name="lng" class="form-control" placeholder="Lng" value="{{ $record->lng or '' }}">
                    </div>
                  </div>
                   <div class="col-md-12">
                    <div class="form-group country-select mb-30">
                      <label>Keterangan Usaha <span class="required">*</span></label>
                      <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ $record->keterangan or '' }}</textarea>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  @include('partials.file-tab.attachment-without-delete',['multi' => 'multiple'])
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
