<!DOCTYPE html>
<html lang="en">

<head>
      <?php include APPROOT . "/views/Components/header.php"; ?>

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="./" class="h1"><b>App</b>chat</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="<?=URLROOT?>User/login" method="POST">
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
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>



                <p class="mb-1">
                    <a href="./forgotPassword">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="./register" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

     <?php include APPROOT . "/views/Components/scripts.php"; ?>


        
<?php if(isset($_SESSION["message"])):?>

            <script src="<?=URLROOT?>/template/plugins/sweetalert2/sweetalert2.min.js"></script>
            <script type="text/javascript">
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title:'<?=$_SESSION["message"]?>' ,
                })

            </script>

<?php unset($_SESSION["message"]); endif;?>
<?php if(isset($_SESSION["message_err"])): ?>

    <script src="<?=URLROOT?>/template/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script type="text/javascript">
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'info',
                    title: ' <?=$_SESSION["message_err"]?>'
                })

        </script>
<?php  endif; unset($_SESSION["message_err"]);?>
    
</body>

</html>