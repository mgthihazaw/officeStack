<template>
  <div v-if="show">
    <unauthorized v-if="!authorized"></unauthorized>

    <div class="container_fluid" v-else>
      <div>
        <div class>
          <div class="row pageHeader">
            <div class="mt-3 col-6">
              <img :src="'/images/logo/1.png'" alt="microstack" width="300px">
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
                      {{ service.description}}
                    </div>

                    <div class="des mb-4 col-6">
                      <h6 class="mb-3">Received Remarks</h6>
                      {{ service.remark}}
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

                  <div class="tb">
                    <div>
                      <h4>Service Cost</h4>
                    </div>

                    <div class="saveform m-3">
                      <form @submit.prevent="save">
                        <div class="row">
                          <div class="col-4">
                            <input
                              class="form-control"
                              type="text"
                              placeholder="Enter input Item"
                              v-model="form.item"
                            >
                          </div>
                          <div class="col-3">
                            <input
                              class="form-control"
                              type="number"
                              v-model.number="form.quantity"
                              placeholder="Enter quantity"
                            >
                          </div>
                          <div class="col-3">
                            <input
                              class="form-control"
                              type="number"
                              v-model.number="form.price"
                              placeholder="Enter Price"
                            >
                          </div>
                          <div class="col-2 pl-5">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-primary" type="submit">
                              <i class="far fa-save"></i>
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!-- /.card-header -->
                    <div class="p-0">
                      <table class="table">
                        <tbody>
                          <tr>
                            <th style="width: 60%">Item</th>
                            <th>Quantity</th>
                            <th style="width: 150px">Price</th>
                            <th></th>
                          </tr>

                          <tr
                            v-for="(data,index) in serviceItems"
                            :key="index"
                            class="animated pulse"
                          >
                            <td>{{data.item}}</td>
                            <td style="padding-left:30px;">{{data.quantity}}</td>
                            <td style="padding-left:20px;">{{data.price}}</td>
                            <td>
                              <button class="btn btn-danger btn-sm" @click="deleteCost(index)">
                                <i class="fas fa-minus"></i>
                              </button>
                            </td>
                          </tr>
                          <tr v-if="serviceItems.length>0">
                            <td ><p class="text-bold">Total</p></td>
                            <td style="padding-left:30px;"></td>
                            <td style="padding-left:20px;"><p class="text-bold">{{ total }}</p></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-success printBtn" @click="print">Print Preview</button>
      </div>
    </div>
  </div>
</template>

<script>
import Unauthorized403 from "../errors/Unauthorized403";

export default {
  components: {
    unauthorized: Unauthorized403
  },
  data() {
    return {
      form: {
        item: "",
        quantity: 1,
        price: 0,
        service_id: this.$route.params.id
      },
      serviceItems: [],
      total: 0,
      show: false,
      authorized: false,
      service: ""
    };
  },
  methods: {
    save() {
      if (this.form.item != "") {
        axios.post("/api/service-item", this.form).then(response => {
          this.serviceItems.push(response.data);
          this.total = 0;
          this.serviceItems.forEach(element => {
            this.total += parseInt(element.price);
          });
          this.form.quantity = "";
          this.form.item = "";
          this.form.price = "";
        });
      }
    },
    deleteCost(index) {
      // console.log(this.serviceItems[index].id);
      axios
        .delete(`/api/service-item/${this.serviceItems[index].id}`)
        .then(response => {
          this.serviceItems.splice(index, 1);
          this.total = 0;
          this.serviceItems.forEach(element => {
            this.total += parseInt(element.price);
          });
        });
    },
    loadService() {
      let id = this.$route.params.id;
      axios
        .get("/api/services/" + id)
        .then(res => {
          this.service = res.data.data;
          if (this.service.service_items != null)
            this.serviceItems = this.service.service_items;
          this.serviceItems.forEach(element => {
            this.total += parseInt(element.price);
          });
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
    }
  },
  created() {
    if (User.isLoggedIn()) {
      axios.post("/api/auth/me").then(response => {
        Gate.setUser(response.data.role_id);

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
</style>