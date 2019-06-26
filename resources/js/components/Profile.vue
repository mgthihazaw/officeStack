<template>
  <div class="col-md-12 row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link active" href="#account" data-toggle="tab">User Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#secret" data-toggle="tab">Permission Account</a>
            </li>
          </ul>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="account">
              <div class="col-md-12 pt-5 animated zoomIn">
                <div class="card">
                  <div class="card-header">
                    <h3>Profile</h3>
                  </div>
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <h5>Change For Your Account</h5>
                    </div>

                    <form @submit.prevent="changeAccount">
                     
                     <div class="form-group row">
                        <div class="col-md-4">
                          <label for="oldpassword" class="pt-2">Old Password</label>
                        </div>
                        <div class="col-md-8">
                          <input
                            type="password"
                            class="form-control"
                            id="oldpassword"
                            placeholder="Old Password"
                            v-model="formAccount.oldPassword"
                          >
                        </div>
                      </div>


                      <div class="form-group row pt-4">
                        <div class="col-md-4">
                          <label for="newpassword" class="pt-2">New Password</label>
                        </div>
                        <div class="col-md-8">
                          <input
                            type="password"
                            class="form-control"
                            id="newpassword"
                            placeholder="New Password"
                            v-model="formAccount.newPassword"
                          >
                        </div>
                      </div>
                      <div class="form-group row pt-4">
                        <div class="col-md-4">
                          <label for="password_confirmation" class="pt-2">New Password Confirm</label>
                        </div>
                        <div class="col-md-8">
                          <input
                            type="password"
                            class="form-control"
                            id="password_confirmation"
                            placeholder="Confirmed Password"
                            v-model="formAccount.newPassword_confirmation"
                          >
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                          <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="secret">
              <div class="col-md-12 pt-5 animated zoomIn">
                <div class="card">
                  <div class="card-header">
                    <h3>Permission Secret Number</h3>
                  </div>
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <h5>Change For Your Secret Number</h5>
                    </div>

                    <form @submit.prevent="changeSecret">

                      <div class="form-group row">
                        <div class="col-md-4">
                          <label for="exampleInputPassword1" class="pt-2">Your Password</label>
                        </div>
                        <div class="col-md-8">
                          <input
                            type="password"
                            class="form-control"
                            id="exampleInputPassword1"
                            placeholder="Password"
                            v-model="formSecret.password"
                          >
                        </div>
                      </div>


                      <div class="form-group row pt-4">
                        <div class="col-md-4">
                          <label for="secret" class="pt-2">New Secret Number</label>
                        </div>
                        <div class="col-md-8">
                          <input
                            type="password"
                            class="form-control"
                            id="secret"
                            placeholder="Secret Number"
                            v-model="formSecret.newSecret"
                          >
                        </div>
                      </div>
                      <div class="form-group row pt-4">
                        <div class="col-md-4">
                          <label for="secret" class="pt-2">Confirmed Secret Number</label>
                        </div>
                        <div class="col-md-8">
                          <input
                            type="password"
                            class="form-control"
                            id="secret"
                            placeholder="Confirmed Secret Number"
                            v-model="formSecret.newSecret_confirmation"
                          >
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                          <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->

            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      userID: localStorage.getItem("id"),
      formAccount: {
        newPassword: "",
        newPassword_confirmation: "",
        oldPassword: ""
      },
      formSecret: {
        newSecret: "",
        newSecret_confirmation: "",
        password: ""
      }
    };
  },
  methods: {
    changeAccount() {
      axios
        .put(`api/staffs/${this.userID}/changeAccount`, this.formAccount)
        .then(response => {
          this.formAccount = {
            newPassword: "",
            newPassword_confirmation: "",
            oldPassword: ""
          };
          Toast.fire({
            type: "success",
            title: response.data
          });
        });
    },
    changeSecret() {
      axios.put(`/api/staffs/${this.userID}/changeSecret`,this.formSecret)
      .then(response => {
       this.formSecret={
        newSecret: "",
        newSecret_confirmation: "",
        password: ""
      }
         Toast.fire({
            type: "success",
            title: response.data
          });
      })
    }
  }
};
</script>

<style>

</style>
