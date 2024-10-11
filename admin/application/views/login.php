<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <!--<div class="col-xl-10 col-lg-12 col-md-9">-->
      <div class="col-xl-5 col-lg-6 col-md-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!--<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form name="loginForm" class="user" action="<?php echo base_url(); ?>login/validate_credentials" method="post" accept-charset="utf-8">

                  <div class="input-group row mb-2">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-fw fa-user"></i></span></div>
                    <input type="text" class="form-control form-control-md" width="10" name="username" placeholder="Username" required>
                  </div>
                  <div class="input-group row mb-4">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-fw fa-key"></i></span></div>
                    <input type="password" class="form-control form-control-md" name="password" placeholder="Password" required>
                  </div>

                  <?php
                    if(isset($message_error) && $message_error){
                        echo '<div class="alert alert-error">';
                          echo '<a class="close" data-dismiss="alert">×</a>';
                          echo '<strong>Login failed!</strong><br>Invalid user or password. Change a few things up and try submitting again.';
                        echo '</div>';             
                    }
                  ?>

                  <div class="input-group row">
                    <button type="submit" class="btn btn-primary btn-md btn-block"><i class="fas fa-fw fa-sign-in-alt"></i> Login</button>
                  </div>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</body>

</html>
