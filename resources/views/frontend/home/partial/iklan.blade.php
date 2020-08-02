{{-- slide promo --}}
<div class="wide-banners wow fadeInUp outer-bottom-xs animated" style="visibility: visible; animation-name: fadeInUp;">
<div class="wide-banner cnt-strip">
<div class="carousel slide" id="myCarousel" data-ride="carousel">
    <div class="carousel-inner">
        <div class="item active">
            <img class="img-responsive" src="{{ isset($promo->attachments) ? url('storage/'.$promo->attachments->first()->url) : asset('img/slider-ayokulakan.png') }}" alt="" style="height: 250px; object-fit:cover;">
            <div class="carousel-caption">
                <h2 class="text-right">Promo Terbaru<br>
                <span class="shopping-needs">Beli sekarang hayu</span></h2>
            </div>
        </div>
        <div class="item">
            <img class="img-responsive" src="{{ isset($promo->attachments) ? url('storage/'.$promo->attachments->first()->url) : asset('img/slider-ayokulakan.png') }}" alt="" style="height: 250px; object-fit:cover;">
            <div class="carousel-caption">
                <h2 class="text-right">Iklan<br>
                <span class="shopping-needs">Beli sekarang</span></h2>
            </div>
        </div>
        <div class="item">
            <img class="img-responsive" src="{{ isset($promo->attachments) ? url('storage/'.$promo->attachments->first()->url) : asset('img/slider-ayokulakan.png') }}" alt="" style="height: 250px; object-fit:cover;">
            <div class="carousel-caption">
                <h2 class="text-right">Diskon Barang Terbaru<br>
                <span class="shopping-needs">Beli sekarang</span></h2>
            </div>
        </div>
            {{-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a> --}}
        </div>
    </div>
</div>
{{-- <div class="wide-banners wow fadeInUp outer-bottom-xs animated" style="visibility: visible; animation-name: fadeInUp;">
<div class="row">

<div class="col-md-12 col-sm-12">
<div class="wide-banner cnt-strip">
<div class="image">
<img class="img-responsive" src="{{ isset($promo->attachments) ? url('storage/'.$promo->attachments->first()->url) : asset('img/slider-ayokulakan.png') }}" alt="" style="width: 100%; height: 250px; object-fit:cover;">
</div>
<div class="strip strip-text">
<div class="strip-inner">
<h2 class="text-right">Promo Terbaru<br>
<span class="shopping-needs">Beli sekarang hayu</span></h2>
</div>
</div>
<div class="new-label">
<div class="text">Baru</div>
</div><!-- /.new-label -->
</div><!-- /.wide-banner -->
</div><!-- /.col -->
</div><!-- /.row -->
</div> --}}
{{-- 
<div class="wide-banners wow fadeInUp outer-bottom-xs animated" style="visibility: visible; animation-name: fadeInUp;">
<div class="row">

<div class="col-md-12 col-sm-12">
<div class="wide-banner cnt-strip">
<div class="image">
<img class="img-responsive" src="{{ isset($iklan->attachments) ? url('storage/'.$iklan->attachments->first()->url) : asset('img/slider-ayokulakan.png') }}" alt="" style="width: 100%; height: 250px; object-fit:cover;">
</div>
<div class="strip strip-text">
<div class="strip-inner">

</div>
</div>
<div class="new-label">
<div class="text">Baru</div>
</div><!-- /.new-label -->
</div><!-- /.wide-banner -->
</div><!-- /.col -->
</div><!-- /.row -->
</div>

<div class="wide-banners wow fadeInUp outer-bottom-xs animated" style="visibility: visible; animation-name: fadeInUp;">
<div class="row">

<div class="col-md-12 col-sm-12">
<div class="wide-banner cnt-strip">
<div class="image">
<img class="img-responsive" src="{{ isset($diskon->attachments) ? url('storage/'.$diskon->attachments->first()->url) : asset('img/slider-ayokulakan.png') }}" alt="" style="width: 100%; height: 250px; object-fit:cover;">
</div>
<div class="strip strip-text">
<div class="strip-inner">
<h2 class="text-right">Diskon Barang Terbaru<br>
<span class="shopping-needs">Beli sekarang</span></h2>
</div>
</div>
<div class="new-label">
<div class="text">Baru</div>
</div><!-- /.new-label -->
</div><!-- /.wide-banner -->
</div><!-- /.col -->
</div><!-- /.row -->
</div> --}}
