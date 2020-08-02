<style>
    .yamm .dropdown-menu .yamm-content .links li a {
        padding: 5px 10px;
        padding-top: 5px;
        padding-right: 10px;
        padding-bottom: 5px;
        padding-left: 10px;
        font-family: 'Open Sans', sans-serif;
        letter-spacing: 0.2px;
        font-size: 13px;
        color: #565656;
    }

</style>
<script type="text/javascript">
    $(document).ready(function() {
        $(window).scroll(function() {
            var maxScroll = document.documentElement.scrollHeight;
            var miniScroll = maxScroll - document.documentElement.scrollTop;
            var currentScroll = document.documentElement.scrollTop;
            if ((document.documentElement.scrollTop + 1000) >= maxScroll) {
                $("#myBtn").attr("style", "display:none");
                $("#myBtn2").attr("style", "display:none");
            } else {
                $("#myBtn").attr("style", "display:block");
                $("#myBtn2").attr("style", "display:block");
            }
            if (document.documentElement.scrollTop == 0) {
                $("#myBtn").attr("style", "display:none");
            }

        });

        if ($("#map").length > 0) {
          let map = new GMaps({
              div: '#map',
              lat: -12.043333,
              lng: -77.028333
           });

           GMaps.geolocate({
              success: function(position) {
                map.setCenter(position.coords.latitude, position.coords.longitude);
              },
              error: function(error) {
                swal("Info","Lokasi Anda Tidak Ditemukan","error");
              },
              not_supported: function() {
                swal("Info","Browser Anda Tidak Support Geolokasi","error");
              },
              always: function(e) {

              }
            });

            $("#gmaps_center").on("click", function(event) {
              GMaps.geolocate({
                 success: function(position) {
                   map.setCenter(position.coords.latitude, position.coords.longitude);
                 },
                 error: function(error) {
                   swal("Info","Lokasi Anda Tidak Ditemukan","error");
                 },
                 not_supported: function() {
                   swal("Info","Browser Anda Tidak Support Geolokasi","error");
                 },
                 always: function(e) {

                 }
               });
            })

            $("#gmaps_cari").on("click", function(event) {
              GMaps.geocode({
                address: $('#gmaps_lokasi').val(),
                callback: function(results, status) {
                  if (results.length  > 0) {
                    if (status == 'OK') {
                      var latlng = results[0].geometry.location;
                      map.setCenter(latlng.lat(), latlng.lng());
                      map.addMarker({
                        lat: latlng.lat(),
                        lng: latlng.lng()
                      });
                    }
                  }else {
                    $.post("{{route("maps.cari_kl")}}",{nama_kl:$('#gmaps_lokasi').val()},function(r){
                      
                      if (r.code == 200) {
                        map.setCenter(r.data.lat, r.data.lng);
                        map.addMarker({
                          lat: r.data.lat,
                          lng: r.data.lng
                        });
                      }else {
                        swal("Info","Data Kaki Lima / Mesjid Tidak Ditemukan","error");
                      }
                    }).fail(function(e){
                      swal(JSON.stringify(e));
                    });
                  }
                }
              });
            })
        }

    });


    $(document).ready(function() {
        $("#ppob_telpon_rumah").on("submit", function(event) {
            $.post("{{route("ppob.telepon_rumah")}}",$(this).serializeArray(),function(r){
              if (r.rescode == 00) {
                $("#ppob_telpon_rumah_result").removeAttr("style");
                $("#ppob_telpon_rumah_result").find(".napel").val(r.data.nama_pelanggan);
                $("#ppob_telpon_rumah_result").find(".juta").val(r.data.jumlah_tagihan);
                $("#ppob_telpon_rumah_result").find(".periode").val(r.data.bulan_thn);
              }else {
                swal("Info","Tagihan Tidak Ditemukan","info");
              }
            })
        });
        var getImageFromUrl = function(url, callback) {
              var img = new Image();
              img.onerror = function() {
                console.log('error',callback);
                swal(
                    'Gagal!',
                    'Data Avatar Profile / Profile Tidak Ditemukan',
                    'error'
                    );
            };
            img.onload = function() {
              callback(img);
          };
          img.src = url;
        }


        var createPDF = function(imgData) {
            var doc = new jsPDF('p', 'pt', [207, 340]);
            doc.addImage(imgData, 'JPEG', 0, 0, 207, 340);
            @if(Auth::check())
            doc.save("IDCARD_{{auth()->user()->nama}}.pdf");
            @endif
        }


        $(document).on("click", "#downloadImg", function(event) {
            val = $(this).data("url");
            getImageFromUrl(val, createPDF);
        })
    });






    function showFormErrorFrontEnd(dataForm, index, val) {
        console.log('dataForm',dataForm);
        if(index.includes("."))
        {
            res = index.split('.');
            index = '';
            for(i=0; i < res.length; i++)
            {
                if(i == 0)
                {
                    res[i] = res[i];
                }else{
                    if(res[i] == 0)
                    {
                        res[i] = '\\[\\]';
                    }else{
                        res[i] = '['+res[i]+']';
                    }
                }
                index += res[i];
            }
        }
        var name = index.split('.').reduce((all, item) => {
                        all += (index == 0 ? item : '[' + item + ']');
                        return all;
                    });
        console.log('name',name);
        var fg = $('[name="'+ name +'"], [name="'+ name +'[]"]').closest('.form-group');
        fg.addClass('has-error');
        fg.append('<p class="text-danger errors labels" style="position: relative;bottom: 2px;">' + val + '</p>')

    }

    function capitalize(str) {
        strVal = '';
        str = str.split(' ');
        for (var chr = 0; chr < str.length; chr++) {
            if (chr === 0) {
                strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' ';
            } else {
                strVal += str[chr].substring(0, 1) + str[chr].substring(1, str[chr].length) + ' ';
            }
        }
        return strVal
    }

    function clearFormErrorFrontEnd(dataForm, key, value) {


        if (key.includes(".")) {
            res = key.split('.');
            key = '';
            for (i = 0; i < res.length; i++) {
                if (i == 0) {
                    res[i] = res[i];
                } else {
                    if (res[i] == 0) {
                        res[i] = '\\[\\]';
                    } else {
                        res[i] = '[' + res[i] + ']';
                    }
                }
                key += res[i];
            }
        }
        var elm = $('#' + dataForm + ' [name="' + key + '"]').closest('.form-group');
        $(elm).removeClass('error');

        var showerror = $('#' + dataForm + ' [name="' + key + '"]').closest('.form-group').find('.text-danger.errors.labels').remove();
    }

    function sendQeueu() {
      $.ajax({
        url: '{{ url("ampas") }}',
        type: 'GET',
        success: function(resp){
        },
        error : function(resp){
        }
      });
    }

    $(document).on('click', '.custom-file-label', function(e) {
        $(e.target).parent().find('input:file').click();
    });

    $(document).on('change', '.custom-file input:file', function(e) {
        var file = $(e.target);
        var name = '';

        for (var i = 0; i < e.target.files.length; i++) {
            name += e.target.files[i].name + ', ';
        }
        // remove trailing ","
        name = name.replace(/,\s*$/, '');
        $('label', file.parent()).html(name);
    });

    $('.summernote').summernote({
          height : 270,
          toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
        ]
    });
    // search categori
    function getcategory(cat_id='' ,harga='', rendah='', kon='')
    {
      $.ajax({
        type: 'GET',
        url: '{{ url("sc/aj-cat") }}',
        data: {cat_id:cat_id,harga:harga,rendah:rendah,kon:kon},
        success: function(resp){
        $('.product-search-ampas').html(resp);

        },
      });
    }
    $(document).on('change','#select',function(){
      var categ = $(this).val();
      var harga = $(this).find(':selected').attr('data-sorts');
      var rendah = $(this).find(':selected').attr('id');
      console.log(rendah);
      getcategory(categ, harga, rendah);

    });
    $(document).on('click','.custom-control-input',function(){
      var cat_id = '';
      var harga = $(this).attr('name');
      var rendah = $(this).attr('id');
      var kon = $(this).val();
      console.log(harga);
      getcategory(cat_id, harga, rendah, kon);

    });
    // tutup serch kategori
    // SEARCH BARANG
    function getSearch(search = '',ampasOrder = '', ampasOrderVal = '', ampasCategories = '',ampasId = '',ampasNama = '',ampasKondisi = [], ampasWilayah = [], ampasHarga = '', currentLoca = ''){
        $.ajax({
            url: '{{ url("sc/aj-barang") }}',
            type: 'GET',
            data : {
              search_ampas:search,
              ampasOrder:ampasOrder,
              ampasOrderVal:ampasOrderVal,
              ampasCategories:ampasCategories,
              ampasId:ampasId,
              ampasNama:ampasNama,
              ampasKondisi:ampasKondisi,
              ampasWilayah:ampasWilayah,
              ampasHarga:ampasHarga,
              currentLoca:currentLoca,
            },
            success: function(resp){
              $('.product-search-ampas').html(resp);
            },
            error : function(resp){
            }
        });
    }

    $(document).on('change', 'select[name="orders_barang"]', function() {
        console.log('ampas-order')
        
        var ampasOrder = $(this).val();
        var ampasOrderVal = $(this).find(':selected').attr('data-sorts')
        var ampasSearch = $('input[name="search_ampas_hidden"]').val();
        getSearch(ampasSearch, ampasOrder, ampasOrderVal);
    });

    $(document).on('click', '.ampas-categories', function() {
        console.log('ampas-categories')
        var ampasOrder = $('select[name="orders_barang"]').val();
        var ampasOrderVal = $('select[name="orders_barang"]').find(':selected').attr('data-sorts')
        var ampasSearch = $('input[name="search_ampas_hidden"]').val();

        var ampasCategories = $(this).data('categories');
        var ampasId = $(this).data('idcateg');
        var ampasNama = $(this).data('categ');

        $('.ampas-categories').css('color', '');
        $(this).css('color', 'red');

        var ampasKondisiClone = $('input[name^="ampas_kondisi"]').serializeArray();
        var ampasKondisi = $.map(ampasKondisiClone, function(v, k) {
            return v.value;
        });

        var ampasProvinsi = $('select[name="id_provinsi"]').val();
        var ampasKot = $('select[name="id_kota"]').val();
        var ampasWilayah = {
            ampasProvinsi: ampasProvinsi
            , ampasKot: ampasKot
        };

        getSearch(ampasSearch, ampasOrder, ampasOrderVal, ampasCategories, ampasId, ampasNama, ampasKondisi, ampasWilayah);
    });
    // $('document').ready(function(){
    //   $('#findBtn').on('click',function(){
    //     var cat = $('#cat-id').val();
    //     alert(cat);
    //   });
    // });

    $(document).on('click', 'input[name^="ampas_kondisi"]', function() {
        console.log('ampas kondisi')
        var ampasOrder = $('select[name="orders_barang"]').val();
        var ampasOrderVal = $('select[name="orders_barang"]').find(':selected').attr('data-sorts')
        var ampasSearch = $('input[name="search_ampas_hidden"]').val();
        //

        var ampasCategories = $('.ampas-categories.active').data('categories');
        var ampasId = $('.ampas-categories.active').data('idcateg');
        var ampasNama = $('.ampas-categories.active').data('categ');

        var ampasKondisiClone = $('input[name^="ampas_kondisi"]').serializeArray();
        var ampasKondisi = $.map(ampasKondisiClone, function(v, k) {
            return v.value;
        });

        var ampasProvinsi = $('select[name="id_provinsi"]').val();
        var ampasKot = $('select[name="id_kota"]').val();
        var ampasWilayah = {
            ampasProvinsi: ampasProvinsi
            , ampasKot: ampasKot
        };

        getSearch(ampasSearch, ampasOrder, ampasOrderVal, ampasCategories, ampasId, ampasNama, ampasKondisi, ampasWilayah);
    });

    $(document).on('change', 'select[name="id_provinsi"]', function() {
        var ampasOrder = $('select[name="orders_barang"]').val();
        var ampasOrderVal = $('select[name="orders_barang"]').find(':selected').attr('data-sorts')
        var ampasSearch = $('input[name="search_ampas_hidden"]').val();

        var ampasCategories = $('.ampas-categories.active').data('categories');
        var ampasId = $('.ampas-categories.active').data('idcateg');
        var ampasNama = $('.ampas-categories.active').data('categ');

        var ampasKondisiClone = $('input[name^="ampas_kondisi"]').serializeArray();
        var ampasKondisi = $.map(ampasKondisiClone, function(v, k) {
            return v.value;
        });

        var ampasProvinsi = $('select[name="id_provinsi"]').val();
        var ampasWilayah = {
            ampasProvinsi: ampasProvinsi
        };

        if (ampasProvinsi == 'Current_Location') {
            var ipData = $.getJSON('https://ipapi.co/json/', function(data) {

                getSearch(ampasSearch, ampasOrder, ampasOrderVal, ampasCategories, ampasId, ampasNama, ampasKondisi, ampasWilayah, '', data.city);
            });
        } else {
            getSearch(ampasSearch, ampasOrder, ampasOrderVal, ampasCategories, ampasId, ampasNama, ampasKondisi, ampasWilayah);
        }

    });

    $(document).on('change', 'select[name="id_kota"]', function() {
        if ($('input[name="utk_rental"]').val() == 'barang') {
            var ampasOrder = $('select[name="orders_barang"]').val();
            var ampasOrderVal = $('select[name="orders_barang"]').find(':selected').attr('data-sorts')
            var ampasSearch = $('input[name="search_ampas_hidden"]').val();

            var ampasCategories = $('.ampas-categories.active').data('categories');
            var ampasId = $('.ampas-categories.active').data('idcateg');
            var ampasNama = $('.ampas-categories.active').data('categ');

            var ampasKondisiClone = $('input[name^="ampas_kondisi"]').serializeArray();
            var ampasKondisi = $.map(ampasKondisiClone, function(v, k) {
                return v.value;
            });

            var ampasProvinsi = $('select[name="id_provinsi"]').val();
            var ampasKot = $('select[name="id_kota"]').val();
            var ampasWilayah = {
                ampasProvinsi: ampasProvinsi
                , ampasKot: ampasKot
            };

            getSearch(ampasSearch, ampasOrder, ampasOrderVal, ampasCategories, ampasId, ampasNama, ampasKondisi, ampasWilayah);
        }
    });

    $(document).on('click', '.button.ampas_moneys', function() {
        var ampasOrder = $('select[name="orders_barang"]').val();
        var ampasOrderVal = $('select[name="orders_barang"]').find(':selected').attr('data-sorts')
        var ampasSearch = $('input[name="search_ampas_hidden"]').val();

        var ampasCategories = $('.ampas-categories.active').data('categories');
        var ampasId = $('.ampas-categories.active').data('idcateg');
        var ampasNama = $('.ampas-categories.active').data('categ');

        var ampasKondisiClone = $('input[name^="ampas_kondisi"]').serializeArray();
        var ampasKondisi = $.map(ampasKondisiClone, function(v, k) {
            return v.value;
        });

        var ampasProvinsi = $('select[name="id_provinsi"]').val();
        var ampasKot = $('select[name="id_kota"]').val();
        var ampasWilayah = {
            ampasProvinsi: ampasProvinsi
            , ampasKot: ampasKot
        };

        var ampasUang = $('input[name="ampas_money"]').val();
        var ampasHargaKondisi = $('select[name="ampas_money_kondisi"]').val();
        var ampasHarga = {
            ampasUang: ampasUang
            , ampasHargaKondisi: ampasHargaKondisi
        };
        getSearch(ampasSearch, ampasOrder, ampasOrderVal, ampasCategories, ampasId, ampasNama, ampasKondisi, ampasWilayah, ampasHarga);
    });

    // END SEARCH BARANG

    // SEARCH RENTAL
    function getSearchRental(search = ''){
      $.ajax({
        url: '{{ url("sc/aj-rental") }}',
        type: 'GET',
        data : search,
        success: function(resp){
          $('.product-search-ampas').html(resp);
        },
        error : function(resp){
        }
      });
    }

    $(document).on('click', '.ampas-categories-rental', function() {
        var ampasCategories = $(this).data('categories');
        var ampasId = $(this).data('idcateg');
        var ampasNama = $(this).data('categ');
        if (ampasCategories == 'kategori') {
            var search = {
                kategori_id: ampasId
            };
        } else {
            var search = {
                sub_kategori_id: ampasId
            };
        }
        $('.ampas-categories-rental').css('color', '');
        $(this).css('color', 'red');
        getSearchRental(search);

    });

    $(document).on('click', '.button.ampas_rental', function() {
        var ampasOrder = $('select[name="orders_barang"]').val();
        var ampasOrderVal = $('select[name="orders_barang"]').find(':selected').attr('data-sorts')
        var ampasSearch = $('input[name="search_ampas_hidden"]').val();

        var ampasCategories = $('.ampas-categories-rental.active').data('categories');
        var ampasId = $('.ampas-categories-rental.active').data('idcateg');
        var ampasNama = $('.ampas-categories-rental.active').data('categ');

        var ampasProvinsi = $('select[name="id_provinsi_rental"]').val();
        var ampasKot = $('select[name="id_kota"]').val();
        var ampasTitle = $('input[name="filter[nama]"]').val();

        var ampasUang = $('input[name="ampas_money"]').val();
        var ampasHargaKondisi = $('select[name="ampas_money_kondisi"]').val();
        if(ampasCategories == 'kategori'){
            var search = {
                kategori_id:ampasId,
                judul:ampasTitle,
                harga_sewa:ampasUang,
                harga_kondisi:ampasHargaKondisi,
                id_provinsi:ampasProvinsi,
                id_kota:ampasKot
            };
        }else{
            var search = {
                sub_kategori_id:ampasId,
                judul:ampasTitle,
                harga_sewa:ampasUang,
                harga_kondisi:ampasHargaKondisi,
                id_provinsi:ampasProvinsi,
                id_kota:ampasKot
            };
        }
        getSearchRental(search);
        
    });

    $(document).on('change', 'select[name="orders_rental"]', function() {
        var ampasOrder = $('select[name="orders_rental"]').val();
        var ampasOrderVal = $('select[name="orders_rental"]').find(':selected').attr('data-sorts')
        var ampasSearch = $('input[name="search_ampas_hidden"]').val();

        var ampasCategories = $('.ampas-categories-rental.active').data('categories');
        var ampasId = $('.ampas-categories-rental.active').data('idcateg');
        var ampasNama = $('.ampas-categories-rental.active').data('categ');

        var ampasProvinsi = $('select[name="id_provinsi_rental"]').val();
        var ampasKot = $('select[name="id_kota"]').val();
        var ampasTitle = $('input[name="filter[nama]"]').val();

        var ampasUang = $('input[name="ampas_money"]').val();
        var ampasHargaKondisi = $('select[name="ampas_money_kondisi"]').val();
        if(ampasCategories == 'kategori'){
            var search = {
                kategori_id:ampasId,
                judul:ampasTitle,
                harga_sewa:ampasUang,
                harga_kondisi:ampasHargaKondisi,
                id_provinsi:ampasProvinsi,
                id_kota:ampasKot,
                ampasOrder:ampasOrder,
                ampasOrderVal:ampasOrderVal
            };
        }else{
            var search = {
                sub_kategori_id:ampasId,
                judul:ampasTitle,
                harga_sewa:ampasUang,
                harga_kondisi:ampasHargaKondisi,
                id_provinsi:ampasProvinsi,
                id_kota:ampasKot,
                ampasOrder:ampasOrder,
                ampasOrderVal:ampasOrderVal
            };
        }
        getSearchRental(search);
    });
    // END SEARCH RENTAL

    // FOR CART
    $(document).on('click', '.show-front.shows', function(e) {
        var url = $(this).data('url');
        loadModal(url);
    });

    $(document).on('click', '.ampass.add-cart', function() {
        @if(\Auth::check())
        var jml = $('input[name="quantity"]').val();
        var type = $(this).data('type');
        if (jml == undefined) {
            jml = 1;
        }
        var url = "{{ url('keranjang') }}/" + $(this).data('item') + '/' + jml + '/' + type;
        loadModal(url);
        @else
        location.href = "{{ url('login') }}";
        @endif
    });

    $(document).on('click', '.ampass.add-cart-sewa', function() {
        @if(\Auth::check())
        var jml = $('input[name="quantity"]').val();
        var type = $(this).data('type');
        if (jml == undefined) {
            jml = 1;
        }
        var url = "{{ url('keranjang-sewa') }}/" + $(this).data('item') + '/' + jml + '/' + type;
        loadModal(url);
        @else
        location.href = "{{ url('login') }}";
        @endif
    });

    $(document).on('click', '.ampass.remove-cart', function(e){
        swal({
            title: 'Hapus Barang !!!',
            text: "Yakin Untuk Menghapus Nama Barang "+$(this).data('name')+" ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result) {
              $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data: {_token: "{{ csrf_token() }}", _method: "POST", id:$(this).data('id')},
                success: function(resp){
                  swal(
                    'Terhapus!',
                    'Data Berhasil Di Hapus.',
                    'success'
                    ).then(function(e){
                      window.location.reload();
                  });
                },
                error : function(resp){
                    swal(
                      'Gagal!',
                      'Data gagal dihapus, karena sedang dipakai',
                      'error'
                      );
                }
             });
            }
        });
    });

    $(document).on('.front-ampass-jml keyup change','.front-ampass-jml',function(){
      if($(this).val() == ''){
        $('.appendTotalHarga'+$(this).data('key')).html($(this).data('harga'));
        $('.front-ampass-jml').val(1);
      }
      $('.appendTotalHarga'+$(this).data('key')).html('Rp. '+parseInt($(this).data('harga')) * parseInt($(this).val()));
      if($('input[name^="accept[barang]"]').serializeArray().length > 0){
        var data = $('input[name^="accept[barang]"]').serializeArray();
        var hasil = 0;
        $.each(data,function(k,v){
          hasil += parseInt($('.appendTotalHarga'+v.value).text().substring(3));
        });
        $('.sub-total').html(hasil);
      }
    });

    $(document).on('change', 'input[name^="accept[barang]"]', function() {
        var data = $('input[name^="accept[barang]"]').serializeArray();
        var hasil = 0;
        $.each(data, function(k, v) {
            hasil += parseInt($('.appendTotalHarga' + v.value).text().substring(3));
        });
        $('.sub-total').html(hasil);
    });

    // PPOB DATA PULSA, PAKET DATA, VOUCHER
    $(document).on('click', '.nav-item', function() {
        $('input[name^="ppob_pelanggan"]').val('');
        $('select[name^="id_barang"]').val('');
    });

    function PPOBNo(elemchild, name, type, val) {
        $.ajax({
            url: '{{ url("option") }}/'+ elemchild +'/'+type+'/'+ val,
            type: 'GET',
            success: function(resp){
              
              if(resp.length > 0){
                var res = JSON.parse(resp);
                var hasil = '<option value="">Pilih Nominal Data '+res.data[0].pulsa_op+'</option>';
                $.each(res.data,function(k,v){
                  hasil += `
                  <option value="`+v.pulsa_code+`">`+v.pulsa_op+` - `+v.pulsa_nominal+` - `+convertToRupiah(v.pulsa_price)+`</option>
                  `;
                });
                $('body').find('.'+elemchild+'').remove();
                $('#'+elemchild).html('<select name="'+name+'" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >'+ hasil +'</select>');
                $('.selectpicker').selectpicker();
              }
            },
            error : function(resp){
              
              if(resp.responseJSON.dataPpob){
                swal(
                    'Gagal!',
                    ''+resp.responseJSON.dataPpob.message,
                    'error'
                    );
              }

            }
        });
    }
    
    function convertToRupiah(angka)
    {
    	var rupiah = '';		
    	var angkarev = angka.toString().split('').reverse().join('');
    	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    	return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
    }

    $(document).on('keyup', '.child.childSelect', function() {
        var no = $(this).val().substring(0, 4);
        var type = $(this).data('type');


        if (no != '') {
            PPOBNo($(this).data('child'), $(this).data('nama'), type, no)
        } else {
            $('.show-PPOB-Pulsa').hide();
            $('.show-PPOB-Pulsa').html('');
        }
    });

    $(document).on('click', '.tab-menu-ampas', function() {
        $('.tab-menu-ampas').find('a').removeClass('active show');
        $(this).find('a').addClass('active show');
    });

    // PPOB INQUIRY
    $(document).on('click','.check-inquiry',function(){
      var dataForm = $(this).data('form');
      var datastring = $("#"+$(this).data('form')).serialize();
      var show = $(this).data('show');
        $.ajax({
            url: "{{ url("ppob-pasca") }}/"+$(this).data('url'),
            type: "POST",
            data: datastring,
            success: function(resp) {
              $('.'+show).html(resp);
              $('.selectpicker').selectpicker();
            },error: function(resp) {
              
              if(resp.responseJSON.dataPpob){
                swal(
                    'Gagal!',
                    ''+resp.responseJSON.dataPpob.message,
                    'error'
                    );
              }else if(resp.responseJSON.data){
                swal(
                'Gagal!',
                ''+resp.responseJSON.data.message+'',
                'error'
                )
              }else{
                
                if(resp.status == 500)
                {
                  clearQueryErrorModal('#contentBody');
                  showQueryErrorModal('#contentBody',resp.responseJSON.message);
                }
                $.each(resp.responseJSON, function(index, val) {
                  clearFormErrorFrontEnd(dataForm,index,val);
                  showFormErrorFrontEnd(dataForm,index,val);
                });

                time = 5;
                interval = setInterval(function(){
                  time--;
                  if(time == 0){
                    clearInterval(interval);
                    $('.text-danger.errors.labels').remove();
                    $('.error').each(function (index, val) {
                      $(val).removeClass('error');
                    });
                  }
                },1000)
              }

            }
        });
    });
    // PPOB DATA PULSA, PAKET DATA, VOUCHER
    $(document).on('click','.check-pulsa',function(){
      var dataForm = $(this).data('form');
      var datastring = $("#"+$(this).data('form')).serialize();
      var show = $(this).data('show');
        $.ajax({
            url: "{{ url("ppob-pulsa") }}/"+$(this).data('url'),
            type: "POST",
            data: datastring,
            success: function(resp) {
              swal(
              'Username anda '+JSON.parse(resp).data.username+'?',
              'Jika benar silahkan lanjut pemesanan.',
              'success'
              );
              $('.'+dataForm).show();
              $('.selectpicker').selectpicker();
            },error: function(resp) {
              swal(
              'Gagal!',
              ''+resp.responseJSON.data.message+'',
              'error'
              )
            }
        });
    });
    // START STASIUN KRETA
    $(document).on('change', 'input[name="pulang_pergi"]', function() {

        if ($(this).is(':checked') == true) {
            $('.tanggal_kepulangan').show();
        } else {
            $('.tanggal_kepulangan').hide();
        }
    });


    // CHECK TIKET
    $(document).on('click','.check-tiket',function(){
        var datastring = $("#"+$(this).data('form')).serialize();
        var show = $(this).data('show');
        var classs = $('input[name^="berangkat[trainNo]"]:checked').data('class');
        var subCsBr = $('input[name^="berangkat[trainNo]"]:checked').data('subclassbr');
        var classKepulangan = $('input[name^="kepulangan[trainNo]"]:checked').data('classkepulangan');
        var subCsKp = $('input[name^="kepulangan[trainNo]"]:checked').data('subclasskp');
        var datastring = datastring+'&class='+classs+'&classKepulangan='+classKepulangan+'&subclassbr='+subCsBr+'&subclasskp='+subCsKp;
        var dataForm = $(this).data('form');

          $.ajax({
              url: "{{ url("check-ticket") }}/"+$(this).data('url'),
              type: "POST",
              data: datastring,
              success: function(resp) {
                $('.'+show).html(resp);
                $('.selectpicker').selectpicker();
              },error: function(resp) {

                if(resp.status == 500)
                {
                  swal(
                    'Gagal!',
                    ''+resp.responseJSON.data.message,
                    'error'
                    );
                  clearQueryErrorPage('.content-ayokulakan');
                  showQueryErrorPage('.content-ayokulakan',resp.responseJSON.data.message);
                }else{
                    $.each(resp.responseJSON, function(index, val) {
                      clearFormErrorFrontEnd(dataForm, index,val);
                      showFormErrorFrontEnd(dataForm, index,val);
                    });
                }


                time = 5;
                interval = setInterval(function(){
                  time--;
                  if(time == 0){
                    clearInterval(interval);
                    $('.text-danger.errors.labels').remove();
                    $('.error').each(function (index, val) {
                      $(val).removeClass('error');
                    });
                  }
                },1000)
              }
          });
      });


    // END STASIUN KRETA

    // START PESAWAT
    $(document).on('change', 'input[name="pswt[pulang_pergi]"]', function() {

        if ($(this).is(':checked') == true) {
            $('input[name="pswt[tanggal_kepulangan]"]').show();
        } else {
            $('input[name="pswt[tanggal_kepulangan]"]').hide();
        }
    });

    $(document).on('click','.btn.save-page.save-frontend-pswt',function(){
      var params = [];
      params['formId'] = $(this).data('forms');
      swal({
        title: $(this).data('title'),
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: $(this).data('confirm'),
        cancelButtonText: $(this).data('batal')
      }).then((result) => {
        if (result) {
          var datastring = $("#"+$(this).data('forms')).serialize();
          var datastring = datastring+'&pswtid='+$(this).data('pswtid');
          var dataForm = $(this).data('forms');
          $.ajax({
              url: "{{ url("check-ticket/pesawat/store") }}",
              type: "POST",
              data: datastring,
              success: function(resp) {
                snap.pay(resp.record.snap_token, {
                  onSuccess: function (result) {
                    swal(
                    'Sukses!',
                    'Transaksi Berhasil.',
                    'success'
                    ).then((result) => {
                      if(resp.url){
                        window.location = resp.url;
                      }else{
                        window.location = "/";
                      }
                    })
                  },
                  onPending: function (result) {
                    
                    swal(
                    'Berhasil!',
                    ''+result.status_message+'',
                    'success'
                    ).then((result) => {
                      if(resp.url){
                        window.location = resp.url;
                      }else{
                        window.location = "/";
                      }
                    })
                  },
                  onError: function (result) {
                    
                    swal(
                      'Gagal!',
                      ''+result.status_message+'',
                      'error'
                      ).then((result) => {
                        if(resp.url){
                          window.location = resp.url;
                        }else{
                          window.location = "/";
                        }
                      })
                  },
                  onClose: function(result){
                    $.ajax({
                      url: "{{ url('transaksi/delete') }}",
                      type: 'POST',
                      data: {_token: "{{ csrf_token() }}", _method: "POST", id:resp.record.id},
                      success: function(resp){
                      },
                      error : function(resp){
                      }
                    });
                  }
                });
              },error: function(resp) {
                if(resp.status == 500)
                {
                  swal(
                    'Gagal!',
                    ''+resp.responseJSON.data.message,
                    'error'
                    );
                  clearQueryErrorPage('.content-ayokulakan');
                  showQueryErrorPage('.content-ayokulakan',resp.responseJSON.data.message);
                }else{
                    $.each(resp.responseJSON, function(index, val) {
                      clearFormErrorFrontEnd(dataForm, index,val);
                      showFormErrorFrontEnd(dataForm, index,val);
                    });
                }
                time = 5;
                interval = setInterval(function(){
                  time--;
                  if(time == 0){
                    clearInterval(interval);
                    $('.text-danger.errors.labels').remove();
                    $('.error').each(function (index, val) {
                      $(val).removeClass('error');
                    });
                  }
                },1000)
              }
          });
        }
      })
    });

    // END PESAWAT

    // START NOTIFIKASI
    function getNotif(){
      $.ajax({
        url: "{{ url("mess-not") }}",
        type: "GET",
        success: function(resp) {
          $('.cart-notification-message').html(resp);
        },
        error: function(resp) {

        }
      });
    }

    // END NOTIFIKASI
    $(document).ready(function() {
        getNotif();
        $('.dropdown-submenu a.test').on("click", function(e) {
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });

    // ENTER ON SEARCH BAR
    $(document).on('keyup', '.search-field', function(e) {
        if (e.keyCode == 13) {
            $('.search-button').trigger("click");
        }
    });

</script>
