<div class="header-bottom-area">
    <div class="container">
        <div class="row">
           
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