<div class="clearfix filters-container m-t-10">
    <div class="row">
        <div class="col col-sm-8 col-lg-12">
            <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                    <li class="active">
                        <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Kategori</a>
                    </li>
                </ul>
            </div><!-- /.filter-tabs -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

<div class="search-result-container ">
    <div id="myTabContent" class="tab-content category-list">
        <div class="tab-pane active " id="grid-container">
            <div class="category-product" style="height: 500px;overflow-x: hidden;overflow-y: auto;">
                    <div class="row">
                        @if($kategoriBarang->count() > 0)
                        @foreach($kategoriBarang->get() as $key => $val)
                        <div class="col-6 col-xs-6 col-md-3 mb-3" id="togles-kategori">
                            <div class="card">
                                <div class="card-body text-center">
                                        <div class="card-text">
                                            <a href="{{ url('sc/cat-barang/amps/'.slugify($val->nama)) }}"
                                                style="padding: 8px 0px">
                                                <img src="{{ ($val->attachments) ? url('storage/'.$val->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px">
                                                <p class="title">{{ $val->nama or '' }}</p>
                                            </a>
                                        </div>
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
<br>
<ul class="links"
style="list-style: disc;position: relative;left: 20px; display:none !important">
@if($val->subkategori->count() > 0)
@foreach($val->subkategori as $kSub => $vSub)
<li>
    <a href="{{ url('sc/cat-barang/mps/'.slugify($vSub->nama)) }}"
        style="color: #666;">
        {{ $vSub->nama or '' }}
    </a>
</li>
@endforeach
@endif
</ul>