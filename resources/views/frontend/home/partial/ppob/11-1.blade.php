<script type="text/javascript">
    $(document).ready(function(){
          $('.selectpicker').selectpicker();
          $('.bots-date').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
            });
    });
</script>
<div class="row">
    <div class="col-md-12 mt-15 mt-lg-0">
        <div class="tab-content">
            <div class="tab-pane fade active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
                <div class="myaccount-content">
                    <h3>Daftar Tiket Kapal </h3>
                        <div class="content-ayokulakan" style="padding-top: 12px">
                            <form id="dataFormPagePesnHotel" action="#" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="saved-message col-md-12">
                                      <center><span>Data Tidak Ditemukan</span></center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>