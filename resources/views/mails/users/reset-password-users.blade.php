@extends('mails.component.head',[
  'data' => " ".$pesan
])
@section('body')
  <div class="card-title">
    <b><h2>Selamat Datang. {{ $record->nama or '' }}!</h2></b>
    <p>Reset Password. Silahkan Lakukan Reset Password</p>
  </div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <thead>
  </thead>
@if($urls)
  
  <table>
    <tr class="center aligned">
      <td>
      	<a href="{{$urls}}" title="">Menuju Ke Link</a>
      </td>
    </tr>
  </table>
@endif
@endsection
