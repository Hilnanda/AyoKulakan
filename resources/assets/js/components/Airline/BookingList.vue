<template>
  <div class="container" style="margin-top: 220px;">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <input type="date" name="start" class="form-control" v-model="start" />
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <input type="date" name="end" class="form-control" v-model="end" />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <select name="status" class="form-control" v-model="status">
                <option value="all">All</option>
                <option value="HOLD">Hold</option>
                <option value="Processed">Processed</option>
                <option value="Ticketed">Ticketed</option>
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <button
              type="button"
              class="btn btn-primary btn-block"
              @click="getBookings(start, end, status)"
            >Filter</button>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Airline</th>
              <th>Code</th>
              <th>Date</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="bookings.length <= 0">
              <td colspan="6">No Data in here</td>
            </tr>
            <tr v-else v-for="(booking, index) in bookings" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ booking.airline }}</td>
              <td>{{ booking.bookingCode }}</td>
              <td>{{ booking.bookingDate | formatDateDetail }}</td>
              <td>{{ booking.bookingStatus }}</td>
              <td>
                <button
                  type="button"
                  class="btn btn-info"
                  @click="
                    showBookingDetail(booking.bookingCode, booking.bookingDate),
                      (showModal = true)
                  "
                >Detail</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <modal v-if="showModal" @close="showModal = false">
      <div slot="header">
        <h3>{{ `${detail.airline} (${detail.airlineID}) ${detail.bookingCode}` }}</h3>
        <div>
          Status Ticket :
          <span>{{ detail.ticketStatus }}</span>
          Tanggal Pemesanan :
          <span>{{ detail.bookingDate | formatDateDetail }}</span>
          <!-- Jumlah Penumpang :
          <span>{{ detail.passengers.length }}</span>-->
        </div>
        <button
          v-if="detail.ticketStatus != 'Ticketed'"
          class="pull-right btn btn-sm btn-primary"
          @click="storeIssued(detail)"
        >Set Issued</button>
      </div>

      <div slot="body">
        <h4>Data Penumpang</h4>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Nama Depan</th>
              <th>Nama Belakang</th>
              <th>No Telepon</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(pass, ind) in detail.passengers" :key="ind">
              <td>-</td>
              <td>{{ pass.title }}</td>
              <td>{{ pass.firstName }}</td>
              <td>{{ pass.lastName }}</td>
              <td>{{ pass.phone || "No Data" }}</td>
            </tr>
          </tbody>
        </table>
        <h4>Data Penerbangan</h4>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>No Penerbangan</th>
              <th>Jam Berangkat</th>
              <th>Jam Tiba</th>
              <th>Dari</th>
              <th>Ke</th>
              <th>Class</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(det, i) in detail.flightDeparts" :key="i">
              <td>-</td>
              <td>{{ det.flightNumber }}</td>
              <td>{{ det.fdDepartTime | formatDateDetail }}</td>
              <td>{{ det.fdArrivalTime | formatDateDetail }}</td>
              <td>{{ det.fdOrigin }}</td>
              <td>{{ det.fdDestination }}</td>
              <td>{{ det.fdFlightClass }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </modal>

    <script type="text/x-template" id="modal-template">
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              default body
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <button class="modal-default-button btn btn-danger" @click="$emit('close')">
                Close
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
    </script>
  </div>
</template>

<script>
// register modal component
Vue.component("modal", {
  template: "#modal-template"
});

export default {
  data() {
    return {
      showModal: false,
      bookings: [],
      start: moment()
        .startOf("month")
        .format("YYYY-MM-DD"),
      end: moment()
        .endOf("month")
        .format("YYYY-MM-DD"),
      status: "all",
      detail: "",
      issuedApi: {}
    };
  },

  mounted() {
    this.getBookings();
  },

  methods: {
    showAlert(type, text) {
      this.$swal({
        icon: type,
        text: text
      });
    },

    async getBookings(start, end, status) {
      let fromDate = this.start;
      let endDate = this.end;
      let fStatus = this.status;
      await axios
        .get("/airline/booking/list", {
          params: { status: "all", start: fromDate, end: endDate }
        })
        .then(res => {
          const bookings = res.data.data.bookingInfos;

          if (fStatus != "all") {
            this.bookings = bookings.filter(booking =>
              booking.bookingStatus.includes(fStatus)
            );
          } else {
            this.bookings = bookings;
          }
        });
    },

    async showBookingDetail(bookingCode, bookingDate) {
      await axios
        .get("/api/airline/booking/detail", {
          params: { bookingCode: bookingCode, bookingDate: bookingDate }
        })
        .then(res => (this.detail = res.data.data));
    },

    async storeIssued(booking) {
      this.issuedApi = await axios
        .post("/api/airline/issued", {
          airlineID: booking.airlineID,
          origin: booking.flightDeparts[0].fdOrigin,
          destination: booking.flightDeparts[0].fdDestination,
          tripType: booking.tripType,
          departDate: booking.departDate,
          returnDate: booking.returnDate,
          bookingCode: booking.bookingCode,
          bookingDate: booking.bookingDate,
          airlineAccessCode: booking.bookingCodeAirline
        })
        .then(res => res.data.data);

      await axios
        .post("/airline/issued", {
          _token: window.laravel,
          bookingCode: this.issuedApi.bookingCode,
          bookingStatus: this.issuedApi.bookingStatus
        })
        .then(
          () => this.getBookings(this.start, this.end, "all"),
          this.showAlert("success", "Berhasil ubah data status"),
          (this.showModal = false)
        );
    }
  }
};
</script>

<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 800px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-header div {
  padding: 5px 0 3px;
}

.modal-header div span {
  margin-right: 10px;
  color: #42b983;
}

.modal-body h4:first-child {
  margin-top: -20px;
}

.modal-body table,
.modal-body table thead,
.modal-body table thead tr,
.modal-body table thead tr th,
.modal-body table tbody,
.modal-body table tbody tr,
.modal-body table tbody tr td {
  text-align: left;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
