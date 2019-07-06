<template>
  <div v-if="show">
    <unauthorized v-if="!authorized"></unauthorized>

    <div class="container_fluid" v-else>
      <div>
        <div>
          <div class="row pageHeader">
            <div class="mt-3 col-6">
              <img :src="'/images/logo/1.png'" alt="microstack" width="300px" />
            </div>
            <div class="col-6 pt-2">
              <div class="row">
                <div class="col-4">
                  <h6 class="text-dark">Invoice ID</h6>
                </div>
                <div class="col-8">
                  <p class="text-dark">Mrs-{{service.id}}</p>
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <h6 class="text-dark">Invoice Date</h6>
                </div>
                <div class="col-8">
                  <p class="text-dark">{{ service.created_at | myDate}}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-3">
            <div>
              <div class="row customerParent">
                <div class="col-6">
                  <h5 class="pb-2">Customer Information</h5>
                  <div class="row">
                    <div class="col-4">
                      <h6 class="text-dark">Customer Name</h6>
                    </div>
                    <div class="col-8">
                      <p class="text-dark">{{ service.customer_name}}</p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-4">
                      <h6 class="text-dark">Customer Phone</h6>
                    </div>
                    <div class="col-8">
                      <p class="text-dark">{{ service.customer_phone}}</p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-4">
                      <h6 class="text-dark">Customer Address</h6>
                    </div>
                    <div class="col-8">
                      <p class="text-dark">{{ service.township}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <h5 class="pb-2">Company Information</h5>
                  <div class="row">
                    <div class="col-4">
                      <h6 class="text-dark">Company Name</h6>
                    </div>
                    <div class="col-8">
                      <p class="text-dark">Microstack</p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-4">
                      <h6 class="text-dark">Company Street</h6>
                    </div>
                    <div class="col-8">
                      <p class="text-dark">63*64,Kantkaw Street</p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-4">
                      <h6 class="text-dark">Company Email</h6>
                    </div>
                    <div class="col-8">
                      <p class="text-dark">microstack@gmail.com</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="staff">
                <h4 class="pb-2">Staff Information</h4>
                <div>
                  <div class="row">
                    <div class="col-2">
                      <h6 class="text-dark">Received Staff</h6>
                    </div>
                    <div class="col-10">
                      <p class="text-dark">{{ service.staff}}</p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="des mb-4 col-6">
                      <h6 class="mb-3">Received Description</h6>
                      {{ service.received_description}}
                    </div>

                    <div class="des mb-4 col-6">
                      <h6 class="mb-3">Received Remarks</h6>
                      {{ service.received_remark}}
                    </div>
                  </div>

                  <div class="row">
                    <div class="des mb-4 col-6">
                      <h6 class="mb-3">Service Description</h6>
                      {{ service.service_description}}
                    </div>

                    <div class="des mb-4 col-6">
                      <h6 class="mb-3">Service Remarks</h6>
                      {{ service.service_remark}}
                    </div>
                  </div>

                  <div class="p-0">
                    <table class="table table-hover">
                      <tbody>
                        <tr class="heading" v-if="serviceItems.length>0">
                          <th style="width: 100px">No.</th>
                          <th>Name</th>

                          <th>Quantity</th>
                          <th>Unit Price</th>
                          <th>Amount</th>
                          <th style="width: 100px"></th>
                        </tr>

                        <tr
                          v-for="(item,index) in serviceItems"
                          :key="index"
                          class="animated fadeIn"
                        >
                          <td>{{ index+1 }}</td>
                          <td class="ml-2">
                            {{ item.brand.name }}
                            <span
                              v-for="(attribute,index) in item.attributes"
                              :key="index"
                            >{{ attribute.name }} &nbsp;</span>
                          </td>

                          <td class="ml-2">
                            <input type="number" class="form-control" v-model="item.quantity" />
                            <span class="inputData">{{ item.quantity }}</span>
                          </td>

                          <td class="ml-2">
                            <input type="number" v-model="item.price" class="form-control" />
                            <span class="inputData">{{ item.price }}</span>
                          </td>
                          <td class="ml-2">
                            <input type="number" v-model="item.amount" class="form-control" />
                            <span class="inputData">{{ item.amount }}</span>
                          </td>
                          <td>
                            <button class="btn btn-danger btn-sm" @click="deleteItem(index)">
                              <i class="fas fa-minus"></i>
                            </button>
                          </td>
                        </tr>

                        <tr v-if="serviceItems.length > 0">
                          <td>
                            <p class="text-bold"></p>
                          </td>
                          <td style="padding-left:30px;"></td>
                          <td></td>
                          <td>Total</td>
                          <td style="padding-left:10px;">
                            <p class="text-bold ml-2">{{ getTotal }}</p>
                          </td>
                          <td>
                            <button class="btn btn-secondary" @click="save">
                              Save &nbsp;
                              <i class="fas fa-save"></i>
                            </button>
                          </td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <!-- /.card -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <button
          class="btn btn-success printBtn"
          @click="print"
          :disabled="printDisable"
        >Print Preview</button>
        <button
          type="button"
          class="btn btn-info printBtn"
          data-toggle="modal"
          data-target="#modal-xl"
        >
          Add Item
          <i class="ml-2 fas fa-plus-circle fa-1x"></i>
        </button>
      </div>

      <!--------------------Modal--------------------------->
      <div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true" ref="modal">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-info">Add Item for Service</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body bg-light">
              <search></search>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!--------------------Modal--------------------------->
    </div>
  </div>
</template>

<script>
import Unauthorized403 from "../errors/Unauthorized403";
import Search from "./Search";

export default {
  components: {
    unauthorized: Unauthorized403,
    Search
  },
  data() {
    return {
      total: 0,
      show: false,
      authorized: false,
      service: "",
      serviceItems: [],
      printDisable: false
    };
  },
  methods: {
    loadService() {
      let id = this.$route.params.id;
      axios
        .get("/api/services/" + id + "/items")
        .then(res => {
          this.service = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    back() {
      this.$router.go(-1);
    },
    shows() {
      this.show = true;
    },
    print() {
      window.print();
    },

    deleteItem(index) {
      this.serviceItems.splice(index, 1);
      this.printDisable=true

    },
    save(){
      let data = []
      this.serviceItems.forEach( serviceItem => {
        let newData = {'item_id' : serviceItem.id,'quantity' : serviceItem.quantity ,'price' : serviceItem.price}
        data.push(newData) 
      })
      
      console.log(data)
      axios.post(`/api/services/${this.service.id}/items`,data)
      .then( response => {
        console.log(response)
        this.printDisable = false
      })
      .catch(err => {
        console.log(err)
      })

    }
  },
  created() {
    Bus.$on("addItemForService", item => {
      item = { ...item, quantity: 1, amount: item.price };

      this.serviceItems.push(item);
      this.serviceItems = this.serviceItems.reduce((serviceItem, current) => {
        const x = serviceItem.find(item => item.id === current.id);
        if (!x) {
          return serviceItem.concat([current]);
        } else {
          return serviceItem;
        }
      }, []);

      this.printDisable = true;
    });
    if (User.isLoggedIn()) {
      axios.post("/api/auth/me").then(response => {
        Gate.setUser(response.data.user.roles, response.data.user.permissions);

        if (!(Gate.isSaleperson() || Gate.isServiceEngineer())) {
          this.shows();
          this.authorized = false;
        } else {
          this.shows();
          this.authorized = true;
        }
      });
    }

    this.loadService();
  },
  watch: {
    serviceItems: {
      handler: function(after, before) {
        before.forEach(data => {
          data.amount = data.quantity * data.price;
          // console.log(data.quantity, data.price);
        });
      },
      deep: true
    }
  },
  computed: {
    getTotal() {
      this.total = 0;
      let data;

      data = this.serviceItems.forEach(serviceItem => {
        this.total += serviceItem.amount;
        return this.total;
      });
    }
  }
};
</script>


<style scoped>
h1,
h2,
h3,
h4,
h5 {
  font-weight: 500;
  line-height: 1.4em;
}
h6 {
  font-weight: bold;
  line-height: 1.4em;
}

.customerParent {
  border-bottom: 1px solid #7e7e7e;
}
.pageHeader {
  margin: 0;
  padding: 0px;
  border-bottom: 1px solid #7e7e7e;
}
.staff {
  padding-top: 20px;
}
.des {
  background-color: #eff0f1;
  border-left: 3px solid #59997b;
}
@media print {
  .printBtn {
    display: none;
  }
  button {
    display: none;
  }
  input {
    display: none;
  }
  span.inputData {
    display: block;
  }
  .des {
    display: none;
  }
  .saveform {
    display: none;
    margin: 0;
  }
}
.tb {
  padding: 0;
  margin: 0;
}
.inputData {
  display: none;
}
</style>