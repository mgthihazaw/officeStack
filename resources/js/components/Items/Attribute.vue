<template>
  <div class="row">
    <div class="mb-2 col-md-12 row">
      <div class="col-md-5">
        <button class="btn btn-outline-success btn-lg" @click.prevent="createAttribute">
          Add New
          <i class="fa fa-plus"></i>
        </button>
      </div>
      <h3 class="px-4 pt-2 col-md-4 text-left">ATTRIBUTE TABLE</h3>
    </div>

    <div class="col-md-12">
      <table class="table table-hover">
        <tbody>
          <tr class="heading">
            <th >#</th>
            <th>Attribute Name</th>
            <th>Attribute Value</th>
            <th>Item Type</th>
            <th>Date</th>
            <th style="width: 200px">Action</th>
          </tr>
          <tr v-for="(attribute,index) in attributes" :key="index" class="animated fadeIn">
            <td>{{ index+1 }}</td>
            <td>{{ attribute.name }}</td>
             <td>
               4GB<br>
               8GB<br>
               16GB<br>
               32GB<br>
               64GB<br>
             
             </td>
            <td>{{ attribute.item_type_id}}</td>
            <td>{{ attribute.update_at | myDate}}</td>
            <td style="width: 200px">
              <button class="btn btn-warning btn-sm text-white">
                <i class="fa fa-edit"></i>
              </button>
              <button class="btn btn-info btn-sm" >
                <i class="fas fa-upload"></i>
               </button>
              <button class="btn btn-danger btn-sm" @click="deleteAttribute(attribute.id)">
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
            <h5 class="modal-title" id="exampleModalLabel" v-if="!edit">Create New Attribute</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Edit Item Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                  @change=loadAttribute(form.item_type_id)
                >
                  <option value disabled>Choose Item Type</option>
                  <option v-for="type in types" :key="type.id" :value="type.id">{{ type.name }}</option>
                </select>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                   <label for="name">Attribute Name:</label>
                     <multiselect
                        :options="attributes"
                        label="name"
                        v-model="form.attribute"
                        placeholder="Choose Attribute"
                        :taggable="true"
                        :block-keys="['Delete']"
                        @tag="addTag"
                        
                      ></multiselect>
                </div>
                <div class="col-md-6">
                   <label for="name">Attribute Value:</label>
                     <input type="text" class="form-control" v-model="form.attribute_value">
                </div>
               
              </div>
              
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="cancel">Close</button>
              <button type="submit" class="btn btn-primary" v-if="!edit" @click="submitAttribute">Create</button>
              <button type="submit" class="btn btn-primary" v-else>Update</button>
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
      attributes: [],
      types: [],
      attributeNames:[],
      form: {
        id: "",
        attribute: "",
        attribute_value:'',
        item_type_id: ""
      },
      
    };
  },
  methods: {
    getAttribute() {
      axios
        .get("/api/attributes")
        .then(res => {
          this.attributes = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
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
      $("#newType").modal("show");
    },
    submitAttribute(){
      axios.post('/api/attributes',this.form)
      .then(res =>{
        this.cancel()
        this.form={
                id: "",
                name: "",
                item_type_id :""
            }
            
            Toast.fire({
            type: "success",
            title: res.data.message
          });
          Bus.$emit("afterAttributeChange");

      })
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
            axios.delete("/api/attributes/"+id).then(res => {
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
    loadAttribute(id){
      console.log("/api/attributes/"+id)
       axios
        .get("/api/attributes/"+id)
        .then(res => {
          this.attributeNames = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },

    cancel() {
      $("#newType").modal("hide");
    },
    addTag(newTag) {
      const tag = {
        name: newTag,
        id: this.attributes.length
      };
      this.attributes.push(tag);
      this.form.attribute = tag;
    },
     
  },
  created() {
    this.getAttribute()
    this.getItemType();
    Bus.$on("afterAttributeChange",()=>{
      this.getAttribute()
    });
  }
};
</script >

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
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
</style>
