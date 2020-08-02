<div class="ui top attached segment">
  <a href="javascript:void(0)" class="ui red ribbon label">Foto</a>
  <div id="foto-area">
      @include('partials.file-tab.exist-file.foto')
  </div>
  <div class="ui inline grid field" style="width: 100%">
    <div class="sixteen wide column" style="padding: .5rem 0">
      <div class="ui fluid file input action">
        <input type="text" readonly>
        <input type="file" class="six wide column" name="attachment[]" autocomplete="off" accept="image/*">
        <div class="ui button file">
          Cari...
        </div>
      </div>
    </div>
  </div>
</div>
