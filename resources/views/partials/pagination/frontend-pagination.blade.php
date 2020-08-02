@if ($paginator->lastPage() > 1)
	<ul class="pagination">
		@for ($i = 1; $i <= $paginator->lastPage(); $i++)
			<li>
				@if($paginator->currentPage() == $i)
					<a href="javascript:void(0)" class="active" style="background-color: black;">{{ $i }} <span class="sr-only">(current)</span></a>
				@else
					<a href="{{ $paginator->url($i) }}" class="page-numbers">{{ $i }}</a>
				@endif
			</li>	
		@endfor
		<li><a class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }} page-numbers" href="{{ $paginator->url($paginator->currentPage()+1) }}">→</a></li>
	</ul>
@endif


