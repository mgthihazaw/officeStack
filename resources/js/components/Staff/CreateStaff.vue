<template>
  <div>
    <div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3>New Staff</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <form @submit.prevent="submit" method="POST">
              <div class="form-group">
                <label for="name">Name</label>
                <div class="error text-muted" v-if="errs.name">{{errs.name[0]}}</div>
                <input type="text" class="form-control" id="name" v-model="form.name">
              </div>
              <div class="form-group">
                <label for="phone1">Phone Numbers</label>
                <div class="error text-muted" v-if="errs.phone">{{errs.phone[0]}}</div>
                <input type="text" class="form-control" id="phone1" v-model="form.phone">
              </div>

              <div class="form-group">
                <label for="address">Address</label>
                <div
                  class="error text-muted"
                  v-if="errs['address.township'] || errs['address.block'] || errs['address.home_no'] || errs['address.street'] || errs['address.state.id']"
                >Your address is not completed</div>

                <div class="row">
                  <div class="col-md-4">
                    <v-select
                      :options="states"
                      label="name"
                      v-model="form.address.state"
                      placeholder="State"
                      @change="loadTownships"
                    ></v-select>
                  </div>
                  <div class="col-md-4">
                    <v-select
                      :options="townships"
                      value="name"
                      label="name"
                      :taggable="true"
                      v-model="form.address.township"
                      placeholder="Township"
                      @change="loadBlocks"
                      :disabled="disable"
                    ></v-select>
                  </div>
                  <div class="col-md-4">
                    <input
                      type="text"
                      v-model="getAddress"
                      class="form-control"
                      id="address"
                      @click="createAddress"
                    >
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-4">
                  <label for="business">Office/Business</label>
                  <div class="error text-muted" v-if="errs.business">{{errs.business[0]}}</div>
                  <select
                    name="business"
                    id="business"
                    v-model="form.business"
                    class="form-control"
                  >
                    <option value disabled>Choose Office/Business</option>
                    <option
                      v-for="business in businesses"
                      :key="business.id"
                      :value="business.id"
                    >{{ business.name }}</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="department">Department</label>
                  <div class="error text-muted" v-if="errs.department">{{errs.department[0]}}</div>
                  <select
                    name="department"
                    id="department"
                    v-model="form.department"
                    class="form-control"
                    @change="loadRoles"
                  >
                    <option value disabled>Choose Department</option>
                    <option
                      v-for="department in departments"
                      :key="department.id"
                      :value="department.id"
                    >{{ department.department_name }}</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="role">Role/Job Title</label>
                  <div class="error text-muted" v-if="errs.role">{{errs.role[0]}}</div>
                  <select
                    name="role"
                    id="role"
                    v-model="form.role"
                    ref="role"
                    class="form-control"
                    disabled="true"
                  >
                    <option value disabled>Choose Role/Job Title</option>
                    <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                  <div class="col-md-6">
                      <label for="username">Login Username</label>
                      <div class="error text-muted" v-if="errs.username">{{errs.username[0]}}</div>
                      <input type="text" class="form-control" v-model="form.username">
                  </div>
                  <div class="col-md-6">
                      <label for="password">Login Password</label>
                      <input type="text" class="form-control" v-model="form.password">
                  </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="close">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
              </div>
            </form>
            
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="newAddressModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Fill Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <div class="form-group">
                <label for="home_no">Home No:</label>
                <input type="text" class="form-control" id="home_no" v-model="form.address.home_no">
              </div>

              <div class="form-group">
                <label for="block">Block</label>
                <input type="text" class="form-control" id="block" v-model="form.address.block">
              </div>

              <div class="form-group">
                <label for="street">Street</label>
                <input type="text" class="form-control" id="street" v-model="form.address.street">
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="close">Close</button>
              <button type="submit" class="btn btn-primary" @click="saveAddress">Create</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      disable: true,
      form: {
        id: "",
        name: "",
        username : "",
        password : "",
        phone: "",
        address: {
          block: "",
          home_no: "",
          street: "",
          township: "",
          state: ""
        },
        business: "",
        department: "",
        role: ""
      },
      roles: [],
      states: [],
      townships: [],
      blocks: [],
      businesses: [],
      departments: [],
      errs: []
    };
  },
  methods: {
    saveAddress() {
      $("#newAddressModal").modal("hide");
    },
    createAddress() {
      $("#newAddressModal").modal("show");
    },
    loadBusinesses() {
      axios
        .get("/api/businesses")
        .then(response => (this.businesses = response.data.data))
        .catch(error => console.log(error.response.data));
    },
    loadDepartments() {
      axios
        .get("/api/departments")
        .then(response => (this.departments = response.data))
        .catch(error => console.log(error.response.data));
    },
    loadRoles(event) {
      let id = event.target.value;
      axios
        .get(`/api/departments/${id}/roles`)
        .then(response => {
          this.roles = response.data;
          this.$refs.role.disabled = false;
        })
        .catch(error => console.log(error.response.data));
    },
    loadStates() {
      axios
        .get("/api/states")
        .then(response => {
          this.states = response.data.filter(function(state) {
            return state.name != "Myanmar";
          });
        })
        .catch(error => console.log(error.response.data));
    },
    loadTownships(state) {
      axios
        .get(`/api/states/${state.id}/townships`)
        .then(response => {
          this.townships = response.data;
          this.disable = false;
        })
        .catch(error => console.log(error.response.data));
    },
    loadBlocks(township) {
      axios
        .get(`/api/townships/${township.id}/blocks`)
        .then(response => {
          this.blocks = response.data;
        })
        .catch(error => console.log(error.response.data));
    },
    deleteStaff(id) {
      axios
        .delete("/api/staffs/" + id)
        .then(response => console.log(response))
        .catch(error => console.log(error));

      Bus.$emit("afterDeleted");
    },
    loadData() {
      axios
        .get("/api/staffs")
        .then(res => (this.staffs = res.data.data))
        .catch(errr => console.log(err.response.data));
    },
    submit() {
        console.log(this.form);
      axios
        .post("/api/staffs/", this.form)
        .then(response => {
          console.log(response);
          Bus.$emit("afterCreated");
          this.close();
        })
        .catch(error => {
          this.errs = error.response.data.errors;
        });
    },
    close() {
      Bus.$emit("cancel");
      this.$router.push("/staffs");
    },
    resetForm() {
      (this.form.name = ""), (this.form.phone = "");
      this.form.address = "";
      this.form.role = "";
    }
  },
  created() {
    this.loadStates();
    this.loadData();
    this.loadBusinesses();
    this.loadDepartments();
  },
  computed: {
    getAddress() {
      return (
        "Home_No: " +
        this.form.address.home_no +
        "/ Block: " +
        this.form.address.block +
        "/ Street: " +
        this.form.address.street
      );
    }
  }
};
</script>
<style scoped>
.error {
  color: #d8000c !important;

  margin-bottom: 10px;
  font-style: italic;
}
</style>

