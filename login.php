<?php require_once('init/initialization.php'); 
require_once(PUBLIC_PATH . DS . "layouts" . DS . "login-header.php");
?>

    <div class="card-header text-center">
        <a href="" class="h1"><b>Java</b> House</a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <div class="social-auth-links text-center mt-2 mb-3">
            <a href="<?php echo base_url(); ?>index.php" class="btn btn-block btn-primary">
                <i class="fa fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="<?php echo base_url(); ?>index.php" class="btn btn-block btn-danger">
                <i class="fa fa-google-plus mr-2"></i> Sign in using Google
            </a>
        </div>
        <!-- /.social-auth-links -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <p class="mb-0">
            <a href="registration.php" class="text-center">Register a new membership</a>
        </p>
    </div>


<?php require_once(PUBLIC_PATH . DS . "layouts" . DS . "login-header.php"); ?>