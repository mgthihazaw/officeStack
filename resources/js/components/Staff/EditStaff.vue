<template>
  <div v-if="show">
    <unauthorized v-if="!can('staff-update')"></unauthorized>
    <div v-else>
      <div class="animated zoomIn">
        <div class="container formcolor">
          <div class="row pt-3">
            <div class="col-12">
              <h3>Edit Staff</h3>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-12">
              <form @submit.prevent="submit" method="POST">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="name">Name</label>
                    <p class="error text-muted" v-if="errs.name">{{errs.name[0]}}</p>
                    <input type="text" class="form-control" id="name" v-model="form.name" />
                  </div>
                  <div class="col-md-6">
                    <label for="phone1">Phone Numbers</label>
                    <div class="error text-muted" v-if="errs.phone">{{errs.phone[0]}}</div>
                    <input type="text" class="form-control" id="phone1" v-model="form.phone" />
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
                        track-by="name"
                        :block-keys="['Delete']"
                        placeholder="Choose State"
                        label="name"
                        :options="states"
                        :reset-after="false"
                        @input="loadTownships(form.state)"
                        @select="form.township=''"
                      ></multiselect>
                    </div>
                    <div class="col-md-4">
                      <multiselect
                        :options="townships"
                        label="name"
                        :block-keys="['Delete']"
                        v-model="form.township"
                        placeholder="Choose Township"
                        :taggable="true"
                        @tag="addTag"
                        track-by="name"
                      ></multiselect>
                    </div>
                    <div class="col-md-4">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter Address"
                        v-model="form.address_line"
                      />
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
                      @change="changeDepartments"
                      required
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
                      ref="department"
                      @change="changeRoles"
                      placeholder="Choose Department"
                      required
                    >
                      <option value="0" disabled>Select Department</option>
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
                    <select v-model="form.role" class="form-control" ref="role" required>
                      <option value="0" disabled>Select Role</option>
                      <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="username">Username</label>
                    <div class="error text-muted" v-if="errs.username">{{errs.username[0]}}</div>
                    <input type="text" class="form-control" id="username" v-model="form.username" />
                  </div>
                  <div class="col-md-6">
                    <label for="password">Password</label>
                    <div class="error text-muted" v-if="errs.password">{{errs.password[0]}}</div>
                    <input type="text" class="form-control" id="password" v-model="form.password" />
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" @click="close">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
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
      
      errs: [],
      staff: {},
      state: "",
      township: "",
      form: {
        id: "",
        name: "",
        phone: "",
        township: "",
        state: "",
        business: "",
        department: "",
        username: "",
        password: "",
        role: ""
      },
      roles: [],
      states: [],
      townships: [],
      blocks: [],
      businesses: [],
      departments: []
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
    changeDepartments(event) {
      let business_id = event.target.value;
      axios
        .get(`/api/businesses/${business_id}/departments`)
        .then(response => {
          this.departments = response.data.data;
          this.form.department = 0;
          this.form.role = 0;
          this.roles = [];
        })
        .catch(error => console.log(error.response));
    },
    loadDepartments(business) {
      axios
        .get(`/api/businesses/${business}/departments`)
        .then(response => {
          this.departments = response.data.data;
        })
        .catch(error => console.log(error.response.data));
    },
    changeRoles(event) {
      let department_id = event.target.value;
      axios
        .get(`/api/departments/${department_id}/roles`)
        .then(response => {
          this.roles = response.data;
        })
        .catch(error => console.log(error.response.data));
    },
    loadRoles(department) {
      axios
        .get(`/api/departments/${department}/roles`)
        .then(response => {
          this.roles = response.data;
          //this.form.role = ''
          //console.log(this.roles);
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
      if (state) {
        axios
          .get(`/api/states/${state.id}/townships`)
          .then(response => {
            this.townships = response.data;
            // console.log(this.townships.includes(this.township));
          })
          .catch(error => console.log(error.response.data));
      }
    },
    close() {
      Bus.$emit("cancel");
      this.$router.push("/staffs");
    },
    submit() {
      if (this.form.state) {
        this.form.state = this.form.state.id;
      }

      this.form.department = this.form.department;
      this.form.township = this.form.township.name;

      axios
        .put(`/api/staffs/${this.staff.id}`, this.form)
        .then(response => {
          //console.log(response);
          if (response.status == 201) {
            Toast.fire({
              type: "success",
              title: "Staff Successfully Updated"
            });
          }
          Bus.$emit("afterUpdated");
          this.$router.push("/staffs");
        })
        .catch(error => {
          Toast.fire({
            type: "error",
            title: error.response.data.message
          });
          if (error.response.status == 422) {
            this.errs = error.response.data.errors;
            this.form.state = this.staff.state;
            this.loadTownships(this.form.state);

            this.form.township = this.staff.township;
            this.form.address_line = this.staff.address;
          }
          setTimeout(
            function() {
              this.errs = "";
            }.bind(this),
            3000
          );
        });
    },
    addTag(newTag) {
      let townshipId = 0;
      if (this.townships.length > 0) {
        townshipId = this.townships.length;
      }
      const tag = {
        name: newTag,
        id: townshipId
      };
      this.townships.push(tag);
      this.form.township = tag;
    }
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
  },

  created() {
    thia.auth();
    this.loadStates();
    this.loadBusinesses();
    // this.loadDepartments();
    let id = this.$route.params.id;

    axios
      .get(`/api/staffs/${id}`)
      .then(response => {
        this.staff = response.data.data;
        console.log(this.staff);
        this.form.name = this.staff.name;
        this.form.phone = this.staff.phone;
        this.form.state = this.staff.state;
        this.form.username = this.staff.username;
        this.loadTownships(this.form.state);

        this.form.township = this.staff.township;
        this.form.address_line = this.staff.address;

        this.form.business = this.staff.business.id;
        this.loadDepartments(this.form.business);
        this.form.department = this.staff.department.id;
        this.loadRoles(this.form.department);
        this.form.role = this.staff.role.id;

        // axios
        //   .get(`/api/departments/${this.form.department.id}/roles`)
        //   .then(response => {
        //     this.roles = response.data;
        //   })
        //   .catch(error => console.log(error.response.data));
      })
      .catch(error => {
        console.log(error);
      });
  }
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
  background: #ebeff2;
  border-left: 2px solid rgba(113, 190, 152, 0.271);
  border-right: 2px solid rgba(113, 190, 152, 0.271);
  border-top: 20px solid rgba(113, 190, 152, 0.271);
  border-bottom: 2px solid rgba(113, 190, 152, 0.271);
  border-radius: 30px;
}
</style>