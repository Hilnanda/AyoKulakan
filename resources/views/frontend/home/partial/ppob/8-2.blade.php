<style type="text/css">
.labels-custom::before, 
.labels-custom::after {
	width: 1.85rem;
	height: 1.85rem;
	margin-bottom: none;
	color: white;

}
.label-custom-disable:before{
	color: white;
	background-color:red;
}

.labels-customKp::before, 
.labels-customKp::after {
	width: 1.85rem;
	height: 1.85rem;
	margin-bottom: none;
	color: white;

}
.label-customKp-disable:before{
	color: white;
	background-color:red;
}
</style>
<h3>Keberangkatan {{ $request['org'] }} - {{ $request['dest'] }}</h3>
<input type="hidden" name="brkt[tr_id]" value="{{ $recBrkt->data->tr_id }}">
@if(isset($recBrkt->data->desc))
	@foreach($recBrkt->data->desc->passenger as $k => $v)
		<input type="hidden" name="brkt[ticketNumber][{{$k}}]" value="{{ $v->ticketNumber }}">
	@endforeach
@endif
@if(count($record->data->seatMap))
	@php
	$seatMapsKp = [];
	$i = -1;
	@endphp
	@foreach($record->data->seatMap as $k => $value)
		@php
			$i++;
			if(isset($seatMaps[$value->wagonCode][$value->seatColumn])){
				$seatMaps[$value->wagonCode][$value->seatColumn][$i]["seatId"] = $value->seatId;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["wagonCode"] = $value->wagonCode;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["row"] = $value->row;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["column"] = $value->column;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["seatRow"] = $value->seatRow;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["seatColumn"] = $value->seatColumn;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["subClass"] = $value->subClass;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["isAvailable"] = $value->isAvailable;
			}else{
				
				$seatMaps[$value->wagonCode][$value->seatColumn][$i]["seatId"] = $value->seatId;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["wagonCode"] = $value->wagonCode;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["row"] = $value->row;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["column"] = $value->column;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["seatRow"] = $value->seatRow;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["seatColumn"] = $value->seatColumn;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["subClass"] = $value->subClass;
		        $seatMaps[$value->wagonCode][$value->seatColumn][$i]["isAvailable"] = $value->isAvailable;
			}
		@endphp
	@endforeach
	<ul class="nav nav-tabs" id="myTabs" role="tablist">
	@if(count($seatMaps) > 0)
		@php
		$i = -1;
		@endphp
		@foreach($seatMaps as $k => $v)
		@php
		$i++;
		@endphp
		<li class="nav-item {{ ($i == 0) ? 'active' : '' }}">
			<a class="nav-link" id="{{ $k }}" data-toggle="tab" href="#{{ $k }}" data-checkno="{{$k}}" role="tab" aria-controls="{{ $k }}" aria-selected="{{ ($i == 0) ? 'true' : 'false' }}">{{ $k }}</a>
		</li>
		@endforeach
	@endif	
	</ul>
	<div class="tab-content" id="myTabsContent">
		@if(count($seatMaps) > 0)
			@php
				$i = -1;
			@endphp
			@foreach($seatMaps as $key => $value)
			@php
				$nLoop = max($v);
				$i++;
			@endphp
				<div class="tab-pane tab-check {{ ($i == 0) ? 'show active' : '' }}" id="body{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}">
					<table class="table table-responsive" style="" width="100%">
						<thead class="thead-light">
							<tr>
								<th style="background-color: #c5c5c5;">#</th>
								@for($i2 = 0; $i2 < count($nLoop); $i2++)
								<th scope="col" style="width: 90px">{{ $i2+1 }}</th>
								@endfor
							</tr>
						</thead>
						<tbody>
							@if(count($value) > 0)
								@foreach($value as $key1 => $value1)
									<tr>
										<td colspan="" rowspan="" headers="" style="background-color: #c5c5c5;">{{ $key1 }}</td>
										@if(count($value1) > 0)
											@foreach($value1 as $key2 => $value2)
												<td>
													@if($value2['isAvailable'] == false)
													<div class="custom-control custom-checkbox">
														<label class="custom-control-label labels-custom label-custom-disable" for="customCheck{{ $value2['seatRow'].$key1 }}">
															<span style="font-size: 12px;" >{{ $value2['seatRow'].$key1 }}</span>
														</label>
													</div>
													@else
													<div class="custom-control custom-checkbox">					
														<input type="checkbox" class="custom-control-input custom-datas-checkbox" aria-checked="" tabindex="0" id="{{ $key1 }}_{{ $value2['seatRow'].$key1 }}" name="berangkat[seats][]" value="{{ $value2['seatId'] }}" >
														<label class="custom-control-label labels-custom label-custom-ready" for="customCheck{{ $key1 }}_{{ $value2['seatRow'].$key1 }}"><span style="">{{ $value2['seatRow'].$key1 }}</span></label>
													</div>
													@endif
												</td>
											@endforeach
										@endif
									</tr>		
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			@endforeach
		@endif
	</div>
@endif

<br>
@if(count($recordKepulangan))
<h3>Kepulangan {{ $request['dest'] }} - {{ $request['org'] }}</h3>
<input type="hidden" name="kepul[tr_id]" value="{{ $recKepul->data->tr_id }}">
@if(isset($recKepul->data->desc))
	@foreach($recKepul->data->desc->passenger as $k => $v)
		<input type="hidden" name="kepul[ticketNumber][{{$k}}]" value="{{ $v->ticketNumber }}">
	@endforeach
@endif
@php
	$seatMapsKp = [];
	$i = -1;
	@endphp
	@foreach($recordKepulangan->data->seatMap as $k => $value)
		@php
			$i++;
			if(isset($seatMapsKp[$value->wagonCode][$value->seatColumn])){
				$seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["seatId"] = $value->seatId;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["wagonCode"] = $value->wagonCode;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["row"] = $value->row;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["column"] = $value->column;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["seatRow"] = $value->seatRow;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["seatColumn"] = $value->seatColumn;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["subClass"] = $value->subClass;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["isAvailable"] = $value->isAvailable;
			}else{
				
				$seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["seatId"] = $value->seatId;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["wagonCode"] = $value->wagonCode;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["row"] = $value->row;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["column"] = $value->column;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["seatRow"] = $value->seatRow;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["seatColumn"] = $value->seatColumn;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["subClass"] = $value->subClass;
		        $seatMapsKp[$value->wagonCode][$value->seatColumn][$i]["isAvailable"] = $value->isAvailable;
			}
		@endphp
	@endforeach
	<ul class="nav nav-tabs" id="myTabsKp" role="tablist">
	@if(count($seatMapsKp) > 0)
		@php
		$i = -1;
		@endphp
		@foreach($seatMapsKp as $k => $v)
		@php
		$i++;
		@endphp
		<li class="nav-item {{ ($i == 0) ? 'active' : '' }}">
			<a class="nav-link" id="{{ $k }}" data-toggle="tab" href="#{{ $k }}" data-checkno="{{$k}}" role="tab" aria-controls="{{ $k }}" aria-selected="{{ ($i == 0) ? 'true' : 'false' }}">{{ $k }}</a>
		</li>
		@endforeach
	@endif	
	</ul>
	<div class="tab-content" id="myTabsContentKp">
		@if(count($seatMapsKp) > 0)
			@php
				$i = -1;
			@endphp
			@foreach($seatMapsKp as $key => $value)
			@php
				$nLoop = max($v);
				$i++;
			@endphp
				<div class="tab-pane tab-checkKp {{ ($i == 0) ? 'show active' : '' }}" id="bodyKP{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}">
					<table class="table table-responsive" style="" width="100%">
						<thead class="thead-light">
							<tr>
								<th style="background-color: #c5c5c5;">#</th>
								@for($i2 = 0; $i2 < count($nLoop); $i2++)
								<th scope="col" style="width: 90px">{{ $i2+1 }}</th>
								@endfor
							</tr>
						</thead>
						<tbody>
							@if(count($value) > 0)
								@foreach($value as $key1 => $value1)
									<tr>
										<td colspan="" rowspan="" headers="" style="background-color: #c5c5c5;">{{ $key1 }}</td>
										@if(count($value1) > 0)
											@foreach($value1 as $key2 => $value2)
												<td>
													@if($value2['isAvailable'] == false)
													<div class="custom-control custom-checkbox">
														<label class="custom-control-label labels-custom label-custom-disable" for="customCheck{{ $value2['seatRow'].$key1 }}">
															<span style="font-size: 12px;" >{{ $value2['seatRow'].$key1 }}</span>
														</label>
													</div>
													@else
													<div class="custom-control custom-checkbox">					
														<input type="checkbox" class="custom-control-input custom-datasKp-checkbox" aria-checked="" tabindex="0" id="{{ $key1 }}_{{ $value2['seatRow'].$key1 }}" name="kepulangan[seats][]" value="{{ $value2['seatId'] }}" >
														<label class="custom-control-label labels-custom label-custom-ready" for="customCheck{{ $key1 }}_{{ $value2['seatRow'].$key1 }}"><span style="">{{ $value2['seatRow'].$key1 }}</span></label>
													</div>
													@endif
												</td>
											@endforeach
										@endif
									</tr>		
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			@endforeach
		@endif
	</div>
@endif
