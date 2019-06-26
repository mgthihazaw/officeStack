<template>
  <div class="row">
    
      <div class="mb-2 col-md-12 row">
        <div class="col-md-5">
          <button class="btn btn-outline-success btn-lg" @click.prevent="createType">
            Add New
            <i class="fa fa-plus"></i>
          </button>
        </div>
        <h3 class="px-4 pt-2 col-md-4 text-left">ITEM TYPE TABLE</h3>
      </div>

      
      <div class="col-md-12">
        <table class="table table-hover">
          <tbody>
            <tr class="heading">
              <th style="width: 200px">#</th>
              <th>Name</th>
              <th>Date</th>
              <th style="width: 200px">Action</th>
            </tr>
            <tr v-for="(type,index) in itemTypes" :key="index" class="animated fadeIn">
              <td>{{ index+1 }}</td>
              <td>{{ type.name }}</td>
              <td>{{ type.update_at | myDate}}</td>
              <td>
                <button class="btn btn-warning btn-sm text-white" @click="editType(type)">
                  <i class="fa fa-edit"></i>
                </button>
                <button class="btn btn-danger btn-sm" @click="deleteType(type.id)">
                  <i class="fa fa-times"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
    

    <!------------------------MODAL DIALOG------------------------>
    <div
      class="modal fade"
      id="newType"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-if="!edit">Create New Item Type</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Edit Item Type</h5>
            <button type="button" class="close" @click="cancel">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" v-model="form.name">
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="cancel">Close</button>
              <button type="submit" class="btn btn-primary" @click="saveType" v-if="!edit">Create</button>
              <button type="submit" class="btn btn-primary" @click="updateType" v-else>Update</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!------------------------MODAL DIALOG------------------------>
  </div>
</template>

<script>
export default {
  data() {
    return {
      edit: false,
      itemTypes: [],
      form: {
        id: "",
        name: ""
      }
    };
  },
  methods: {
    getItemType() {
      axios
        .get("/api/itemtypes")
        .then(res => {
          this.itemTypes = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    saveType() {
      axios
        .post("api/itemtypes", this.form)
        .then(res => {
          
          this.cancel();
          Toast.fire({
            type: "success",
            title: res.data.message
          });
          Bus.$emit("afterTypeCreated");
        })
        .catch(err => {
          console.log(err);
        });
    },
    deleteType(id) {
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
            axios.delete("/api/itemtypes/" + id).then(res => {
              Bus.$emit("afterTypeDeleted");
              swal.fire("Deleted!", res.data.message, "success");
            });
          }
        })
        .catch(err => {
          Toast.fire({
            type: "error",
            title: err.response.data.message
          });
        });
    },
    editType(type) {
      this.edit = true;
      $("#newType").modal("show");
      this.form.name = type.name;
      this.form.id = type.id;
    },
    updateType() {
      axios
        .put(`api/itemtypes/${this.form.id}`, this.form)
        .then(res => {
          
          this.cancel();
          Toast.fire({
            type: "success",
            title: res.data.message
          });
          Bus.$emit("afterTypeCreated");
        })
        .catch(err => {
          console.log(err);
        });
      this.edit = false;
    },

    createType() {
      $("#newType").modal("show");
    },
    cancel() {
      $("#newType").modal("hide");
      this.form = {
            id: "",
            name: ""
          };
    }
  },
  created() {
    this.getItemType();
    Bus.$on("afterTypeCreated", () => {
      this.getItemType();
    });
    Bus.$on("afterTypeDeleted", () => {
      this.getItemType();
    });
  }
};
</script >


<style scoped>
.table {
  width: 100%;
  height: 100%;
  font-family: 'Poppins', sans-serif !important;
  font-size: 15px;

  line-height: 1.2;
  font-weight: unset !important;
  padding-top: 20px;

  padding-bottom: 20px;
}
table {
  border-collapse: collapse;
  border-radius: 1em;
  overflow: hidden;
  
}
.heading {
  background: rgb(168, 180, 176);
}
.heading th {
  padding: 20px;
}
tbody tr {
  background: rgb(243, 243, 243);
}

td {
  padding: 1em;
  background: #fff;
  border-bottom: 1px solid rgba(191, 236, 197, 0.87);
}
.table-hover tbody tr:hover td {
  background: #e9ecef;
}
</style>
