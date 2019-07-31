<template>
  <div v-if="show">
    <unauthorized v-if="!can('service-list')"></unauthorized>
    <div v-else>
      <div class="row">
        <div class="col-12 table-scroll">
          <div class="mb-2 row">
            <div class="col-md-5" v-if="can('service-create')">
              <router-link
                class="btn btn-outline-success text-success"
                to="/services/create"
                v-if="can('service-create')"
              >
                Add New
                <i class="fa fa-plus"></i>
              </router-link>
            </div>
            <h3 class="px-4 pt-2 col-md-4 text-left">Service List</h3>
          </div>

          <table class="table table-hover">
            <thead>
              <tr class="heading">
                <th>No</th>
                <th>Customer</th>
                <th>Customer Address</th>
                <th>Customer Phone</th>
                <th>Received Staff</th>
                <th>Service Engineer</th>
                <th>Description</th>
                <th>Remark</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(service,index) in service_list" :key="service.id" class="animated fadeIn">
                <td>{{ paginationData.meta.from + index }}</td>
                <td>{{ service.customer_name }}</td>
                <td>{{ service.customer_address }}</td>
                <td>{{ service.customer_phone }}</td>
                <td>{{ service.staff }}</td>
                <td>{{ service.service_engineer }}</td>
                <td>{{ service.received_description | subStr }}</td>
                <td>{{ service.received_remark | subStr }}</td>
                <td>
                  <span
                    class="badge badge-danger"
                    style="padding-top : 8px ; padding-bottom : 5px ; font-size : 10px;"
                    
                    v-if="service.pending ==0"
                  >Not Finished</span>
                  <span
                    class="badge badge-success"
                    style="padding-top : 8px ; padding-bottom : 5px ; font-size : 10px;"
                    
                    v-if="service.pending ==1"
                  > Finished</span>
                  <span
                    class="badge badge-info px-2 text-white"
                    style="padding-top : 8px ; padding-bottom : 5px ; font-size : 10px;"
                    
                    v-if="service.pending ==2"
                  >Paid</span>
                </td>
                <td>
                  <button
                    class="btn btn-info btn-sm text-white"
                    @click="editServicebySaleperson(service.id)"
                    v-if="User.isSaleperson() && !service.pending"
                  >
                    <i class="fa fa-edit"></i>
                  </button>
                  <button
                    class="btn btn-secondary btn-sm"
                    @click="printView(service.id)"
                    v-if="User.isSaleperson() && !service.pending"
                  >
                    <i class="fas fa-print"></i>
                  </button>
                  <button
                    class="btn btn-primary btn-sm text-white"
                    @click="editServicebyServiceEngineer(service.id)"
                    v-if="User.isServiceEngineer() && service.pending !=2"
                  >
                    <i class="fa fa-edit"></i>
                  </button>

                  <router-link
                    :to="'/services/'+service.id+'/show'"
                    class="btn btn-success btn-sm text-white"
                    v-if="User.isSaleperson() && (service.pending == 1 || service.pending == 2) "
                  >
                    <i class="fas fa-print"></i>
                  </router-link>
                 
                </td>
              </tr>
            </tbody>
          </table>
          <pagination :data="paginationData" @pagination-change-page="getServiceList"></pagination>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Unauthorized403 from "./errors/Unauthorized403";
export default {
  components: {
    Unauthorized: Unauthorized403
  },
  data() {
    return {
      authorized: false,
      User: "",
      service_list: [],
      paginationData: {}
    };
  },
  methods: {
    getServiceList(page = 1) {
      axios
        .get("/api/services?page=" + page)
        .then(response => {
          this.paginationData = response.data;
          this.service_list = response.data.data;
        })
        .catch(error => {
          if (error.response.data.type == "token_invalid") {
            alert(error.response.data.error);
            Bus.$emit("logout");
          }
        });
    },
    editServicebySaleperson(id) {
      this.$router.push("/services/edit/" + id);
    },
    printView(id) {
      this.$router.push({
        name: "print",
        params: { id: `${id}` },
        query: { type: "start" }
      });
    },
    editServicebyServiceEngineer(id) {
      this.$router.push("/services/edit/" + id);
    },
    deleteService(id) {
      
     
      swal
        .fire({
          title: "Are you sure to delete?",

          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        })
        .then(result => {
          if (result.value) {
            //Send Delete Request to sever
            axios.delete(`/api/services/${id}`).then(response => {
              Bus.$emit("afterServiceDeleted");
            });
          }
        })
        .catch(err => {
          Toast.fire({
            type: "error",
            title: err.response.data.message
          });
        });
    }
  },

  created() {
    this.auth();
    this.getServiceList();
    Bus.$on("afterServiceDeleted", () => {
      this.getServiceList();
    });
  },
  filters: {
    subStr: function(string) {
      if(string){
        if (string.length > 150) {
          return string.substring(0, 150) + "...";
        }
        return string;
      }
    
      return '....';
    }
  }
};
</script>

<style scoped>
.table-scroll {
  overflow-x: auto;
}

/* .table{
    width:100%;
    height: 100%;
} */
.table {
  font-family: Poppins-Regular;
  font-size: 15px;
  color: #666666;
  line-height: 1.2;
  font-weight: unset !important;
}
table {
  font-family: Poppins-Regular;

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

.createroute {
  display: block;
  float: right;
}
</style>