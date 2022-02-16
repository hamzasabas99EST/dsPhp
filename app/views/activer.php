<!DOCTYPE html>
<html lang="en">
<head>
    <?php include APPROOT . "/views/Components/header.php"; ?>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./index2.html" class="h1"><b>App</b>chat</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      <form action="<?=URLROOT?>User/activerAccount" method="post">
        <div class="row">
          <div class="col-12">
             <input type="hidden" name="email" value="<?=$data["email"]?>">
            <button type="submit" class="btn btn-primary btn-block">Activer</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
  <?php include APPROOT . "/views/Components/scripts.php"; ?>

</body>
</html>
