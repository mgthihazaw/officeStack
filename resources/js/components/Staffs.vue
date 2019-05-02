<template>
<div v-if="show">
  <unauthorized v-if="!authorized"></unauthorized>
  <div v-else>
    
    <div class="row" v-if="(!createMode && !editMode)">
      <div class="col-12">
        <h1 class="page-header mirim_font">Staffs List</h1>
        <button class="btn btn-success btn-sm mt-2 mb-3" @click="create">New Stafff</button>

        <table class="table table-hover">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Business/Office</th>
              <th>Department</th>
              <th>Role/Job Title</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(staff,index) in staffs" :key="staff.id">
              <td>{{ index + 1 }}</td>
              <td>{{ staff.name }}</td>
              <td>{{ staff.phone }}</td>
              <td>
                {{
                staff.address.home_no !== null ? staff.address.home_no + ', ' : ''
                }}
                {{
                staff.address.street !== null ? staff.address.street + ', ' : ''
                }}
                {{
                staff.address.block !== null ? staff.address.block : ''
                }}
              </td>
              <td>{{ staff.business }}</td>
              <td>{{ staff.department }}</td>
              <td>{{ staff.role }}</td>
              <td>
                <button class="btn btn-info btn-sm text-white" @click="editStaff(staff)">
                  <i class="fa fa-edit"></i>
                </button>
                <button class="btn btn-danger btn-sm" @click="deleteStaff(staff.no)">
                  <i class="fa fa-times"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <br>
        <br>
      </div>
    </div>
  </div>
</div>
</template>

<style scoped>
</style>

<script>
import Unauthorized403 from "./errors/Unauthorized403";
import CreateStaff from "./Staff/CreateStaff.vue";
import EditStaff from "./Staff/EditStaff.vue";

export default {
  components: {
    CreateStaff,
    EditStaff,
    Unauthorized: Unauthorized403
  },
  data() {
    return {
      show:false,
      authorized:false,
      createMode: false,
      editMode: false,
      edit: false,
      staffs: {},
      editstaff: {}
    };
  },
  methods: {
    editStaff(staff) {
      this.editMode = true;
      this.editstaff = staff;

      this.$router.push(`/staffs/edit/${staff.no}`);
    },
    deleteStaff(id) {
      axios
        .delete("/api/staffs/" + id)
        .then(response => {
          Toast.fire({
            type: "success",
            title: "Successfully Deleted"
          });
        })
        .catch(error => console.log(error));

      Bus.$emit("afterDeleted");
    },
    loadData() {
      axios
        .get("/api/staffs")
        .then(res => {
          this.staffs = res.data.data;
        })
        .catch(errr => {
          console.log(errr.response.status);
          if (errr.response.status === 403) {
            // Bus.$emit('logout');
          }
        });
    },
    create() {
      this.createMode = true;
      this.$router.push("/staffs/create");
    },
    shows(){
			this.show=true
		}
  },
  created() {
    
    
     if (User.isLoggedIn()) {
      axios.post("/api/auth/me").then(response => {
        Gate.setUser(response.data.role_id);
        if (!Gate.isDeveloper()) {
					this.shows()
          this.authorized = false;
        } else {
					this.shows()
          this.authorized = true;
        }
      });
    }

    
    this.loadData();
    Bus.$on("afterCreated", () => {
      this.loadData();
    });

    Bus.$on("afterUpdated", () => {
      this.loadData();
    });

    Bus.$on("afterDeleted", () => {
      this.loadData();
    });

    Bus.$on("cancel", () => {
      this.createMode = false;
      this.editMode = false;
    });
  }
};
</script>
<style scoped>
td {
  line-height: 1.4em;
  font-family: "Zawgyi";
}
.table-hover tbody tr:hover td {
    background: rgba(113, 190, 152, 0.271);
}
</style>
