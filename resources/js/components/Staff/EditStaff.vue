<template>
  <div v-if="show">
    <unauthorized v-if="!authorized"></unauthorized>
    <div v-else>
      <div class="animated zoomIn">
        <div class="container formcolor">
          <div class="row pt-3">
            <div class="col-12">
              <h3>Edit Staff</h3>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-12">
              <form @submit.prevent="submit" method="POST">
                <div class="form-group">
                  <label for="name">Name</label>
                  <p class="error text-muted" v-if="errs.name">{{errs.name[0]}}</p>
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
                    <div class="col-12">
                      <multiselect
                        v-model="form.address.state"
                        track-by="name"
                        :block-keys="['Delete']"
                        placeholder="Choose State"
                        label="name"
                        :options="states"
                        :reset-after="false"
                        @input="loadTownships(form.address.state)"
                        @select="form.address.township=''"
                      ></multiselect>
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-12">
                      <multiselect
                        :options="townships"
                        label="name"
                        :block-keys="['Delete']"
                        v-model="form.address.township"
                        placeholder="Choose Township"
                        @input="loadBlocks"
                        :taggable="true"
                        @tag="addTag"
                        track-by="name"
                      ></multiselect>
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-12">
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

                <div class="form-group">
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

                <div class="form-group">
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

                <div class="form-group">
                  <label for="role">Role/Job Title</label>
                  <div class="error text-muted" v-if="errs.role">{{errs.role[0]}}</div>
                  <select name="role" id="role" v-model="form.role" ref="role" class="form-control">
                    <option value disabled>Choose Role/Job Title</option>
                    <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                  </select>
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
                  <input
                    type="text"
                    class="form-control"
                    id="home_no"
                    v-model="form.address.home_no"
                  >
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
                <button type="button" class="btn btn-secondary" @click="saveAddress">Close</button>
                <button type="submit" class="btn btn-primary" @click="saveAddress">Save</button>
              </div>
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
      errs: [],
      staff: {},
      state: "",
      township: "",
      form: {
        id: "",
        name: "",
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
    loadBlocks(township) {
      if (township) {
        axios
          .get(`/api/townships/${township.id}/blocks`)
          .then(response => {
            this.blocks = response.data;
          })
          .catch(error => console.log(error.response.data));
      }
    },
    close() {
      Bus.$emit("cancel");
      this.$router.push("/staffs");
    },
    submit() {
      axios
        .put(`/api/staffs/${this.staff.no}`, this.form)
        .then(response => {
          // console.log(response);
          Bus.$emit("afterUpdated");
          this.$router.push("/staffs");
        })
        .catch(error => {
          this.errs = error.response.data.errors;
        });
    },
    addTag(newTag) {
      const tag = {
        name: newTag,
        id: this.townships.length
      };
      this.townships.push(tag);
      this.form.address.township = tag;
    },
    shows() {
      this.show = true;
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
    if (User.isLoggedIn()) {
      axios.post("/api/auth/me").then(response => {
        Gate.setUser(response.data.role_id);
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
    this.loadBusinesses();
    this.loadDepartments();
  },
  mounted() {
    let id = this.$route.params.id;
    axios
      .get(`/api/staffs/${id}`)
      .then(response => {
        this.staff = response.data.data;

        this.form.name = this.staff.name;
        this.form.phone = this.staff.phone;
        this.form.address.state = this.staff.address.location.location;
        this.loadTownships(this.form.address.state);

        this.township = this.staff.address.location;

        this.form.address.township = this.staff.address.location;
        this.form.address.home_no = this.staff.address.home_no;
        this.form.address.block = this.staff.address.block;
        this.form.address.street = this.staff.address.street;

        this.form.business = this.staff.business_id;
        this.form.department = this.staff.department_id;

        axios
          .get(`/api/departments/${this.form.department}/roles`)
          .then(response => {
            this.roles = response.data;
          })
          .catch(error => console.log(error.response.data));

        this.form.role = this.staff.role_id;
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