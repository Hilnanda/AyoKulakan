<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.'store') }}" method="POST">
			{!! csrf_field() !!}
			 <div class="terms-conditions-page">
	            <div class="row">
	                <div class="col-md-12 terms-conditions">
	                    <h2 class="heading-title">Notifikasi Anda</h2>
	                    @if($record->count() > 0)
							  	@foreach($record->sortByDesc('created_at') as $k => $value)
				                    <div class="row">
				                        <div class="col-sm-2">
				                            @if($value->review == 1)
				                                <center><img src="{{ asset('img/images.png') }}" style="background-color: #fd842b;width: 75px"></center>

				                            @else
				                                <center><img src="{{ asset('img/images.png') }}" style="width: 75px"></center>
				                            @endif
				                        </div>
				                        <div class="col-md-10" style="text-align: left;">
				                            <a href="javascript:void(0)" class="show-front shows" data-url="{{ url('mess-not/'.$value->id.'/2') }}" style="font-size: 13px"><b><u>{{ $value->judul or '' }}, Untuk Order Id {{ $value->trans->order_id or '' }}</u></b></a>
				                            <p class="mb-1">{{ $value->message or '' }}</p>
				                            <small class="pull-right">{{ $value->creationDate() }}</small>
				                        </div>
				                    </div><hr>
								@endforeach
							  @else
							  	<center><h4 class="alert-heading">Tidak Ada Notifikasi Untuk Anda !</h4></center>
							  @endif
	                </div>          
	            </div>
	        </div>
		
	</form>
	</div>
</div>
<div class="modal-footer">
	<div class="col-md-12 ml-auto">
		<button type="button" class="btn btn-outline-success pull-right" data-dismiss="modal"><i class="ion-ios-exit"></i> Tutup</button>
	</div>
</div>
</div>
</div>
</div>