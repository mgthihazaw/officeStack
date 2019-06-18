<template>
  <div class="animated fadeInUp">
    <div class="login-box">
      <!-- <div class="login-logo">
		    <h3>Microstack</h3>
      </div>-->
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <!-- <p class="login-box-msg">Sign in to start your session</p> -->
          <img :src="'/images/1.png'" alt class="img-fluid login-box-msg mt-4 mb-4">

          <form @submit.prevent="login" method="post">
            <div class="input-group mb-5 mt-5">
              <input
                type="text"
                class="form-control"
                placeholder="Username"
                v-model="form.username"
              >
              <div class="input-group-append">
                <span class="fa fa-envelope input-group-text"></span>
              </div>
            </div>
            <div class="input-group mb-5 mt-5">
              <input
                :type="passwordType"
                class="form-control"
                placeholder="Password"
                v-model="form.password"
              >
              <div class="input-group-append">
                <span class="fas fa-eye input-group-text" @click="showHide"></span>
              </div>
            </div>
            <div class="input-group mb-5 mt-5" v-if="login_error">
              <div class="alert alert-danger alert-dismissible col-12">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{{ login_error }}</strong>
              </div>
            </div>
            <div class="row mb-5 mt-5">
              <div class="col-12">
                <button type="submit" class="btn btn-block btn-flat submit">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
  </div>
</template>

<script>
import Gate from "../Helpers/Gate";
export default {
  data() {
    return {
      passwordType: "password",
      businesses: [],
      login_error: "",
      form: {
        username: "",
        password: ""
      }
    };
  },
  methods: {
    login() {
      axios.post("/api/auth/login", this.form)
        .then(response => {
          console.log(response)
          User.store(
            response.data.userID,
            response.data.user,
            response.data.permissions,
            response.data.access_token
          );
          window.location.replace("/");
        })
        .catch(error => {
          console.log(error)
          if (error.response.data.type == "login_fail") {
            this.login_error = error.response.data.error;
          }
        });
    },
    showHide() {
      this.passwordType =
        this.passwordType === "password" ? "text" : "password";
    }
  },
  created() {}
};
</script>

<style scoped>
span {
  cursor: pointer;
}
.card {
  background: rgba(222, 222, 222, 0.7);
}
button.submit {
  background-color: #31bcaa;
  border: 1px solid #31ccaa;
  color: white;
  padding: 8px 0px;
  font-family: "Arial", sans-serif;
  border-radius: 5px !important;
}
button.submit:hover {
  color: white;
}
input {
  font-family: "Arial", sans-serif;
  font-weight: 400;
}
input[type="text"]:focus,
input[type="password"]:focus {
  outline: none !important;
  border-color: #31eeaa;
  box-shadow: 0 0 10px #31eeaa;
}
</style>