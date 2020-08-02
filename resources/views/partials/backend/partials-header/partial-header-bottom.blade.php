<div class="header-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 hidden-md hidden-sm pull-left category-wrapper">
                <div class="categori-menu">
                    <span class="categorie-title">Categories</span>
                    <nav>
                        <ul class="categori-menu-list menu-hidden" style="display: {{ (auth()->guest()) ? '' : 'none'  }}; " >
                            @if($kategoriBarang->count() > 0)  

                            @foreach($kategoriBarang->get() as $key => $val)
                            <li>
                                <a href="{{ url('sc/cat-barang/amps/'.slugify($val->nama)) }}">
                                    <span><img src="{{ asset('ayokulakan/images/icons/11.png') }}" alt="menu-icon"></span>{{ $val->nama or '' }}
                                    @if($val->subkategori->count() > 0)
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    @endif
                                </a>
                                @if($val->subkategori->count() > 0)
                                <ul class="ht-dropdown megamenu ">
                                    <li class="single-megamenu">
                                        @foreach($val->subkategori as $kSub => $vSub)
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="{{ url('sc/cat-barang/mps/'.slugify($vSub->nama)) }}">
                                                    {{ $vSub->nama or '' }}
                                                    @if($vSub->childkategori->count() > 0)
                                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    @endif
                                                </a>
                                                @if($vSub->childkategori->count() > 0)
                                                @foreach($vSub->childkategori as $kChild => $vChild)
                                                <ul class="ct-dropdown megamenu">
                                                    <li class="single-megamenu">
                                                        <a href="{{ url('sc/cat-barang/spm/'.slugify($vChild->nama)) }}">
                                                            {{ $vChild->nama or '' }}
                                                        </a>
                                                    </li>
                                                </ul>
                                                @endforeach
                                                @endif
                                            </li>
                                        </ul>
                                        @endforeach
                                    </li>
                                </ul>
                                @endif

                            </li>
                            @endforeach
                            {{--  --}}
                            @endif

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="main-menu">
                    <nav>
                        <ul>
                            @if(isset($mainMenuFrontEnd))
                            @foreach($mainMenuFrontEnd->roots() as $key => $value)
                            <li><a href="{!! $value->url() !!}" style="{{ isset($title) ? ($value->title == $title ? 'color:red' : '') : '' }}" tabindex="{{ $value->id }}">{!! $value->title !!} <i class="{{ $value->icon }}"></i></a>
                            @if($value->hasChildren())
                            @if($value->tipe == 'three')
                            <ul class="megamenu-3-column">
                                @foreach ($value->children() as $k => $child)
                                <li><a style="{{ isset($title) ? ($child->title == $title ? 'color:red' : '') : '' }} ">{!! $child->title !!}</a>
                                <ul>
                                    @foreach ($child->children() as $grandChild)

                                    <li class="ampas"><a href="{!! $grandChild->url() !!}" style="{{ $grandChild->title == $title ? 'color:red' : '' }}">{!! $grandChild->title !!}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach 
                        </ul>
                        @else
                        <ul class="submenu">
                            @foreach ($value->children() as $k => $child)
                            <li><a href="{{$child->url()}}" style="{{ isset($title) ? ($child->title == $title ? 'color:red' : '') : '' }} ">{!! $child->title !!}</a>

                        </li>
                        @endforeach 
                    </ul>
                    @endif
                    @endif
                </li>
                @endforeach
                @endif
            </ul>
        </nav>
    </div>
    <div class="mobile-menu-area">
        <div class="mobile-menu">
            <nav id="mobile-menu-active">
                <ul class="menu-overflow">
                    @if(isset($mainMenuFrontEnd))
                    @foreach($mainMenuFrontEnd->roots() as $key => $value)
                    <li><a href="{!! $value->url() !!}" style="{{ isset($title) ? ($value->title == $title ? 'color:red' : '') : '' }}" tabindex="{{ $value->id }}">{!! $value->title !!} <i class="{{ $value->icon }}"></i></a>
                    @if($value->hasChildren())
                    @if($value->tipe == 'three')
                    <ul class="megamenu-3-column">
                        @foreach ($value->children() as $k => $child)
                        <li><a style="{{ isset($title) ? ($child->title == $title ? 'color:red' : '') : '' }} ">{!! $child->title !!}</a>
                        <ul>
                            @foreach ($child->children() as $grandChild)

                            <li class="ampas"><a href="{!! $grandChild->url() !!}" style="{{ $grandChild->title == $title ? 'color:red' : '' }}">{!! $grandChild->title !!}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach 
                </ul>
                @else
                <ul class="submenu">
                    @foreach ($value->children() as $k => $child)
                    <li><a href="{{$child->url()}}" style="{{ isset($title) ? ($child->title == $title ? 'color:red' : '') : '' }} ">{!! $child->title !!}</a>

                </li>
                @endforeach 
            </ul>
            @endif
            @endif
        </li>
        @endforeach
        @endif
    </ul>
</nav>                          
</div>
</div>
</div>
</div>
</div>
</div>