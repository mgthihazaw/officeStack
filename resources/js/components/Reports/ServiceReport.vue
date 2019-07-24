<template>
  <div v-if="show">
    <unauthorized v-if="!can('staff-list')"></unauthorized>
    <div class="col-12 animated fadeIn" v-else>
      <div>
        <form @submit.prevent="loadService">
          <div class="form-group row pt-2">
            <div class="col-md-5">
              <h4 class="p-2 text-info">Search For Service Reports :</h4>
            </div>
            <div class="col-md-3">
              <multiselect
                v-model="itemType"
                track-by="name"
                :block-keys="['Delete']"
                placeholder="Choose Item Type"
                label="name"
                selectLabel="Select"
                deselectLabel="Deselect"
                :options="itemTypes"
                :reset-after="false"
                
              ></multiselect>
            </div>
            <div class="col-md-3">
              <vue-monthly-picker
                v-model="selectedMonth"
                :clearOption="false"
                placeHolder="Select MonthOfYear"
              ></vue-monthly-picker>
            </div>
            <div class="col-md-1">
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </div>
          </div>
        </form>
      </div>
      <div class="itemTable">
        <div class="p-0 col-md-12">
          <table class="table table-hover">
            <tbody>
              <tr class="heading">
                <th style="width: 50px">No</th>
                <th>ItemType</th>

                <th>Total Price</th>

                <th style="width: 100px">Action</th>
              </tr>
              <tr class="heading" v-for="(data,index) in serviceDatas" :key="index" v-if="serviceDatas.length>0">
                <td>{{ index+1 }}</td>
                <td>{{ data.name}}</td>
                <td>{{ data.total }}</td>
                <td>
                  <button class="btn btn-info btn-sm text-white">
                    <i class="fa fa-eye"></i>
                  </button>
                </td>
              </tr>
              <tr v-if="serviceDatas.length<1">
                  <td></td>
                   <td></td>
                   <td><h5 class="text-secondary" >NO DATA</h5></td>
                   <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueMonthlyPicker from "vue-monthly-picker";
import moment from "moment";
import Unauthorized403 from "../errors/Unauthorized403";

export default {
  components: {
    VueMonthlyPicker: VueMonthlyPicker,
    Unauthorized: Unauthorized403
  },
  data() {
    return {
      itemTypes: [],
      itemType: "",
      selectedMonth: null,
      serviceDatas: [],
      searchForm: {
        item_type: "",
        date: ""
      }
    };
  },
  methods: {
    getItemType() {
      axios
        .get(`/api/itemtypes`)
        .then(res => {
          this.itemTypes = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    loadService() {
        this.serviceDatas =[]
        this.searchForm = {
        item_type: "",
        date: ""
      }
        
      if (this.itemType) {
        this.searchForm.item_type = this.itemType.id;
      }
      if (this.selectedMonth) {
        this.searchForm.date = this.selectedMonth.format("YYYY-MM");
      }
    //   console.log("searchForm", this.searchForm);

      axios
        .get("/api/reports/services", { params: this.searchForm })
        .then(res => {
          this.serviceDatas = res.data
        });
    }
  },
  created() {
    this.auth();
    this.getItemType();
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style >
.vue-monthly-picker .input {
  padding: 20px !important;
}
.table {
  font-family: Poppins-Regular;
  font-size: 15px;
  color: #666666;
  line-height: 1.2;
  font-weight: unset !important;
}
table {
  font-family: Poppins-Regular;
  border: 1px solid rgb(111, 161, 136);
  border-collapse: collapse;
  border-radius: 1em;
  overflow: hidden;
}
.heading {
  background: rgb(168, 180, 176);
}
.heading th {
  padding-top: 20px;
  padding-bottom: 20px;
}
tbody tr {
  background: rgb(243, 243, 243);
}

td {
  padding-top: 1em;
  padding-bottom: 1em;
  background: #fff;
  border-bottom: 1px solid rgba(191, 236, 197, 0.87);
}
.table-hover tbody tr:hover td {
  background: #e9ecef;
}
</style>
