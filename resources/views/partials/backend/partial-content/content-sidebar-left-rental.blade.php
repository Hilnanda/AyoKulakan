<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">Filter Nama Sewa</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="input-group">
            <input type="text" name="filter[nama]" class="form-control" placeholder="Search" aria-label="" aria-describedby="" style="height: 40px">&nbsp;
        </div>
    </div>
</div>
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs" style="z-index: 11">
    <h3 class="section-title">Filter Wilayah</h3>
    <div class="form-group">
        <label for="">Wilayah Provinsi</label>
        <select name="id_provinsi_rental" class="form-control child-new target-new dynamic-more-than-5-select custom-select " required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_kota">
            {!! \App\Models\Master\WilayahProvinsi::options('provinsi', 'id', [], ('Pilih Wilayah Provinsi')) !!}
        </select>                   
    </div>      
    <div class="form-group">
        <label for="">Wilayah Kota</label>
        <input type="hidden" name="utk_rental" value="rental">
        <select class="form-control child-new target-new id_kota custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none">
        </select>   
        <div id="id_kota">

        </div>                  
    </div>      
</div>
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">Filter Harga</h3>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text">Rp.</label>
        </div>
        <select class="custom-select" name="ampas_money_kondisi">
            <option value="">Kondisi</option>
            <option value=">">Lebih Dari</option>
            <option value="<">Kurang Dari</option>
        </select>
        <input type="text" class="change-money-page" name="ampas_money" data-money='ampas_min' placeholder="Harga" required="" min="0">
        <div class="price-values">

            <button class="button ampas_rental" type="button">Filter</button>
        </div>
    </div>    
</div>

