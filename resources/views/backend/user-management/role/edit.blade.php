<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">
	Edit {!! $title !!}
</div>
<div class="content">
	<form class="ui data form" id="dataForm" action="{{ url($pageUrl.$record->id) }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id }}">
		<div class="ui form">
			<div class="field">
				<label>Role</label>
				<input type="text" name="display_name" placeholder="Role Name" value="{{ $record->display_name or old('name') }}">
			</div>
			<div class="field">
				<label>Description</label>
				<textarea name="description" placeholder="Description">{!! $record->description or old('description') !!}</textarea>
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
