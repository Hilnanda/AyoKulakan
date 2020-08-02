<template>
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-body">
        <h2>Konfimasi Pesanan {{ passengers }}</h2>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <b>Data Pemesan</b>
        <hr />
        <form class="form-inline">
          <div class="form-group">
            <label for>Nama Depan</label>
            <br />
            <input class="form-control" type="text" placeholder="Nama Depan" />
          </div>
          <div class="form-group">
            <label for>Nama Belakang</label>
            <br />
            <input class="form-control" type="text" placeholder="Nama Belakang" />
          </div>

          <div class="form-group">
            <label for>Alamat Email</label>
            <br />
            <input class="form-control" type="text" placeholder="Alamat Email" />
          </div>
        </form>
      </div>
    </div>

    <div class="panel panel-default" v-if="passenger.adult">
      <div class="panel-body">
        <b>Penumpang Dewasa</b>
        <hr />
        <div
          class="form-inline"
          style="margin-top: 10px;"
          v-for="(pax, index) in passenger.adult"
          :key="index"
        >
          <div class="form-group">
            <label for>Title</label>
            <br />
            <select class="form-control">
              <option value="MR">Mr.</option>
              <option value="MRS">Mrs.</option>
              <option value="MS">Ms.</option>
              <option value="CHD">Child</option>
              <option value="MISS">Miss</option>
              <option value="MSTR">Master</option>
            </select>
          </div>

          <div class="form-group">
            <label for>Jenis Kelamin</label>
            <br />
            <select class="form-control">
              <option value="Male">Laki-laki</option>
              <option value="Female">Perempuan</option>
            </select>
          </div>

          <div class="form-group">
            <label for>Nama Depan</label>
            <br />
            <input class="form-control" type="text" placeholder="Nama Depan" />
          </div>

          <div class="form-group">
            <label for>Nama Belakang</label>
            <br />
            <input class="form-control" type="text" placeholder="Nama Belakang" />
          </div>

          <div class="form-group">
            <label for>Tanggal Lahir</label>
            <br />
            <input class="form-control" type="date" placeholder="Tanggal Lahir" />
          </div>

          <div class="form-group">
            <label for>Pilih Bagasi (SUB - CGK)</label>
            <br />
            <select class="form-control">
              <option value selected="selected">20kg extra bag 0 IDR</option>
              <option value="XB05">5kg extra bag 105,000 IDR</option>
              <option value="XB10">10kg extra bag 210,000 IDR</option>
              <option value="XB20">20kg extra bag 420,000 IDR</option>
              <option value="XB30">30kg extra bag 630,000 IDR</option>
              <option value="XB40">40kg extra bag 840,000 IDR</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-default" v-if="passenger.child">
      <div class="panel-body">
        <b>Penumpang Anak</b>
        <hr />
        <div
          class="form-inline"
          style="margin-top: 10px;"
          v-for="(pax, index) in passenger.child"
          :key="index"
        >
          <div class="form-group">
            <label for>Title</label>
            <br />
            <select class="form-control">
              <option value="MR">Mr.</option>
              <option value="MRS">Mrs.</option>
              <option value="MS">Ms.</option>
              <option value="CHD">Child</option>
              <option value="MISS">Miss</option>
              <option value="MSTR">Master</option>
            </select>
          </div>

          <div class="form-group">
            <label for>Jenis Kelamin</label>
            <br />
            <select class="form-control">
              <option value="Male">Laki-laki</option>
              <option value="Female">Perempuan</option>
            </select>
          </div>

          <div class="form-group">
            <label for>Nama Depan</label>
            <br />
            <input class="form-control" type="text" placeholder="Nama Depan" />
          </div>

          <div class="form-group">
            <label for>Nama Belakang</label>
            <br />
            <input class="form-control" type="text" placeholder="Nama Belakang" />
          </div>

          <div class="form-group">
            <label for>Tanggal Lahir</label>
            <br />
            <input class="form-control" type="date" placeholder="Tanggal Lahir" />
          </div>

          <div class="form-group">
            <label for>Pilih Bagasi (SUB - CGK)</label>
            <br />
            <select class="form-control">
              <option value selected="selected">20kg extra bag 0 IDR</option>
              <option value="XB05">5kg extra bag 105,000 IDR</option>
              <option value="XB10">10kg extra bag 210,000 IDR</option>
              <option value="XB20">20kg extra bag 420,000 IDR</option>
              <option value="XB30">30kg extra bag 630,000 IDR</option>
              <option value="XB40">40kg extra bag 840,000 IDR</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-default" v-if="passenger.infant">
      <div class="panel-body">
        <b>Penumpang Bayi</b>
        <hr />
        <div
          class="form-inline"
          style="margin-top: 10px;"
          v-for="(pax, index) in passenger.infant"
          :key="index"
        >
          <div class="form-group">
            <label for>Jenis Kelamin</label>
            <br />
            <select class="form-control">
              <option value="Male">Laki-laki</option>
              <option value="Female">Perempuan</option>
            </select>
          </div>

          <div class="form-group">
            <label for>Nama Depan</label>
            <br />
            <input class="form-control" type="text" placeholder="Nama Depan" />
          </div>

          <div class="form-group">
            <label for>Nama Belakang</label>
            <br />
            <input class="form-control" type="text" placeholder="Nama Belakang" />
          </div>

          <div class="form-group">
            <label for>Tanggal Lahir</label>
            <br />
            <input class="form-control" type="date" placeholder="Tanggal Lahir" />
          </div>

          <div class="form-group">
            <label for>Orangtua</label>
            <br />
            <select class="form-control">
              <option value selected="selected">Penumpang 1</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <b>Kontak Penumpang</b>
        <hr />
        <div class="form-inline" style="margin-top: 10px;">
          <div class="form-group">
            <label for>No Telepon</label>
            <br />
            <input class="form-control" type="text" placeholder="Nama Depan" />
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-body">
        <button type="button" class="btn btn-primary pull-right">Lanjutkan</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    passengers: [Array, Object]
  },
  data() {
    return {
      passenger: []
    };
  },

  mounted() {
    this.passenger = this.passengers;
  },

  methods: {
    //
  }
};
</script>