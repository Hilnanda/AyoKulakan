@section('content-breadcrumb-header')
<div class="breadcrumbs-container">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h3>{!! $title or '-' !!}</h3>
      </div>
      <div class="col-sm-6">
        <nav class="woocommerce-breadcrumb pull-right" style="position: relative;top: 25px;">

          <?php $i=1; $last=count($breadcrumb);?>
          @foreach ($breadcrumb as $name => $link)
          @if($i++ != $last)
          <a >{{ $name }}</a>
          <i class="fa fa-angle-right"></i>
          @else
          <a >{{ $name }}</a>
          @endif
          @endforeach

        </nav>
      </div>
    </div>
  </div>
</div>
@show