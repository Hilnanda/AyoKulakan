<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
   @if($iklanDisc->count() > 0)
   @foreach($iklanDisc as $k => $value)
   <li data-target="#myCarousel" data-slide-to="{{$k}}" class="{{ ($k == 0) ? 'active' : '' }}"></li>
   @endforeach
   @endif
 </ol>

 <div class="carousel-inner">
  @if($iklanDisc->count() > 0)
  @foreach($iklanDisc as $k => $value)
  <div class="item {{ ($k == 0) ? 'active' : '' }}">
    <img src="{{ url('storage/'.$value->attachments->first()->url) }}" alt="Ayokulakan" style="display: block;margin-left: auto;margin-right: auto; height: 250px; object-fit:cover;">
    <div class="carousel-caption">
      <h3>{{ substr(strip_tags($value->deskripsi),0,70) }}</h3>
    </div>
  </div>
  @endforeach
  @endif
</div>

<a class="left carousel-control" href="#myCarousel" data-slide="prev">

</a>
<a class="right carousel-control" href="#myCarousel" data-slide="next">

</a>
</div>
