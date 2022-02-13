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
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="." class="h1"><b>App</b>chat</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

        <form action="<?=URLROOT?>User/updateMDP" method="POST">
          <div class="input-group mb-3">
            <input type="hidden" name="email" value="<?= $data["email"] ?>">
            <input type="password" class="form-control" placeholder="Password" id="pwd" name="pwd">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Confirm Password" id="pwd1" onkeyup="identicPwd()">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <span class="badge bg-danger" style="display:none" id="span">Le mot de passe ne correspondent pas</span>
          
          <div class="row">
            <div class="col-12">
              <input type="submit" id='update' class="btn btn-primary btn-block" value="Change sas">
             
            </div>
            <!-- /.col-->
          </div>
        
        </form>

        <p class="mt-3 mb-1">
          <a href="login.html">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= URLROOT ?>/template/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= URLROOT ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= URLROOT ?>/template/dist/js/adminlte.min.js"></script>
  <script type="text/javascript">
    function identicPwd() {
      
      let newpd = document.getElementById("pwd").value;
      let newpd1 = document.getElementById("pwd1").value;
      let button = document.getElementById("update");
      console.log(button);
      let msg_confirmation = document.getElementById("span");

      if (newpd.length == newpd1.length && newpd === newpd1) {
        msg_confirmation.style.display = "none";
        button.style.pointerEvents = "auto";
        button.style.opacity = 1;

      } else {
        msg_confirmation.style.display = "block";
        button.style.pointerEvents = "none";
        button.style.opacity = 0.4;


      }
    }
  </script>
</body>

</html>