<template>
  <div v-if="show">
    <unauthorized v-if="!authorized"></unauthorized>
    <div v-else>
      <div class="animated zoomIn">
        <div class="container formcolor">
          <div class="row pt-3">
            <div class="col-12">
              <h3>New Staff</h3>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-12">
              <form @submit.prevent="submit" method="POST">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="name">Name</label>
                  <div class="error text-muted" v-if="errs.name">{{errs.name[0]}}</div>
                  <input type="text" class="form-control" id="name" v-model="form.name">
                  </div>
                  <div class="col-md-6">
                    <label for="phone1">Phone Numbers</label>
                  <div class="error text-muted" v-if="errs.phone">{{errs.phone[0]}}</div>
                  <input type="text" class="form-control" id="phone1" v-model="form.phone">
                  </div>
                </div>
                

                <div class="form-group">
                  <label for="address">Address</label>
                  <div
                    class="error text-muted"
                    v-if="errs['address.township'] || errs['address.block'] || errs['address.home_no'] || errs['address.street'] || errs['address.state.id']"
                  >Your address is not completed</div>

                  <div class="row">
                    <div class="col-md-4">
                      <multiselect
                        v-model="form.state"
                        placeholder="Choose State"
                        label="name"
                        :block-keys="['Delete']"
                        track-by="name"
                        :options="states"
                        @select="loadTownships"
                      ></multiselect>
                    </div>
                    <div class="col-md-4">
                      <multiselect
                        :options="townships"
                        label="name"
                        v-model="form.township"
                        placeholder="Choose Township"
                        :taggable="true"
                        :block-keys="['Delete']"
                        @tag="addTag"
                        :disabled="disable"
                      ></multiselect>
                    </div>
                    <div class="col-md-4">
                      <input
                        type="text"
                        v-model="form.address_line"
                        class="form-control"
                        id="address"
                        placeholder="Address Line"
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
                      @change="loadDepartments"
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
                      disabled="true"
                      ref="department"
                    >
                      <option value disabled>Choose Department</option>
                      <option
                        v-for="department in departments"
                        :key="department.id"
                        :value="department.id"
                      >{{ department.name }}</option>
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
                      <option selected disabled>Choose Role/Job Title</option>
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
                    <div class="error text-muted" v-if="errs.password">{{errs.password[0]}}</div>
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

      
    </div>
  </div>
</template>

<script>
import Unauthorized403 from "../errors/Unauthorized403";
export default {
  components: {
    Unauthorized: Unauthorized403
  },
  data() {
    return {
      show: false,
      authorized: false,
      disable: true,
      form: {
        id: "",
        name: "",
        username: "",
        password: "",
        phone: "",
        state: "",
        township:'',
        address_line:'',
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
    loadDepartments(event) {
      let business_id = event.target.value;
      axios
        .get(`/api/businesses/${business_id}/departments`)
        .then(response => {
          this.departments = response.data.data
          this.$refs.department.disabled = false;
        })
        .catch(error => console.log(error.response.data));
    },
    loadRoles(event) {
      let department_id = event.target.value;
      axios
        .get(`/api/departments/${department_id}/roles`)
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
            return state.id != 1;
          });
        })
        .catch(error => console.log(error.response.data));
    },
    loadTownships(state) {
      this.form.township = "";
      if (state) {
        axios
          .get(`/api/states/${state.id}/townships`)
          .then(response => {
            this.townships = response.data;
            this.disable = false;
          })
          .catch(error => console.log(error.response.data));
      }
    },
    loadBlocks(township) {
      axios
        .get(`/api/townships/${township.id}/blocks`)
        .then(response => {
          this.blocks = response.data;
        })
        .catch(error => console.log(error.response.data));
    },

    loadData() {
      axios
        .get("/api/staffs")
        .then(res => (this.staffs = res.data.data))
        .catch(errr => console.log(err.response.data));
    },
    submit() {
      this.form.township=this.form.township.name
      this.form.state = this.form.state.id
      axios
        .post("/api/staffs/", this.form)
        .then(response => {
          if(response.status == 201){
            Toast.fire({
              type: "success",
              title: "Staff Created Successfully"
            });
            Bus.$emit("afterCreated");
            this.close();
          }
          
        })
        .catch(error => {
          Toast.fire({
            type: "error",
            title: error.response.data.message
          });
          this.errs = error.response.data.errors;
          setTimeout(function(){
            this.errs = ""
          }.bind(this),3000)
        });
    },
    close() {
      this.$router.push("/staffs");
      Bus.$emit("cancel");
    },
    resetForm() {
      (this.form.name = ""), (this.form.phone = "");
      this.form.address = "";
      this.form.role = "";
    },
    shows() {
      this.show = true;
    },
    addTag(newTag) {
      const tag = {
        name: newTag,
        id: this.townships.length
      };
      this.townships.push(tag);
      this.form.township = tag;
    }
  },
  created() {
    if (User.isLoggedIn()) {
      axios.post("/api/auth/me").then(response => {
        Gate.setUser(response.data.user.roles,response.data.user.permissions);
        if (!Gate.isDeveloper()) {
          this.shows();
          this.authorized = false;
        } else {
          this.shows();
          this.authorized = true;
        }
      });
    }
    this.loadStates();
    this.loadData();
    this.loadBusinesses();
  },
 
  
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.error {
  color: #d8000c !important;

  margin-bottom: 10px;
  font-style: italic;
}
.formcolor {
  
    background: #EBEFF2;
    border-left: 2px solid rgba(113, 190, 152, 0.271);
    border-right: 2px solid rgba(113, 190, 152, 0.271);
    border-top: 20px solid rgba(113, 190, 152, 0.271);
    border-bottom: 2px solid rgba(113, 190, 152, 0.271);
    border-radius:30px;
}
</style>

