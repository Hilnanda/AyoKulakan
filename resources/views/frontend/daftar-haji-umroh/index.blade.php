@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty'],
    };
</script>
@endsection



@section('scripts')
<script type="text/javascript">
    $('#paket').on('change', function(){
        var vv = this.value;
        if(vv){
            $.ajax({
                url : "{{ url('daftar-haji-umroh/paket/') }}"+'/'+ vv,
                method : 'get',
                success : function(data){
                    $('#keterangan').html(data.keterangan)
                },

                error: function(){
                    console.log('error')
                }

            })

        }else{
            $('#keterangan').html('')

        }
    });

    $(document).on('change','select[name="id_jadwal"]', function(){
        var vv = this.value;
        if(vv)
        {
            $.ajax({
                url : "{{ url('daftar-haji-umroh/jadwal/') }}"+'/'+ vv,
                method : 'get',
                success : function(data){
                    var ele = '<p> berangkat : '+data.tgl_berangkat+' - '+data.tgl_pulang+'<p/><p>total hari: '+data.total_hari+'</p><p> harga : $'+data.harga+'</p><p><strong>'+data.keterangan+'</strong></p>';
                    $('#keterangan2').html(ele);
                },

                error: function(){
                    console.log('error')
                }

            })
        }else{
            $('#keterangan2').html('');
        }
    });


    $('.nomor').on('keyup', function(){
        var v = this.value;
        if(v){
            this.value = v.replace(/[^0-9]/g, '');
        }

    })

</script>
@append


@section('content-frontend')
	<main class="outer-top"></main>
<div class="terms-conditions-page container">
    <div class="row" style="padding: 20px">
        <div class="col-md-12 terms-conditions">
            <h2 class="heading-title">Daftar Haji & Umroh</h2>
            <div class="contact-page-map">
              <div class="container-fluid">
                 <div class="alert alert-danger" role="alert">
                  <p>Silahkan lakukan pendaftaran dengan menyertai unggah dokument sebagai berikut :</p>
                  <p>
                        {!! $record['detail']->deskripsi or '' !!}
                  </p>
                  <p>Agar pendaftar dapat ditindaklanjuti oleh ayokulakan, silakan lengkapi pemberkasan.</p>
                  <hr>
                  <p class="mb-0">Salam Hangat Ayokulakan.com</p>
                </div>
                <div class="content-ayokulakan">
                    <form id="dataFormPage" action="{{ url($pageUrl.'store') }}" method="POST" autocomplete="off">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-xs-12 form-group">
                              <select id="paket" name="id_paket" class="form-control child target selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-child="showJadwalPaket" data-namas='id_jadwal'>
                                  {!! \App\Models\HajiUmroh\HajiPaket::options('type_paket', 'id', [], 'Pilih paket') !!}
                              </select>
                              <br><br>
                              <div class="wpb_wrapper">
                                  <p id="keterangan"></p>
                              </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xs-12 form-group">
                              <select class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
                              </select>
                              <div id="showJadwalPaket">

                              </div>
                              <br><br>

                                <div class="wpb_wrapper">
                                    <p id="keterangan2"></p>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xs-12">
                             @if(Auth::check())
                             <div class="form-group">
                                 <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                 <label for="">Nama Pemesan</label>
                                 <input type="text" readonly class="form-control" value="{{auth()->user()->username}}" />
                             </div>
                             <div class="form-group">
                                <label for="">Nama Peserta</label>
                                <input type="text" name="name" placeholder="Nama Peserta" class="form-control">
                            </div>
                            <div class="form-group">
                             <label for="">NIK</label>
                             <input type="text" name="nik" class="form-control nomor" required minlength="16" maxlength="16" placeholder="NIK" />
                         </div>
                         <div class="form-group">
                             <label for="">No. KK</label>
                             <input type="text" name="kk" class="form-control nomor" required minlength="16" maxlength="16" placeholder="No. KK" />
                         </div>
                          <div class="form-group">
                             <label for="">No. Passport</label>
                             <input type="text" name="passport" class="form-control nomor" required minlength="16" maxlength="16" placeholder="No. Passport" />
                         </div>
                         <div class="form-group">
                             <label rows="5">Keterangan Penyakit</label>
                             <textarea rows="4" placeholder="" class="form-control"></textarea>
                         </div>
                         <div class="form-group">
                          @include('partials.file-tab.attachment',['multi' => 'multiple','foto' => '*Unggah Dokumen, KK, KTP, Passport, dan Berkas Terkait Persyaratan'])
                      </div>
                      <div class="order-button-payment">
                        <button type="button" class="btn btn-success save-page save-ayokulakan btn-lg btn-block" data-title="Anda yakin data sudah lengkap?" data-confirm="Daftar" data-batal="Batal">Daftar</button>
                    </div>
                    @else
                    <h1>Anda belum Login, silahkan login terlebih dahulu, atau registrasi</h1>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection
