<template>
  <div v-if="show">
    <unauthorized v-if="!authorized"></unauthorized>

    <div class="container_fluid" v-else>
      <div>
        <div class="">
          <div class="row pageHeader">
            <div class="mt-3 col-6">
              <img :src="'/images/logo/1.png'" alt="microstack" width="300px">
            </div>
            <div class="col-6 pt-2">
              
              <div class="row">
                <div class="col-3">
                  <p class="text-dark">Invoice ID</p>
                </div>
                <div class="col-8">
                  <p class="text-secondary">Mrs-{{service.id}}</p>
                </div>
              </div>

              <div class="row">
                <div class="col-3">
                  <p class="text-dark">Invoice Date</p>
                </div>
                <div class="col-8">
                  <p class="text-secondary">{{ service.created_at | myDate}}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-3">
            <div >
              <div class="customerParent row">
                <div class="col-6 ">
                  <h5 class="pb-2">Customer Information</h5>
                  <div class="row">
                    <div class="col-4">
                      <span class="text-dark">Customer Name</span>
                    </div>
                    <div class="col-8">
                      <p class="text-secondary">{{ service.customer_name}}</p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-4">
                      <p class="text-dark">Customer Phone</p>
                    </div>
                    <div class="col-8">
                      <p class="text-secondary">{{ service.customer_phone}}</p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-4">
                      <p class="text-dark">Customer Address</p>
                    </div>
                    <div class="col-8">
                      <p class="text-secondary">{{ service.township}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <h5 class="pb-2">Company Information</h5>
                  <div class="row">
                    <div class="col-3">
                      <p class="text-dark">Company Name</p>
                    </div>
                    <div class="col-8">
                      <p class="text-secondary">Microstack</p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-3">
                      <p class="text-dark">Company Street</p>
                    </div>
                    <div class="col-8">
                      <p class="text-secondary">63*64,Kantkaw Street</p>
                    </div>
                  </div>
                </div>
                </div>
                <div class="staff col-12">
                  <h4 class="pb-2">Staff Information</h4>
                  <div>
                    <div class="row">
                      <div class="col-2">
                        <h6 class="text-secondary">Received Staff</h6>
                      </div>
                      <div class="col-10">
                        <p class="text-italic text-dark">{{ service.staff}}</p>
                      </div>
                    </div>

                    <div class="callout callout-info mb-4 col-10">
                      <h6 class="mb-3">Received Description</h6>
                      {{ service.description}}
                    </div>

                    <div class="callout callout-info mb-3 col-10">
                      <h6 class="mb-3">Received Remarks</h6>
                      {{ service.remark}}
                    </div>
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
      show:false,
      authorized: false,
      service: ""
    };
  },
  methods: {
      print(){
          window.print()
      },
    loadService() {
      let id = this.$route.params.id;
      axios
        .get("/api/services/" + id)
        .then(res => {
          this.service = res.data.data;
          console.log(this.service);
        })
        .catch(err => {
          console.log(err);
        });
    },
    back() {
      this.$router.go(-1);
    },
    shows(){
      this.show=true
    }
  },
  created() {
    if (User.isLoggedIn()) {
      axios.post("/api/auth/me").then(response => {
        Gate.setUser(response.data.role_id);

        if (!(Gate.isSaleperson() || Gate.isServiceEngineer())) {
          this.shows()
          this.authorized = false;
        } else {
          this.shows()
          this.authorized = true;
        }
      });
    }

    this.loadService();
  }
};
</script>

<style scoped>
.customerParent {
  
  border-bottom: 1px solid #7e7e7e;
  
}
.pageHeader {
  margin:0;
  padding: 0px;
  border-bottom: 1px solid #7e7e7e;
}
.staff {
  padding-top: 20px;
}
.callout {
  background-color: #eff0f1;
  border-left: 5px solid #7e7e7e;
  
}

  

</style>
