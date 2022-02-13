<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Site web</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= URLROOT ?>/template/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= URLROOT ?>/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= URLROOT ?>/template/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=URLROOT?>/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?=URLROOT?>/template/plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">
    <div class="register-box">
      <div class="card card-outline card-primary">

        <div class="card-header text-center">
          <a href="./index2.html" class="h1"><b>App</b>chat</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Register a new membership</p>

            <form action="./User/add" method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Full name" name="fullname" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="mdp" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Retype password" name="rmdp"  required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                 </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <a href="./" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
 
  <!-- jQuery -->
  <script src="<?= URLROOT ?>/template/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= URLROOT ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= URLROOT ?>/template/dist/js/adminlte.min.js"></script>
  <?php if(isset($_COOKIE["message_err"])): ?>
    <script src="<?=URLROOT?>/template/plugins/toastr/toastr.min.js"></script>

    <script src="<?=URLROOT?>/template/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script type="text/javascript">
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 10000
                });
                Toast.fire({
                    icon: 'info',
                    title: ' <?=$_COOKIE["message_err"]?>'
                })

        </script>
<?php endif;?>
<?php if(isset($_COOKIE["message"])): ?>
    <script src="<?=URLROOT?>/template/plugins/toastr/toastr.min.js"></script>

    <script src="<?=URLROOT?>/template/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script type="text/javascript">
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 10000
                });
                Toast.fire({
                    icon: 'success',
                    title: ' <?=$_COOKIE["message"]?>'
                })

        </script>
<?php endif;?>
<?php if(isset($_COOKIE["message_email"])): ?>
    <script src="<?=URLROOT?>/template/plugins/toastr/toastr.min.js"></script>

    <script src="<?=URLROOT?>/template/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script type="text/javascript">
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 10000
                });
                Toast.fire({
                    icon: 'info',
                    title: ' <?=$_COOKIE["message_email"]?>'
                })

        </script>
<?php endif;?>
</body>

</html>