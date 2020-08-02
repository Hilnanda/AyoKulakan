@extends('layouts.scaffold')

@section('css')
    <style type="text/css">
        .warnas {
            background-color:#ff823e0a;
        }
    </style>
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection
@section('content-frontend')
<main class="outer-top"></main>
<div class="body-content">
    <div class="container">
      <div class="col-md-12" style="margin: 80px 50px 50px">
          <div class="detail-block">
            <h4>Chat</h4>
            <hr>
            <div class="col-md-4">
              <form class="form-group">
                <input class="form-control mr-sm-2" type="search" placeholder="Cari Percakapan" id="findAChat" aria-label="Search">
              </form>
              <ul class="list-group" id="listChatGroup">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Loading . .
                  <span class="badge badge-primary badge-pill">0</span>
                </li>
              </ul>
            </div>
            <div class="col-md-8">
              <div class="chat-box" style="overflow-y:scroll;height:500px;border:1px solid; max-height:500px" >
                <ul class="list-group" id="chatBoxContent" style="margin:7px 7px 7px">
                </ul>
              </div>
              <div style="margin-top:10px">
                <form class="" onsubmit="return false" id="chatText" method="post">
                  <div class="form-group">
                    <textarea id="isiCitCat" class="form-control" rows="4" cols="80">Tulis pesanmu disini..</textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">Kirim Pesan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
