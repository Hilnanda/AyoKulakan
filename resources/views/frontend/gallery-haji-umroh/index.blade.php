@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
formRules = {
    judul: ['empty'],
};
</script>
@endsection

@section('content-frontend')

	<main class="outer-top"></main>
    <div id="product-tabs-slider" class="container scroll-tabs outer-top-vs wow fadeInUp">
        <a href="{{ url('/') }}" style="font-size:30px; color:orange; !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="more-info-tab clearfix ">
        <h3 class="new-product-title pull-left">Gallery Sosial Keagamaan</h3>
    </div>
    <div class="search-result-container ">
        <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
                <div class="category-product">
                    <div class="row">
                    @if($record->count() > 0)
                        @foreach($record as $k => $v)
                         <div class="col-6 col-xs-6 col-md-2 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;width:207;">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            @if($v->attachments->count() > 0)
                                                <a href="{{ url('storage/'.$v->attachments->first()->url) }}" title="" target="_blank"><img src="{{ url('storage/'.$v->attachments->first()->url) }}" alt="" style="height: 79px; width: 159px"></a>
                                            @else
                                                <a href="{{ asset('img/no-images.png') }}" title="" target="_blank"><img src="{{ asset('img/no-images.png') }}" alt="" style="height: 79px; width: 159px"></a>
                                            @endif
                                        </div>
                                        <!-- <div class="tag new"><span>new</span></div> -->
                                    </div>
                                    <!-- <div class="product-info text-left">
                                        <h3 class="name">{{ $v->deskripsi or '' }}</h3>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
