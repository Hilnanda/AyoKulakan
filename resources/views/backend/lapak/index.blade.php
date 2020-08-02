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
<div class="terms-conditions-page">
	<div class="row">
		<div class="col-md-12 terms-conditions">
			<h2 class="heading-title">Identitas Brand
				@if($record == true)
				<button type="button" class="btn btn-success edit button pull-right" data-id="{{$record->id or ''}}">{!! $title or 'new' !!}</button>
				{{-- <button type="button" class="btn btn-success others-add button pull-right" data-id="{{$record->id or ''}}" data-titlemodal="Jual Barang" style="margin: 0px 10px">Jual Barang</button> --}}
				{{-- <button type="button" class="btn btn-success jasa-add button pull-right" data-id="{{$record->id or ''}}" data-titlemodal="Pasang Jasa" style="margin-left: 10px">Pasang Jasa</button>
				<button type="button" class="btn btn-success add-low button pull-right" data-id="{{$record->id or ''}}" data-titlemodal="Pasang Jasa" >Pasang Lowongan</button> --}}
				@else
				<button type="button" class="btn btn-success add button pull-right">{!! $title or 'new' !!}</button>
				@endif
			</h2>

			
			@if($record == true)
			@if($record->attachments->count() > 0)
			<div class="card">
				<div class="card-body">
					<center><img width="150" src="{{ ($record->attachments->first() == true) ? url('storage/'.$record->attachments->first()->url) : ''  }}" alt=""></center>
				</div>
			</div>
			@else
			<div class="card">
				<div class="card-body">
					<center>FOTO LAPAK</center>
				</div>
			</div>
			@endif
			@else
			<div class="card">
				<div class="card-body">
					<center>FOTO LAPAK</center>
				</div>
			</div>

			@endif
			<br>
			<div class="row">
				<div class="col-md-6 pull-left">
					<h3 style="position:relative;top:-25px;" class="pull-left">{{ $record->nama_lapak or '' }}</h3>
				</div>
				<div class="col-md-6">
					{{-- <div class="social-links pull-right" >
						<a href="https://id-id.facebook.com/sharer.php?u={{url()->current()}}" target="_blank"><i class="fa fa-facebook fa-lg" ></i></a>
						<a href="https://plus.google.com/share?url={{url()->current()}}" target="_blank"><i class="fa fa-google-plus fa-lg"></i></a>
						<a href="https://twitter.com/share?url={{url()->current()}}&amp;hashtags=ayokulakan" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
					</div> --}}
				</div>
			</div>
			<p style="text-align: left">
				{{ $record->deskripsi_lapak or ''}}
			</p>
			<p style="text-align: left">
				{{ $record->alamat_lapak or ''}}
			</p>
			<div class="row mt-2">
				<div class="col-xl-12 col-sm-12 col-md-12" style="">
					<h4>Silahkan Pilih Kategori Yang Mau Anda Jual</h4>
					@foreach ($records as $item)
					<div style=" width: 100%">
						<ul class="list-unstyled components border my-3" id="lapaks-barang" style=" width:100%; display:flex; position: relative ">
							<li class="bg-dark text-white" style="padding: 10px 0px; border:1px solid black; width: 50%;">
								<a href="javascript:void(0)" id="links" class="h5" style="display: flex; width:100%;">
									<img src="{{ ($item->attachments) ? url('storage/'.$item->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px">
									<p style="line-height: 50px; padding-left: 10px">{{ $item->kat_nama }}</p>
									<span class="fa fa-angle-right" style="line-height: 50px; font-size:14px; margin-left:auto; margin-right:10px"></span>
								</a>
							</li>
							<style type="text/css">
									.abs{
										position: absolute;
										width: 50%;
										top: 0px;
										right: 0px;
										background-color: #ffffff;
										overflow: scroll;
										z-index: 9999;
									}
							</style>
							<ul id="seconds" style="display:none; !important">
								@foreach($item->subkategori as $items)
								<li class="bg-dark lapaks-show" style="padding: 10px 5px; border:1px solid black;">
									<a href="javascript:void(0)" class="add-low button" data-id="{{ $items->id }}" style="display: flex; width: 100%">
										<img src="{{ ($items->attachments) ? url('storage/'.$items->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px">
										<p style="line-height: 50px; padding-left: 10px">{{ $items->sub_nama }}</p>
									</a>
								</li>
								@endforeach
							</ul>
						</ul>
					</div>
					@endforeach
				</div>
			</div>
			<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
				<div class="more-info-tab clearfix ">
					<div class="row">
						<div class="col-md-5">
							<div class="container">
								<div class="page-title text-center">
									<form class="form filter-form">
										<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
											<div class="input-group">
												<input type="text" name="filter[nama]" class="form-control" placeholder="Search" aria-label="" aria-describedby="" 	>&nbsp;
											</div>&nbsp;
											<div class="btn-group">
												<button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="fa fa-search"></i> Search</button>
												<button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="fa fa-close"></i> Clear</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<form method="get" class="form filter-form">
								<select name="filter[tampilkan]" class="nice-select-menu orderby form-control" >
									<option>Tampilkan</option>
									<option value="10">10</option>
									<option value="30">30</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select>
							</form>
						</div>
						<div class="col-md-3">
							<form method="get" class="woocommerce-ordering hidden-xs">
								<select name="filter[sort]" class="nice-select-menu orderby form-control">
									<option>Default sorting</option>
									<option value="popularity">Sort by popularity</option>
									<option value="rating">Sort by average rating</option>
									<option value="date">Sort by newness</option>
									<option value="price">Sort by price: low to high</option>
									<option value="price-desc">Sort by price: high to low</option>
								</select>
							</form>
						</div>
					</div>
				</div>
				<div class="search-result-container ">
					<div id="myTabContent" class="tab-content category-list">
						<div class="tab-pane active " id="grid-container">
							<input type="hidden" name="id_lapaks" value="{{ $record->id or '' }}">
							<div class="shop-page-product-area tab-content show-barang" >

							</div>
						</div>
					</div>
				</div>
			</div>



		</div>
	</div>
</div>

@endsection
