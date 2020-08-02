<div class="form-group">
    <label for="{{ $inputName }}">{{ $labelName or 'Upload File' }} <span class="required">*</span></label>
    <input id="{{ $inputName }}" type="file" name="{{ $inputName }}" required="" autocomplete="off" accept="image/*"
        {{ $multi or '' }} data-url="{{ $url or '' }}">
</div>