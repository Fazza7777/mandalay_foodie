<?php
ob_start();
require_once "core/autoload.php";
if(isset($_SESSION["user_id"])){
  Helper::redirect("index.php");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $user = new User();
   $user = $user->login($_POST);
   if($user == "login_success"){
     Helper::redirect("index.php");
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo $url ?>vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $url ?>vendor/feather-icons-web/feather.css">
    <link rel="stylesheet" href="<?php echo $url ?>css/style.css">
</head>
<body>
   <section class="container-fluid login-head">
      <div class="container py-md-3 py-4">
          <div class="row">
              <div class="col-md-10 offset-md-1 col-12">
                  <img src="img/logo.jpg" alt="login-logo" class="login-logo">
                  <span class="login-text">Mandalay Foodie</span>
              </div>
          </div>
      </div>
   </section>
   <div class="container">
       <div class="row">
           <div class="col-md-8 offset-md-2 mt-5">
               <div class="card">
                   <div class="card-header">
                      <span class="text-muted font-weight-light">Login</span>
                   </div>
                   <div class="card-body px-5">
                   
                     <form class="px-3" method="POST">
                          <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label text-md-right text-left font-weight-light">E-Mail Address</label>
                            <div class="col-sm-9">
                              <input type="email" name="email" class="form-control w-75" id="email" >
                              <?php  if (isset($user) && is_array($user) && isset($user["email"])) {?>
                                 <small class="text-danger pt-2"> <?php Helper::checkValidateError($user,"email") ?></small> 
                              <?php } ?>
                              <?php  if (isset($user) && is_array($user) && isset($user["email-invalid"])) {?>
                                 <small class="text-danger pt-2"> <?php Helper::checkValidateError($user,"email-invalid") ?></small> 
                              <?php } ?>
                              <?php  if (isset($user) && is_array($user) && isset($user["noregister"])) {?>
                                 <small class="text-danger pt-2"> <?php Helper::checkValidateError($user,"noregister") ?></small> 
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label text-md-right text-left font-weight-light">Password</label>
                            <div class="col-sm-9">
                              <input type="password" name="password" class="form-control  w-75" id="password" >
                              <?php  if (isset($user) && is_array($user) && isset($user["password"])) {?>
                                 <small class="text-danger pt-2"> <?php Helper::checkValidateError($user,"password") ?></small> 
                              <?php } ?>
                              <?php  if (isset($user) && is_array($user) && isset($user["password-false"])) {?>
                                 <small class="text-danger pt-2"> <?php Helper::checkValidateError($user,"password-false") ?></small> 
                              <?php } ?>
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label font-weight-light" for="gridCheck1">
                                  Remember Me
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-3"></div>
                            <div class="col-sm-9">
                              <button type="submit" class="btn btn-warning">Login</button>
                            </div>
                          </div>
                     </form>
                 
                   </div>
               </div>
           </div>
       </div>
   </div>
    <script src="<?php echo $url ?>vendor/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $url ?>vendor/bootstrap/js/poper.js"></script>
    <script src="<?php echo $url ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $url ?>js/app.js"></script>
</body>

</html>