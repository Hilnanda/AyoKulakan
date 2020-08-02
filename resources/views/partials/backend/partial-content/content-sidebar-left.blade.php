<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs" style="">
    <h3 class="section-title">Filter Kondisi Barang</h3>
    @if (isset($input))
    <div class="sidebar-widget-body outer-top-xs">
        <div class="custom-control custom-checkbox mr-sm-2">
            <input type="checkbox" name="asc" value="{{ $input }}" class="custom-control-input" id="baru">
            <label class="custom-control-label" for="customControlAutosizing">Baru</label>
        </div>
        <div class="custom-control custom-checkbox mr-sm-2">
            <input type="checkbox" name="desc" value="{{ $input }}" class="custom-control-input" id="bekas">
            <label class="custom-control-label" for="customControlAutosizing1">Bekas</label>
        </div>
    </div>
    @else
    <div class="sidebar-widget-body outer-top-xs">
        <div class="custom-control custom-checkbox mr-sm-2">
            <input type="checkbox" name="ampas_kondisi[]" value="Baru" class="custom-control-input" id="customControlAutosizing">
            <label class="custom-control-label" for="customControlAutosizing">Baru</label>
        </div>
        <div class="custom-control custom-checkbox mr-sm-2">
            <input type="checkbox" name="ampas_kondisi[]" value="Bekas" class="custom-control-input" id="customControlAutosizing1">
            <label class="custom-control-label" for="customControlAutosizing1">Bekas</label>
        </div>
    </div>
    @endif
</div>
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs" style="">
    <h3 class="section-title">Filter Wilayah</h3>
    <div class="input-group mb-3">
        <div class="form-group" style="">
            <label for="">Wilayah Provinsi</label>
            <select name="id_provinsi" class="form-control child-new target-new dynamic-more-than-5-select custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_kota" style="">
                <option value="Current_Location">Current Location</option>
                {!! \App\Models\Master\WilayahProvinsi::options('provinsi', 'id', [], ('Pilih Wilayah Provinsi')) !!}
            </select>                   
        </div>      
        <div class="form-group" style="">
            <label for="">Wilayah Kab / Kota</label>
            <input type="hidden" name="utk_rental" value="barang">
            <select class="form-control child target id_kota selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" style="">
            </select>   
            <div id="id_kota">

            </div>                  
        </div>  
    </div>    
</div>
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs" style="">
    <h3 class="section-title">Filter Harga</h3>
    <div class="input-group mb-3">
        <select class="custom-select" name="ampas_money_kondisi">
            <option value="">Kondisi</option>
            <option value=">">Lebih Dari</option>
            <option value="<">Kurang Dari</option>
        </select>
        <input type="text" class="change-money-page form-control" name="ampas_money" data-money='ampas_min' placeholder="Harga" required="" min="0">
        <div class="price-values pull-right">
            <button class="button btn btn-small btn-success ampas_moneys" type="button">Filter</button>
        </div>
    </div> 

</div>