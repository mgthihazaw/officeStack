<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin_assets/vendors/iconfonts/font-awesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}">
  <!-- endinject -->
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <form id="login">
                <div class="form-group">
                  <select name="business_id" class="form-control" id="business_id">
                    @foreach($organizations as $business)
                      <option value="{{ $business->id }}">{{ $business->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <select name="department_id" class="form-control" id="department_id">
                    @foreach($departments as $department)
                      <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('admin_assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin_assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('admin_assets/js/misc.js') }}"></script>
  <script src="{{ asset('admin_assets/js/settings.js') }}"></script>
  <script src="{{ asset('admin_assets/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('admin_assets/js/dashboard.js') }}"></script>
  <!-- End custom js for this page-->
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
  <script>
    $(function(){
      

      $('#login').on('submit', function(event){
        event.preventDefault();
        let business_id = $('#business_id').val();
        let department_id = $('#department_id').val();
        let password = $('#password').val();

        $.ajax({
          url : "/api/login",
          data : {
            business_id : business_id,
            department_id : department_id,
            password : password
          },
          type : 'POST',
          success : (response) => {
            let access_token = response.access_token;
            localStorage.setItem('microstack_token',access_token);
            console.log(response);
            window.location.replace('/');
          },
          error : (error) => {
            console.log(error);
          }
        })
      })
    })
  </script>
</body>