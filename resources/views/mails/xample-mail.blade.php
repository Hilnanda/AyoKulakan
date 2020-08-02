@extends('mails.component.xample-head',[
  'data' => " ".$pesan
])
@section('body')
  <p>
  	<center>
  		<b><h2>Selamat Datang!</h2></b>
  	</center>
  	<b>
      <h4>Keterangan Pesan</h4>
    </b>
    <p>
  		@foreach($record as $k => $value)
        {{ $k }} = {{ $value }} <br>
      @endforeach
  	</p>
  </p>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <thead>
  </thead>
@if($urls)
  
  <table>
    <tr class="center aligned">
      <td>
      	
      </td>
    </tr>
  </table>
@endif
@endsection
