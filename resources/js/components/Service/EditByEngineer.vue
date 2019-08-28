<template>
  <div>
    <div class="formcolor animated zoomIn">
      <div class="col-md-12">
        <div class="m-3">
          <h3 class="text-capitalize text-dark">
            <i class="fas fa-arrow-circle-left green" @click="back()" style="cursor: pointer"></i>
            Edit By Engineer
          </h3>
        </div>
        <hr />
        <div class>
          <div class="row">
            <div class="col-5">
              <div class="pb-3">
                <h6 class="card-title">Customer Information</h6>
                <p class="card-text text-secondary">{{ service.customer_name}}</p>
                <p class="card-text text-secondary">{{ service.customer_address}}</p>
                <p class="card-text text-secondary">{{ service.customer_phone}}</p>
              </div>

              

              <div class="pb-3">
                <h5 class="card-title">Received Staff</h5>
                <p class="card-text text-secondary">{{ service.staff}}</p>
              </div>

              <div class="info-box bg-light my-4 py-4">
                <div class="info-box-content">
                  <h5 class="info-box-text text-dark">Error Description</h5>
                  <span class="info-box-number  text-info mb-0" v-html = "service.received_description"></span>
                </div>
              </div>
              
              <div class="info-box bg-light my-1 py-4">
                <div class="info-box-content">
                  <h5 class="info-box-text text-dark">Received Description</h5>
                  <span class="info-box-number  text-info mb-0" v-html="service.received_remark"></span>
                </div>
              </div>
              
            </div>

            <div class="col-7 pr-5">
              <form @submit.prevent="updateService">
                <div class="form-group">
                  <label
                    for="service_descriptioin"
                    class="form-control-label card-title"
                  >Service Description</label>
                  <editor
                    :init="{
                      menubar:false,
                       statusbar: false,
                       toolbar : false
                     }"
                     
                    class="form-control"
                    v-model="form.service_description"
                    
                  ></editor>
                  
                  <div
                    class="error"
                    v-for="(error,index) in form_errors['service_description']"
                    :key="index"
                  >{{ error }}</div>
                </div>

                <div class="form-group">
                  <label
                    for="service_descriptioin"
                    class="form-control-label card-title"
                  >Service Remark</label>
                  <editor
                  :init="{menubar:false,
                       statusbar: false,
                       toolbar : false}"
                    class="form-control"
                    v-model="form.service_remark"
                  
                  ></editor>
                  <div
                    class="error"
                    v-for="(error,index) in form_errors['service_remark']"
                    :key="index"
                  >{{ error }}</div>
                </div>

                <div class="form-group row">
                  <label
                    for="service_engineer"
                    class="form-control-label card-title "
                  >Choose Service Engineer</label>
                  <multiselect
                    :options="service_engineers"
                    v-model="form.service_engineer"
                    value="name"
                    track-by="name"
                    :block-keys="['Delete']"
                    placeholder="Choose Service Engineer"
                    label="name"
                  ></multiselect>

                  <div v-if="service_engineer_error" class="error">Select the service engineer</div>
                </div>
                

                <div class="form-group row">
                  <div class="col-10 text-right offset-2">
                    
                    <button type="submit" class="btn btn-secondary" @click="back()">Back</button>
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="secretModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enter secret code</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="street">Your Secret Code</label>
                <input type="password" class="form-control" id="street" v-model="form.secret" />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="close()">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      service: "",
      service_engineers: [],
      form: {
        service_description: "",
        service_remark: "",
        service_engineer: "",
        secret: ""
      },
      form_errors: [],
      service_engineer_error: false
    };
  },
  methods: {
    loadServiceEngineers() {
      axios
        .get("/api/service_engineers")
        .then(response => {
          this.service_engineers = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    loadService() {
      let id = this.$route.params.id;

      axios
        .get(`/api/services/${id}`)
        .then(res => {
          this.service = res.data.data;
          if (this.service.service_engineer) {
            this.form.service_description = this.service.service_description;
            this.form.service_remark = this.service.service_remark;
          }
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    updateService() {
      if (!this.form.service_engineer) {
        this.service_engineer_error = true;
        return;
      }
      if (this.form.secret) {
        let id = this.$route.params.id;
        this.form.service_engineer = this.form.service_engineer.id;
        axios
          .put(`/api/services/${id}`, this.form)
          .then(response => {
            if (response.status == 200) {
              Toast.fire({
                type: "success",
                title: response.data
              });
              this.$router.push("/services");
            }
          })
          .catch(error => {
            
          this.form.secret = ""
            if (error.response.status == 422) {
              Toast.fire({
                type: "error",
                title: error.response.data.message
              });
              this.form_errors = error.response.data.errors;
              this.form.service_engineer = this.service_engineers.find(
                staff => {
                  return staff.no === this.form.service_engineer;
                }
              );
            }

            if (
              error.response.status == 401 &&
              error.response.data == "Your secret is wrong"
            ) {
              Toast.fire({
                type: "error",
                title: error.response.data.error
              });
              this.form.service_engineer = this.service_engineers.find(
                staff => {
                  return staff.no === this.form.service_engineer;
                }
              );

              // this.form.secret = "";
            }
          });
      } else {
        $("#secretModal").modal("show");
      }
    },
    close() {
      $("#secretModal").modal("hide");
    },
    back() {
      this.$router.push("/services");
    }
  },
  created() {
    this.loadService();
    this.loadServiceEngineers();
  },
  beforeDestroy() {
    //While Modal is opened Route change has modal errors.That is dixed this error
    $("#secretModal").modal("hide");
    $(document.body).removeClass("modal-open");
     $(document.body).css('padding-right',"0px")
    $(".modal-backdrop").remove();
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.error {
  color: red;
}
.formcolor {
  background: #ebeff2;
  border-left: 2px solid rgba(113, 190, 152, 0.271);
  border-right: 2px solid rgba(113, 190, 152, 0.271);
  border-top: 20px solid rgba(113, 190, 152, 0.271);
  border-bottom: 2px solid rgba(113, 190, 152, 0.271);
  border-radius: 30px;
}
</style>

