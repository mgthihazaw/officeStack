<template>
  <div class="row">
    <div class="mb-2 col-md-12 row">
      <div class="col-md-5">
        <button class="btn btn-outline-success btn-lg" @click.prevent="createAttribute">
          Add New
          <i class="fa fa-plus"></i>
        </button>
      </div>
      <h3 class="px-4 pt-2 col-md-4 text-left">ATTRIBUTE GROUP TABLE</h3>
    </div>

    <div class="col-md-12">
      <table class="table table-hover">
        <tbody>
          <tr class="heading">
            <th>#</th>
            <th>Attribute Group Name</th>

            <th>Item Type</th>
            <th>Date</th>
            <th style="width: 200px">Action</th>
          </tr>
          <tr v-for="(attribute,index) in attributes" :key="index" class="animated fadeIn">
            <td>{{ paginationData.meta.from + index }}</td>
            <td>{{ attribute.name }}</td>

            <td>{{ attribute.item_type.name}}</td>
            <td>{{ attribute.update_at | myDate}}</td>
            <td style="width: 200px">
              <button class="btn btn-warning btn-sm text-white" @click="editAttribute(attribute)">
                <i class="fa fa-edit"></i>
              </button>

              <button class="btn btn-danger btn-sm" @click="deleteAttribute(attribute.id)">
                <i class="fa fa-times"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination :data="paginationData" @pagination-change-page="getAttribute"></pagination>
    </div>

    <!------------------------MODAL DIALOG------------------------>
    <div
      class="modal fade"
      id="newAttribute"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-if="!edit">Create New Attribute Group</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Edit Attribute Group</h5>
            <button type="button" class="close" @click="cancel()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <div class="form-group">
                <label for="type">Item Type:</label>
                <select
                  name="type"
                  id="type"
                  v-model="form.item_type_id"
                  ref="item"
                  class="form-control"
                >
                  <option value disabled>Choose Item Type</option>
                  <option v-for="type in types" :key="type.id" :value="type.id">{{ type.name }}</option>
                </select>
                <div class="error text-muted" v-if="errors.item_type_id">Item type field is required</div>
              </div>
              <div class="form-group">
                <label for="name">Attribute Value:</label>
                <input type="text" class="form-control" v-model="form.name" />
                <div class="error text-muted" v-if="errors.name">Attribute name field is required</div>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="cancel">Close</button>
              <button
                type="submit"
                class="btn btn-primary"
                v-if="!edit"
                @click="submitAttribute"
              >Create</button>
              <button type="submit" class="btn btn-primary" @click="updateAttribute" v-else>Update</button>
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
      paginationData: {},
      edit: false,
      attributes: [],

      types: [],
      errors: "",
      form: {
        id: "",
        attribute: "",
        item_type_id: ""
      }
    };
  },
  methods: {
    getItemType() {
      axios
        .get("/api/itemtypes")
        .then(res => {
          this.types = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    createAttribute() {
      $("#newAttribute").modal("show");
    },
    submitAttribute() {
      axios
        .post("/api/attributegroups", this.form)
        .then(res => {
          console.log(res);
          this.cancel();
          Toast.fire({
            type: "success",
            title: "Successfully Created "
          });
          Bus.$emit("afterAttributeChange");
        })
        .catch(err => {
          Toast.fire({
            type: "error",
            title: err.response.data.message
          });
          this.errors = err.response.data.errors;

          setTimeout(
            function() {
              this.errors = "";
            }.bind(this),
            3000
          );
        });
    },
    deleteAttribute(id) {
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
            axios.delete("/api/attributegroups/" + id).then(res => {
              Bus.$emit("afterAttributeChange");
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

    cancel() {
      $("#newAttribute").modal("hide");
      this.form = {
        id: "",
        attribute: "",
        item_type_id: ""
      };
    },
    editAttribute(attribute) {
      this.edit = true;
      $("#newAttribute").modal("show");
      this.form.name = attribute.name;
      this.form.id = attribute.id;
      this.form.item_type_id = attribute.item_type.id;
    },
    updateAttribute() {
      axios
        .put(`api/attributegroups/${this.form.id}`, this.form)
        .then(res => {
          this.cancel();
          Toast.fire({
            type: "success",
            title: "Sucessfully Updated"
          });
          Bus.$emit("afterAttributeChange");
          this.edit = false;
        })
        .catch(err => {
          Toast.fire({
            type: "error",
            title: err.response.data.message
          });
          this.errors = err.response.data.errors;

          setTimeout(
            function() {
              this.errors = "";
            }.bind(this),
            3000
          );
        });
    },
    getAttribute(page = 1) {
      axios
        .get("/api/attributegroups?page=" + page)

        .then(res => {
          this.paginationData = res.data;
          this.attributes = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  created() {
    this.getAttribute();
    this.getItemType();
    Bus.$on("afterAttributeChange", () => {
      this.getAttribute();
    });
  },
  beforeDestroy() {
    //While Modal is opened Route change has modal errors.That is dixed this error
    $("#newAttribute").modal("hide");
    $(document.body).removeClass("modal-open");
     $(document.body).css('padding-right',"0px")
    $(".modal-backdrop").remove();
  }
};
</script >


<style scoped>
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
.error {
  color: #d8000c !important;
  margin-top: 2px;
  font-style: italic;
}
</style>



