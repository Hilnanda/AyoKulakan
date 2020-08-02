<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
   @if($record->count() > 0)
   @foreach($record as $k => $value)
   <li data-target="#myCarousel" data-slide-to="{{$k}}" class="{{ ($k == 0) ? 'active' : '' }}"></li>
   @endforeach
   @endif
 </ol>

 <div class="carousel-inner">
  @if($record->count() > 0)
  @foreach($record as $k => $value)
  <div class="item {{ ($k == 0) ? 'active' : '' }}">
    <img src="{{ url('storage/'.$value->attachments->first()->url) }}" alt="Ayokulakan">
    <div class="carousel-caption">
      <h3>{{ $value->judul or '' }}</h3>
    </div>
  </div>
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
<div class="info-boxes wow fadeInUp">
  <div class="info-boxes-inner">
    <div class="row">
      <div class="col-md-6 col-sm-4 col-lg-4">
        <div class="info-box">
          <div class="row">

            <div class="col-xs-12">
              <h5 class="info-box-heading green">100% Hasil pertanian yang segar</h5>
            </div>
          </div>
          <h6 class="text">langsung dari petaninya</h6>
        </div>
      </div><!-- .col -->

      <div class="hidden-md col-sm-4 col-lg-4">
        <div class="info-box">
          <div class="row">

            <div class="col-xs-12">
              <h5 class="info-box-heading green">100% Hasil perikanan yang segar</h5>
            </div>
          </div>
          <h6 class="text">langsung dari lautnya</h6>
        </div>
      </div><!-- .col -->

      <div class="col-md-6 col-sm-4 col-lg-4">
        <div class="info-box">
          <div class="row">

            <div class="col-xs-12">
              <h5 class="info-box-heading green">100% Hasil buah yang segar & alami</h5>
            </div>
          </div>
          <h6 class="text">langsung dari kebunnya </h6>
        </div>
      </div><!-- .col -->
    </div><!-- /.row -->
  </div><!-- /.info-boxes-inner -->

</div>

