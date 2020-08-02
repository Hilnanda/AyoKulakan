<div class="ui top attached segment">
  <a href="javascript:void(0)" class="ui red ribbon label">{{ $label or 'Lampiran' }}</a>
  <div id="lampiran-area">
    @include('partials.file-tab.exist-file.lampiran')
  </div>
  <div class="ui inline grid field" style="width: 100%">
    <div class="sixteen wide column" style="padding: .5rem 0">
      <div class="ui fluid file input action">
        <input type="text" readonly>
        <input type="file" class="six wide column" name="file[]" autocomplete="off">
        <div class="ui button file">
          Cari...
        </div>
        
      </div>
    </div>
  </div>
</div>

