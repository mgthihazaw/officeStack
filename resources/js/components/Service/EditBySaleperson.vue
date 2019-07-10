<template>
  <div class="container formcolor animated fadeInRight" v-if="!show">
    <div class="row formheading">
      <div class="col-12">
        <h3 >Edit by saleperson</h3>
      </div>
    </div>
    <hr>
    <div class="row mt-4">
      <div class="col-12">
        <form @submit.prevent="updateService">
          <label >Customer Information</label>
          <div class="form-group row">
            <div class="col-md-4">
              <input
                type="text"
                class="form-control"
                placeholder="Customer Name"
                v-model="form.customer_name"
                :disabled="disable"
              >
              <div
                class="error"
                v-for="(error,index) in form_errors['customer_name']"
                :key="index"
              >{{ error }}</div>
            </div>
            <div class="col-md-4">
              <input
                type="text"
                class="form-control"
                placeholder="Customer Phone"
                v-model="form.customer_phone"
                :disabled="disable"
              >
              <div
                class="error"
                v-for="(error,index) in form_errors['customer_phone']"
                :key="index"
              >{{ error }}</div>
            </div>
            <div class="col-md-4">
              <input
                type="text"
                class="form-control"
                placeholder="Customer Address"
                v-model="form.customer_address"
                :disabled="disable"
              >
              <div
                class="error"
                v-for="(error,index) in form_errors['customer_address']"
                :key="index"
              >{{ error }}</div>
            </div>
          </div>
           <label >Received Staff</label>
          <div class="form-group row">
            
            <div class="col-12">
              <multiselect
                v-model="form.receive_staff"
                track-by="name"
                :block-keys="['Delete']"
                placeholder="Choose Received Staff"
                label="name"
                :options="receptionists"
              ></multiselect>

              <div
                class="error"
                v-for="(error,index) in form_errors['receive_staff']"
                :key="index"
              >{{ error }}</div>
            </div>
          </div>

          <div class="form-group">
            <label for="description">Service Description</label>
            <textarea
              name="description"
              id="description"
              cols="30"
              rows="5"
              class="form-control"
              v-model="form.description"
            ></textarea>
            <div
              class="error"
              v-for="(error,index) in form_errors['description']"
              :key="index"
            >{{ error }}</div>
          </div>

          <div class="form-group">
            <label for="remark">Product Remarks</label>
            <textarea
              name="remark"
              id="remark"
              cols="30"
              rows="5"
              class="form-control"
              v-model="form.remark"
            ></textarea>
            <div
              class="error"
              v-for="(error,index) in form_errors['remark']"
              :key="index"
            >{{ error }}</div>
          </div>
          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">Update Service</button>
            <button class="btn btn-secondary" @click="close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      disable: false,
      show: true,
      service: "",
      receptionists: [],
      form: {
        customer_name: "",
        customer_phone: "",
        customer_address: "",
        receive_staff: "",
        description: "",
        remark: ""
      },
      form_errors: []
    };
  },
  methods: {
    loadReceptionists() {
      axios
        .get("/api/receptionists")
        .then(response => {
          this.receptionists = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    loadService() {
      let id = this.$route.params.id;

      axios.get(`/api/services/${id}`).then(res => {
        this.service = res.data.data;

        if (this.service.customer_id) {
          this.disable = true;
        }
        this.form.customer_name = this.service.customer_name;
        this.form.customer_phone = this.service.customer_phone;
        this.form.customer_address = this.service.customer_address;
        this.form.description = this.service.received_description;
        this.form.remark = this.service.received_remark;
      
        this.form.receive_staff = this.service.staff_id;
        this.form.receive_staff = this.receptionists.find(staff => {
          return staff.id == this.form.receive_staff;
        });
        this.show = this.service.pending;
      });
    },
    updateService() {
      if (this.form.receive_staff) {
        this.form.receive_staff = this.form.receive_staff.id;
      }

      
      axios
        .put(`/api/services/${this.service.id}`, this.form)
        .then(res => {
          Toast.fire({
              type: "success",
              title: res.data
            });
          this.$router.push("/services");
        })
        .catch(error => {
          Toast.fire({
            type: "error",
            title: error.response.data.message
          });
          this.form.receive_staff = this.receptionists.find(staff => {
            return staff.no === this.form.receive_staff;
          });
          if (error.response.status == 422) {
            this.form_errors = error.response.data.errors;
           
          }
        });
    },
    close() {
      this.$router.push("/services");
    }
  },
  created() {
    this.loadReceptionists();
    this.loadService();
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.error {
  color: red;
}
.formcolor {
  
    background: #EBEFF2;
    border-left: 2px solid rgba(113, 190, 152, 0.271);
    border-right: 2px solid rgba(113, 190, 152, 0.271);
    border-top: 20px solid rgba(113, 190, 152, 0.271);
    border-bottom: 2px solid rgba(113, 190, 152, 0.271);
    border-radius:30px;
}
.formheading {
  padding-top: 10px;
  
}
</style>
