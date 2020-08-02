<div class="categori-menu admin">
	<span class="admin-menu-title">Menu</span>
	<nav class="custom-dropdown active">
		<ul class="categori-menu-admin">
			@foreach($items as $item)
			@if(!$item->hasChildren())
			<li>
				<a href="{!! $item->url() !!}" style="{{ isset($title) ? ($item->title == $title ? 'color:red' : '') : '' }}" tabindex="{{ $item->id }}">
					{!! $item->title !!} 
				</a>
			</li>
			@else

			<li class="custom-dropdownable">
				<a style="{{ isset($group) ? ($item->title == $group ? 'color:red' : '') : '' }}" class="{{ isset($group) ? ($item->title == $group ? 'active' : '') : '' }}" >
					{!! $item->title !!} 
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</a>
				
				<ul class="{{ isset($group) ? ($item->title == $group ? 'active' : '') : '' }}">
					@foreach ($item->children() as $k => $child)
					@if($child->hasChildren())
					<li class="custom-dropdownable">
						<a style="{{ isset($title) ? ($child->title == $subGroup ? 'color:red' : '') : '' }} " class="{{ isset($title) ? ($child->title == $subGroup ? 'active' : '') : '' }} ">
							{!! $child->title !!} 
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</a>
						<ul class="{{ isset($title) ? ($child->title == $subGroup ? 'active' : '') : '' }} ">
							@foreach ($child->children() as $grandChild)
							<li>
								<a href="{!! $grandChild->url() !!}" style="{{ $grandChild->title == $title ? 'color:red' : '' }}">
								{!! $grandChild->title !!}
								</a>
							</li>
							@endforeach
						</ul>
					</li>
					@else
					<li>
						<a href="{!! $child->url() !!}" style="{{ isset($title) ? ($child->title == $title ? 'color:red' : '') : '' }} ">
							{!! $child->title !!}
						</a>
					</li>
					@endif
					@endforeach	
				</ul>

			</li>
			@endif
			@endforeach
		</ul>
	</nav>
</div>
