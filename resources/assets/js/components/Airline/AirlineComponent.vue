<template>
  <div>
    <div id="booking" class="section">
      <div class="section-center">
        <div class="container">
          <div class="row">
            <div v-if="!search" class="panel panel-default" style="padding:20px">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-checkbox">
                      <label @click="date.return = ''" for="one-way">
                        <input type="radio" id="one-way" value="OneWay" v-model="tripType" />
                        <span></span>Sekali Jalan
                      </label>
                      <label for="roundtrip">
                        <input type="radio" id="roundtrip" value="RoundTrip" v-model="tripType" />
                        <span></span>Pulang Pergi
                      </label>
                      <!-- <label for="multi-city">
                  <input type="radio" id="multi-city" name="tripType" />
                  <span></span>Multi-City
                      </label>-->
                    </div>
                  </div>
                </div>

                <!-- <div class="col-md-3">
            <label>Maskapai</label>
            <v-select :options="airlines" label="name" v-model="maskapai" :reduce="name => name.id"></v-select>
            maskapai={{ maskapai }}
                </div>-->
              </div>

              <div class="row" style="margin-top:10px;">
                <div class="col-md-4">
                  <label>Dari</label>
                  <v-select
                    :options="cities"
                    label="location_name"
                    v-model="origin"
                    :reduce="origin => origin.airport_code"
                  >
                    <template slot="no-options">Dari..</template>
                    <template slot="option" slot-scope="option">
                      <div>{{ `${option.country_name} - ${option.location_name}, ${option.airport_name} ( ${option.airport_code} )` }}</div>
                    </template>
                    <template slot="selected-option" slot-scope="option">
                      <div
                        class="selected d-center"
                      >{{ `${option.location_name}, ${option.airport_name} ( ${option.airport_code} )` }}</div>
                    </template>
                  </v-select>
                </div>

                <div class="col-md-4">
                  <label>Ke</label>
                  <v-select
                    :options="cities"
                    label="location_name"
                    v-model="destination"
                    :reduce="destination => destination.airport_code"
                  >
                    <template slot="no-options">Ke..</template>
                    <template slot="option" slot-scope="option">
                      <div>{{ `${option.country_name} - ${option.location_name}, ${option.airport_name} ( ${option.airport_code} )` }}</div>
                    </template>
                    <template slot="selected-option" slot-scope="option">
                      <div
                        class="selected d-center"
                      >{{ `${option.location_name}, ${option.airport_name} ( ${option.airport_code} )` }}</div>
                    </template>
                  </v-select>
                </div>

                <div class="col-md-4">
                  <label>Kelas Kabin</label>
                  <v-select :options="['ECONOMY', 'BUSINESS', 'FIRST']" v-model="cabinClass"></v-select>
                </div>
              </div>

              <div class="row" style="margin-top:20px;">
                <div class="col-md-3">
                  <div class="form-group">
                    <span class="form-label">Berangkat</span>
                    <input class="form-control" type="date" name="departDate" v-model="date.depart" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <span class="form-label">Pulang</span>
                    <input
                      class="form-control"
                      type="date"
                      name="returnDate"
                      v-model="date.return"
                      :disabled="tripType == 'OneWay'"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <span class="form-label">Dewasa (12&#43;)</span>
                    <input
                      type="number"
                      min="1"
                      name="paxAdult"
                      class="form-control"
                      v-model="pax.adult"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <span class="form-label">Anak (&lt;12thn)</span>
                    <input
                      type="number"
                      min="0"
                      name="paxChild"
                      class="form-control"
                      v-model="pax.children"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <span class="form-label">Bayi (&lt;2thn)</span>
                    <input
                      type="number"
                      min="0"
                      name="paxInfant"
                      class="form-control"
                      v-model="pax.infant"
                    />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-3 offset-md-9">
                  <button
                    type="button"
                    class="btn btn-success"
                    @click.prevent="getAirlineSchedules()"
                  >Lihat Jadwal Penerbangan</button>
                </div>
              </div>
            </div>

            <div v-else>
              <div class="panel panel-default" style="font-weight:bold; font-size:14px;">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-3">Berangkat</div>
                    <div class="col-md-1" style="text-align:right;">:</div>
                    <div class="col-md-8">
                      <span
                        v-for="(city, index) in cities"
                        v-if="city.airport_code === origin"
                        :item="city"
                        :key="index"
                      >{{ `${city.location_name}, ${city.airport_name} ( ${city.airport_code} )` }}</span>
                    </div>
                    <div class="col-md-3">Tujuan</div>
                    <div class="col-md-1" style="text-align:right;">:</div>
                    <div class="col-md-8">
                      <span
                        v-for="(city, index) in cities"
                        v-if="city.airport_code === destination"
                        :item="city"
                        :key="index"
                      >{{ `${city.location_name}, ${city.airport_name} ( ${city.airport_code} )` }}</span>
                    </div>
                    <div class="col-md-3">Tanggal Berangkat</div>
                    <div class="col-md-1" style="text-align:right;">:</div>
                    <div class="col-md-8">{{ date.depart | formatDateDetail }}</div>
                    <div v-if="date.return">
                      <div class="col-md-3">Tanggal Kembali</div>
                      <div class="col-md-1" style="text-align:right;">:</div>
                      <div class="col-md-8">{{ date.return | formatDateDetail }}</div>
                    </div>
                    <div class="col-md-3">Jumlah Penumpang</div>
                    <div class="col-md-1" style="text-align:right;">:</div>
                    <div class="col-md-8">
                      {{ pax.adult }} Dewasa
                      <br />
                      {{ pax.children }} Anak
                      <br />
                      {{ pax.infant }} Bayi
                      <br />
                    </div>
                  </div>
                </div>
              </div>

              <a v-on:click="search = !search" class="btn btn-danger">Ubah Pencarian</a>
              {{ airlineSelect }}
            </div>
          </div>
        </div>

        <div v-if="search" class="container" style="margin-top:10px; text-align: center;">
          <div class="row">
            <div class="panel panel-default">
              <div class="panel-body" style="font-weight:bold;text-transform:uppercase;">
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-2">No Penerbangan</div>
                  <div class="col-md-3">Dari</div>
                  <div class="col-md-3">Ke</div>
                  <div class="col-md-2"></div>
                </div>
              </div>
            </div>

            <div v-if="schedules.status === 'SUCCESS'">
              <div
                v-for="(journey, index) in schedules.journeyDepart"
                :key="index"
                class="panel panel-default"
                style="min-height:50px"
              >
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-2">
                      <img :src="asset(`img/airline/${journey.airlineID}.jpg`)" style="width:50px;" />
                    </div>
                    <div
                      class="col-md-2"
                    >{{ `${journey.segment[0].flightDetail[0].airlineCode} ${journey.segment[0].flightDetail[0].flightNumber}` }}</div>
                    <div class="col-md-3">
                      <b>{{ journey.jiOrigin }}</b>
                      <br />
                      {{ journey.jiDepartTime | formatDate }}
                    </div>
                    <div class="col-md-3">
                      <b>{{ journey.jiDestination }}</b>
                      <br />
                      {{ journey.jiArrivalTime | formatDate }}
                    </div>
                    <div class="col-md-2">
                      <a
                        class="btn btn-primary"
                        @click="selectAirline(journey), show()"
                      >Detail Penerbangan</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-else>Ups... sepertinya anda tidak menemukan sesuatu</div>
          </div>
        </div>
      </div>
    </div>
    <modal
      name="detail-airline"
      transition="nice-modal-fade"
      :min-width="800"
      :min-height="500"
      :delay="100"
      :adaptive="true"
    >
      <div class="example-modal-content">
        <img class="modal-img" :src="asset(`img/airline/${airlineSelect.airlineID}.jpg`)" />
        <h3
          v-for="(number, key) in airlineSelect.priceDepart"
          :key="key"
        >No Penerbangan : {{ `${airlineSelect.airlineID} ${number.flightNumber}` }}</h3>

        <table class="table">
          <thead>
            <tr>
              <th>Berangkat</th>
              <th>Tiba</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <b>
                  <span
                    v-for="(city, index) in cities"
                    v-if="city.airport_code === airlineSelect.origin"
                    :item="city"
                    :key="index"
                  >{{ `${city.location_name}, ${city.airport_name} ( ${city.airport_code} )` }}</span>
                </b>
                <!-- <br />15/04/2020 05:45 -->
              </td>
              <td>
                <b>
                  <span
                    v-for="(city, index) in cities"
                    v-if="city.airport_code === airlineSelect.destination"
                    :item="city"
                    :key="index"
                  >{{ `${city.location_name}, ${city.airport_name} ( ${city.airport_code} )` }}</span>
                </b>
                <!-- <br />15/04/2020 07:15 -->
              </td>
            </tr>
          </tbody>
        </table>

        <table class="table">
          <thead>
            <tr>
              <th colspan="3" style="text-align: left;">Detail Harga</th>
            </tr>
          </thead>
          <tbody v-for="(price, index) in airlineSelect.priceDepart" :key="index">
            <tr v-for="(pax, i) in price.priceDetail" :key="i">
              <td style="text-align: left;">{{ pax.paxType }}</td>
              <td
                style="text-align: center;"
                v-if="pax.paxType == 'Adult'"
              >{{ airlineSelect.paxAdult }}x</td>
              <td
                style="text-align: center;"
                v-else-if="pax.paxType == 'Child'"
              >{{ airlineSelect.paxChild }}x</td>
              <td style="text-align: center;" v-else>{{ airlineSelect.paxInfant }}x</td>
              <td style="text-align: right;">
                Base : {{ pax.baseFare | currency }}
                <br />
                Tax : {{ pax.tax | currency }}
                <br />
                <b>Total : {{ pax.totalFare | currency }}</b>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td style="text-align: left;" colspan="2">
                <b>Total</b>
              </td>
              <td style="text-align: right;">
                <b>{{ airlineSelect.sumFare | currency }}</b>
              </td>
            </tr>
          </tfoot>
        </table>
        <button type="button" class="float-right btn btn-primary">Lanjut ke Pembayaran</button>
      </div>
    </modal>
  </div>
</template>


<script>
export default {
  data() {
    return {
      showModal: false,
      search: false,
      tripType: "OneWay",
      origin: "SUB",
      destination: "CGK",
      cabinClass: "ECONOMY",
      cities: [],
      airlines: [],
      schedules: [],
      maskapai: "",
      pax: {
        adult: 1,
        children: 1,
        infant: 1
      },
      date: {
        return: "",
        depart: "2020-04-16"
      },
      promoCode: "",
      airlineAccessCode: "",
      airlineSelect: []
    };
  },

  mounted() {
    this.getAirlines();
    this.getCities();
    // this.getAirlineSchedules();
  },

  methods: {
    show() {
      this.$modal.show("detail-airline");
    },
    hide() {
      this.$modal.hide("detail-airline");
    },
    async getAirlines() {
      let response = await axios.get("/airline").then(response => {
        this.airlines = response.data.data;
      });
    },

    async getCities() {
      let response = await axios.get("/airline/cities").then(response => {
        this.cities = response.data.data;
      });
    },

    async getAirlineSchedules() {
      let response = await axios
        .get("/airline/allSchedules", {
          params: {
            airlineID: this.maskapai,
            tripType: this.tripType,
            origin: this.origin,
            destination: this.destination,
            departDate: this.date.depart,
            returnDate: this.date.return,
            paxAdult: this.pax.adult,
            paxChild: this.pax.children,
            paxInfant: this.pax.infant,
            promoCode: this.promoCode,
            airlineAccessCode: this.airlineAccessCode
          }
        })
        .then(response => {
          this.search = true;
          this.schedules = response.data.data;
        });
    },

    async selectAirline(journey) {
      let response = await axios
        .get("/airline/priceAllAirline", {
          params: {
            airlineID: journey.airlineID,
            tripType: this.tripType,
            origin: this.origin,
            destination: this.destination,
            departDate: this.date.depart,
            returnDate: this.date.return,
            paxAdult: this.pax.adult,
            paxChild: this.pax.children,
            paxInfant: this.pax.infant,
            airlineAccessCode: this.airlineAccessCode,
            journeyDepartReference: journey.journeyReference,
            journeyReturnReference: journey.journeyReturn
          }
        })
        .then(response => {
          this.airlineSelect = response.data.data;
        });
    }
  }
};
</script>

<style>
table,
thead,
tr,
tbody,
th,
td {
  text-align: center;
}

.table td {
  text-align: center;
}

#booking {
  padding: 20px 0;
  font-family: pt sans, sans-serif;
  background-size: cover;
  background-position: center;
}

.booking-form {
  background: #333333;
  padding: 40px;
}

.booking-form .form-group {
  position: relative;
  margin-bottom: 20px;
}

.booking-form .form-control {
  background-color: #fff;
  height: 50px;
  color: #191a1e;
  border: none;
  font-size: 16px;
  font-weight: 400;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-radius: 40px;
  padding: 0 25px;
}

.booking-form .form-control::-webkit-input-placeholder {
  color: rgba(82, 82, 84, 0.4);
}

.booking-form .form-control:-ms-input-placeholder {
  color: rgba(82, 82, 84, 0.4);
}

.booking-form .form-control::placeholder {
  color: rgba(82, 82, 84, 0.4);
}

.booking-form input[type="date"].form-control:invalid {
  color: rgba(82, 82, 84, 0.4);
}

.booking-form select.form-control {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

.booking-form select.form-control + .select-arrow {
  position: absolute;
  right: 10px;
  bottom: 6px;
  width: 32px;
  line-height: 32px;
  height: 32px;
  text-align: center;
  pointer-events: none;
  color: rgba(0, 0, 0, 0.3);
  font-size: 14px;
}

.booking-form select.form-control + .select-arrow:after {
  content: "\279C";
  display: block;
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.booking-form .form-label {
  display: block;
  margin-left: 20px;
  margin-bottom: 5px;
  font-weight: 400;
  line-height: 24px;
  height: 24px;
  font-size: 12px;
  color: #fff;
}

.booking-form .form-checkbox input {
  position: absolute !important;
  margin-left: -9999px !important;
  visibility: hidden !important;
}

.booking-form .form-checkbox label {
  position: relative;
  padding-top: 4px;
  padding-left: 30px;
  font-weight: 400;
  color: #fff;
}

.booking-form .form-checkbox label + label {
  margin-left: 15px;
}

.booking-form .form-checkbox input + span {
  position: absolute;
  left: 2px;
  top: 4px;
  width: 20px;
  height: 20px;
  background: #fff;
  border-radius: 50%;
}

.booking-form .form-checkbox input + span:after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  background-color: #f23e3e;
  -webkit-transition: 0.2s all;
  transition: 0.2s all;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

.booking-form .form-checkbox input:not(:checked) + span:after {
  opacity: 0;
}

.booking-form .form-checkbox input:checked + span:after {
  opacity: 1;
  width: 10px;
  height: 10px;
}

.booking-form .form-btn {
  margin-top: 27px;
}

.booking-form .submit-btn {
  color: #fff;
  font-weight: 400;
  height: 50px;
  font-size: 14px;
  border: none;
  width: 100%;
  border-radius: 40px;
  -webkit-transition: 0.2s all;
  transition: 0.2s all;
}

.booking-form .submit-btn:hover,
.booking-form .submit-btn:focus {
  opacity: 0.9;
}

.d-center {
  display: flex;
  align-items: center;
}

.selected img {
  width: auto;
  max-height: 23px;
  margin-right: 0.5rem;
}

.v-select .dropdown li {
  border-bottom: 1px solid rgba(112, 128, 144, 0.1);
}

.v-select .dropdown li:last-child {
  border-bottom: none;
}

.v-select .dropdown li a {
  padding: 10px 20px;
  width: 100%;
  font-size: 1.25em;
  color: #3c3c3c;
}

.v-select .dropdown-menu .active > a {
  color: #fff;
}

.example-modal-content {
  padding: 20px;
}

.example-modal-content .modal-img {
  float: right;
  width: 150px;
}
</style>
