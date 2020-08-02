<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">
	Create {!! $title !!}
</div>
<div class="content">
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl) }}" method="POST">
		{!! csrf_field() !!}
		<div class="ui form">
			<div class="field">
				<label>Role</label>
				<input type="text" name="display_name" placeholder="Role Name" value="{{ old('display_name') or '' }}">
			</div>
			<div class="field">
				<label>Description</label>
				<textarea name="description" placeholder="Description">{!! old('description') or '' !!}</textarea>
			</div>
		</div>
	</form>
</div>
<div class="actions">
	<div class="ui black deny button">
		Cancel
	</div>
	<div class="ui positive right labeled icon save button">
		Save
		<i class="save icon"></i>
	</div>
</div>
