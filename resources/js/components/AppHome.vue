<template>
    <div class="wrapper">
        <login v-if="!isLoggedIn"></login>
        <div v-if="isLoggedIn">
        <nav class="main-header navbar navbar-expand bg-success navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu"><i class="fa fa-bars black"></i></a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidecolor elevation-4">
    <!-- Brand Logo -->
    <router-link to="/" class="brand-link">
    
      <img :src="'/images/logo/2.png'" alt="Microstack Logo" class="brand-image  elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light text-primary"><br></span>
    </router-link>

    <!-- Sidebar -->
    <hr>
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2  mb-3 d-flex">
        <div class="image">
          <img :src="'/images/profile.jpg'" class="img-circle elevation-2" alt="User Image">
        </div>
        
        <div class="info">
          <a  class="d-block">{{ username }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class=" text-white">
        
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <router-link to="/" class="nav-link" v-if="StaffShow()">
              <i class="nav-icon green fas fa-tachometer-alt"></i>
              <p>
                DASHBOARD
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon indigo fas fa-user"></i>
              <p>
                PROFILE
              </p>
            </router-link>
          </li>
          

          <li class="nav-item">
            <router-link class="nav-link" to="/staffs" v-if="StaffShow()">
                <i class="nav-icon indigo fas fa-people-carry"></i>
                <p>STAFFS</p>
            </router-link>
          </li>
          
          <li class="nav-item" v-if="ServiceShow()">
            <router-link class="nav-link" to="/services">
                <i class="nav-icon orange fas fa-tasks"></i>
                <p>SERVICES</p>
            </router-link>
          </li>

          <li class="nav-item logout">
            <router-link class="nav-link" to="/logout">
                <i class="nav-icon red fas fa-power-off"></i>
                <p>LOG OUT</p>
            </router-link>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <div class="content pt-4">
      <div class="container-fluid">
        <router-view></router-view>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer bg-white">
   <div class="text-center "><strong>Copyright &copy;Microstack Technology Co.ltd</strong></div>
     
  </footer>

        </div>
    </div>
</template>

<script>
    import Login from './Login.vue'
    import Dashboard from './Dashboard.vue'

    export default {
        components : {
            Login,
            Dashboard,
        },
        data(){
            
            return {
                User : {
                  sale:'',
                  service: '',
                  develop:''
                },
                isLoggedIn : '',
                username : '',
            }
        },
        methods : {
           ServiceShow(){
           return this.User.sale || this.User.service ?true :false
           },
           StaffShow(){
            return this.User.develop ?true :false
           }
        },
        created() {

          
          this.username = User.getUser();
          this.isLoggedIn = User.isLoggedIn()


          if(this.isLoggedIn){
            axios.post('/api/auth/me')
              .then(response => {
            Gate.setUser(response.data.role_id);
            this.User.sale = Gate.isSaleperson()
            this.User.service=Gate.isServiceEngineer()
            this.User.develop=Gate.isDeveloper()
           })
         
           
          
        }

          Bus.$emit('getrole');
          Bus.$on('logout', function(){
                User.clear();
                this.isLoggedIn = false
                window.location.replace('/');
            })
        }
    }
</script>
<style scoped>
    @import url('https://fonts.googleapis.com/css?family=Roboto|Ubuntu');

    input{
        font-weight : 700 !important;
    }
  
    .nav-item .nav-link p{
        font-weight : 400;
        font-size : 12px;
        font-family: 'Roboto', sans-serif;
    }
    .info a{
        font-family : 'Ubuntu', sans-serif;
    }
    .logout{
        border-top : 1px solid rgba(200,200,200,0.3);
    }
</style>