<template>
  <div v-if="show">
    <unauthorized v-if="!authorized"></unauthorized>

    <div class="container_fluid" v-else>
      <div class="row">
        <div class="card col-md-12">
          <div class="m-3">
            <h3 class="text-capitalize text-dark">
              <i class="fas fa-arrow-circle-left green" @click="back" style="cursor: pointer"></i>
              Service Information
            </h3>
          </div>

          <hr>
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="pb-5">
                  <h6 class="card-title">Customer Name</h6>
                  <p class="card-text text-secondary">{{ service.customer_name}}</p>
                </div>

                <div class="pb-5">
                  <h5 class="card-title">Customer Phone</h5>
                  <p class="card-text text-secondary">{{ service.customer_phone}}</p>
                </div>

                <div class="pb-5">
                  <h5 class="card-title">Customer Address</h5>
                  <p class="card-text text-secondary">{{ service.township}}</p>
                </div>

                <div class="pb-5">
                  <h5 class="card-title">Staff</h5>
                  <p class="card-text text-secondary">{{ service.staff}}</p>
                </div>

                <div class="pb-5">
                  <h5 class="card-title">Service Engineer</h5>
                  <p class="card-text text-secondary">{{ service.service_engineer}}</p>
                </div>
              </div>
              <div class="col-7">
                <div class="pb-5">
                  <h5 class="card-title">Received Description</h5>
                  <p class="card-text text-secondary">{{ service.description}}</p>
                </div>

                <div class="pb-5">
                  <h5 class="card-title">Received Remarks</h5>
                  <p class="card-text text-secondary">{{ service.remark}}</p>
                </div>
                <hr>
                <div class="pb-5">
                  <h5 class="card-title">Service Description</h5>
                  <p class="card-text text-secondary">{{ service.service_description}}</p>
                </div>

                <div class="pb-5">
                  <h5 class="card-title">Service Remark</h5>
                  <p class="card-text text-secondary">{{ service.service_remark}}</p>
                </div>
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
    unauthorized: Unauthorized403
  },
  data() {
    return {
      show: false,
      authorized: false,
      service: ""
    };
  },
  methods: {
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
    shows() {
      this.show = true;
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