<template>
  <div class="row">
    <div class="itemTable col-md-12" v-if="!create" ref="itemTable">
      <div class=" mb-2  row">
        <div class="col-md-5">
          <button class="btn btn-outline-success btn-lg" @click="createItem">
            Add New
            <i class="fa fa-plus"></i>
          </button>
        </div>
        <h3 class="px-4 pt-2 col-md-4 text-left">ITEM TABLE</h3>
      </div>

      <!-- /.card-header -->
      <div class="p-0 col-md-12">
        <table class="table table-hover">
          <tbody>
            <tr class="heading">
              <th style="width: 100px">#</th>
              <th>Name</th>
              <th>Description</th>
              <th>Quantity</th>
              <th>Item Type</th>
              <th>Price</th>
              <th>Date</th>
              <th style="width: 150px">Action</th>
            </tr>
            <tr v-for="(item,index) in items" :key="index" class="animated fadeIn">
              <td>{{ index+1 }}</td>
              <td>{{ item.name }}</td>
              <td>{{ item.description }}</td>
              <td>{{ item.quantity }}</td>
              <td>{{ item.item_type_id }}</td>

              <td>{{ item.price }}</td>
              <td>{{ item.update_at | myDate}}</td>
              <td>
                <button class="btn btn-warning btn-sm text-white">
                  <i class="fa fa-edit" ></i>
                </button>
                <button class="btn btn-danger btn-sm" @click="deleteItem(item.id)">
                  <i class="fa fa-times" ></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>

    <!--------------------ITEM FORM------------------------------------>

    <div class="itemForm mx-5 col-12" v-if="create">
      <div class="container formcolor animated zoomIn">
        <div class="row">
          <div class="col-12">
            <h3 class="pt-3">CREATE ITEM</h3>
          </div>
        </div>
        <hr>
        <div class="row mt-4">
          <div class="col-12">
            <form>
              <h5>1.Insert Item Information</h5>
              <div class="form-group row pt-4">
                <div class="col-md-4">
                  <label for="secret" class="pt-2">Item Name</label>
                </div>
                <div class="col-md-8">
                  <input
                    type="text"
                    class="form-control"
                    id="secret"
                    placeholder="Secret Number"
                    v-model="form.name"
                  >
                </div>
              </div>
              <div class="form-group row pt-4">
                <div class="col-md-4">
                  <label for="secret" class="pt-2">Item Description</label>
                </div>
                <div class="col-md-8">
                  <textarea name id class="form-control"  v-model="form.description"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="exampleInputtext1" class="pt-2"  >Item Quantity</label>
                </div>
                <div class="col-md-8">
                  <input
                    type="number"
                    class="form-control"
                    id="exampleInputtext1"
                    v-model="form.quantity"
                    placeholder="Enter Item Quantity"
                  >
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="exampleInputtext1" class="pt-2">Item Price</label>
                </div>
                <div class="col-md-8">
                  <input
                    type="number"
                    class="form-control"
                    id="exampleInputtext1"
                    placeholder="Enter Item Price"
                    v-model="form.price"

                  >
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="exampleInputtext1" class="pt-2">Item Type</label>
                </div>
                <div class="col-md-8">
                  <multiselect
                        :options="itemTypes"
                        label="name"
                        v-model="itemType"
                        placeholder="Choose Item Type"
                        :taggable="true"
                        :block-keys="['Delete']"
                        
                        
                      ></multiselect>
                </div>
              </div>
              <hr>
              <h5 class="py-3">2.Insert Item Attributes Information</h5>
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="exampleInputtext1" class="pt-2">Item Attribute



                  </label>
                </div>
                <div class="col-md-3">
                  <multiselect
                        :options="itemTypes"
                        label="name"
                        v-model="itemType"
                        placeholder="Choose Item Type"
                        :taggable="true"
                        :block-keys="['Delete']"
                        
                        
                      ></multiselect>
                </div>
                 <div class="col-md-3">
                  <multiselect
                        :options="itemTypes"
                        label="name"
                        v-model="itemType"
                        placeholder="Choose Item Type"
                        :taggable="true"
                        :block-keys="['Delete']"
                       
                        
                      ></multiselect>
                </div>
                <div class="col-md-2 pt-1">
                  <button class="btn btn-primary ">ADD</button>
                </div>
              </div>
              
              <div class="form-group row" >
                  
                <div class="col-md-4 ">
                  <label for="exampleInputtext1" class="pt-2">Item Attribute Detail</label>
                </div>
                <div class="col-md-8">
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action ">
                        Cras justo odio
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                    <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                    <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                    <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">Vestibulum at eros</a>
                    </div>
                </div>
                
              </div>
              
              <div class="form-group row pt-3">
                <div class="col-md-5">
                  
                </div>
                <div class="col-md-4 ">
                  <button class="btn btn-secondary" @click="back">Cancel</button>
                  <button type="button" class="btn btn-primary " @click="submitItem">Save Item</button>
                </div>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>

    <!--------------------ITEM FORM------------------------------------>
  </div>
</template>

<script>
export default {
  data() {
    return {
      edit: false,
      create: false,
      items: [],
      itemTypes : [],
      itemType:'',
      form: {
        id: "",
        name: "",
        description : "",
        quantity : "",
        price: "",
        item_type_id :"",
        attribute_value_id: []
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
    getItem() {
      axios
        .get("/api/items")
        .then(res => {
          this.items = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    createItem() {
      this.create = true;
    },
    cancel() {
      $("#newType").modal("hide");
    },
    submitItem(){
        this.form.item_type_id=this.itemType.id
        axios.post('/api/items',this.form)
        .then( res => {
           this.form={
                id: "",
                name: "",
                description : "",
                quantity : "",
                price: "",
                item_type_id :""
            }
            this.create=false
            Toast.fire({
            type: "success",
            title: res.data.message
          });
          Bus.$emit("afterItemChange");
        })
        .catch(err => {
            console.log(err)
        })
    },
    deleteItem(id) {
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
            axios.delete("/api/items/" + id).then(res => {
              Bus.$emit("afterItemChange");
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
    back() {
      this.create=false
    },
  },
  created() {
      this.getItem()
      this.getItemType();
       Bus.$on("afterItemChange", () => {
      this.getItem();
    });
    
  }
};
</script >

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.table {
  width: 100%;
  height: 100%;
  font-family: Poppins-Regular;
  font-size: 15px;

  line-height: 1.2;
  font-weight: unset !important;
  padding-top: 20px;

  padding-bottom: 20px;
}
table {
  border: 1px solid rgb(111, 161, 136);
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
  padding: 1.5em;
  background: #fff;
  border-bottom: 1px solid rgba(191, 236, 197, 0.87);
}
.table-hover tbody tr:hover td {
  background: #e9ecef;
}

.formcolor {
  background: #ebeff2;
  border-left: 2px solid rgba(113, 190, 152, 0.271);
  border-right: 2px solid rgba(113, 190, 152, 0.271);
  border-top: 20px solid rgba(113, 190, 152, 0.271);
  border-bottom: 2px solid rgba(113, 190, 152, 0.271);
  border-radius: 30px;
}
.form-group .form-control {
  padding: 1.35rem 0.75rem;
}
</style>
