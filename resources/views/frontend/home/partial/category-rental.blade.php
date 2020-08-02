<div class="sidebar-widget wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
<h3 class="section-title">JASA SEWA</h3>
    <div class="sidebar-widget-body">
        <div class="accordion">
            <div class="row">
            @php 
                $i = 0;
                $j = 0;
            @endphp
            @if($kategoriRental->count() > 0)
                @foreach($kategoriRental as $k => $value)
                    <div class="col-sm-6 col-lg-4 col-md-6 col-xs-12">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="{{ url('sc/cat-rental/amps/'.slugify($value->nama)) }}" class="">
                                   {{ $value->nama or '' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif            
        </div>
        </div>
    </div>
</div>
