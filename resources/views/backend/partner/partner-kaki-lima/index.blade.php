@extends('layouts.grid')

@section('js-filters')
d.nama = $("input[name='filter[nama]']").val();
@endsection

@section('scripts')
@include('backend.lapak.script.index')
@endsection

@section('rules')
<script type="text/javascript">
	formRules = {
		judul: ['empty'],
	};
</script>
@endsection
@section('filters')

@endsection
@section('toolbars')

@endsection
@section('subcontent')
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Partner Kaki Lima</h3>
	</div>
	<div class="panel-body">
		@if($recordKaki)
		<form id="dataFormPage" action="{{ url($pageUrl.$recordKaki->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $recordKaki->id or ''}}">

			<div class="row">
				<div class="col-md-12 col-lg-12 col-xs-12">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							@if($recordKaki->attachments->count() > 0)
							@foreach($recordKaki->attachments as $k => $value)
							@if(isset($value->url))
							<li data-target="#myCarousel" data-slide-to="{{$k}}" class="{{ ($k == 0) ? 'active' : '' }}"></li>
							@endif
							@endforeach
							@endif
						</ol>

						<div class="carousel-inner">
							@if($recordKaki->attachments->count() > 0)
							@foreach($recordKaki->attachments as $k => $value)
							@if(isset($value->url))
							<div class="item {{ ($k == 0) ? 'active' : '' }}">
								<center><img src="{{ url('storage/'.$value->url) }}" alt="Ayokulakan" style="width: 500px;height: auto;"></center>
							</div>  
							@endif
							@endforeach
							@endif
						</div>

						<a class="left carousel-control" href="#myCarousel" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#myCarousel" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
			<div class="panel panel-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group country-select float-right">
							<label style="text-align: left">Nama Pemilik <span class="required">*</span></label>
							<input type="text" name="" class="form-control" placeholder="Nama Pemilik" readonly="" value="{{ auth()->user()->nama }}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group country-select float-right">
							<label style="text-align: left">Nama Usaha <span class="required">*</span></label>
							<input type="text" name="name" class="form-control" placeholder="Nama Usaha" value="{{ $recordKaki->name or '' }}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group country-select float-right">
							<label style="text-align: left">Tipe Usaha <span class="required">*</span></label>
							<input type="text" name="type_usaha" class="form-control" placeholder="Tipe Usaha" value="{{ $recordKaki->type_usaha or '' }}">
						</div>
					</div>

				</div>

					<div class="form-group country-select float-right">
						<label style="text-align: left">Keterangan Usaha <span class="required">*</span></label>
						<textarea name="keterangan" placeholder="Keterangan" class="form-control">{{ $recordKaki->keterangan or '' }}</textarea>
					</div>
					<div class="form-group">
						@include('partials.file-tab.attachment',['multi' => 'multiple'])
					</div>
					<div class="card">
						<div class="card-body pull-right">
							<button type="button" class="btn btn-success save-page save-ayokulakan pull-right"><i class="ion-ios-paper"></i> Simpan</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		@endif
	</div>
</div>



@endsection
