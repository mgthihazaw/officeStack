<!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="{{ asset('admin_assets/images/faces/face5.jpg') }}" alt="image"/>
              </div>
              <div class="profile-name">
                <p class="name">
                  Welcome Jane
                </p>
                <p class="designation">
                  Super Admin
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
             <router-link class="nav-link" to="/">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/staffs">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">Staffs</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/services">
              <i class="fa fa-tasks menu-icon"></i>
              <span class="menu-title">Service List</span>
            </router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
              <i class="fab fa-trello menu-icon"></i>
              <span class="menu-title">Page Layouts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="pages/layout/boxed-layout.html">Boxed</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/layout/rtl-layout.html">RTL</a></li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="pages/layout/horizontal-menu.html">Horizontal Menu</a></li>
              </ul>
            </div>
          </li>
          
        </ul>
      </nav>
      <!-- partial -->
