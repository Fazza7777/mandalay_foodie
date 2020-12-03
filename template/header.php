<?php
require_once "core/autoload.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo $url ?>vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $url ?>vendor/feather-icons-web/feather.css">
    <link rel="stylesheet" href="<?php echo $url ?>vendor/data_table/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $url ?>vendor/data_table/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="<?php echo $url ?>css/style.css">
</head>
<body>
    <section class="main container-fluid">
       <div class="row">
           <!-- sidebar start -->
            <?php require_once "template/sidebar.php"; ?>
           <!-- sidebar end -->
               <!-- content start -->
    <div class="col-12 col-lg-9 col-xl-10 vh-100 content p-3">
        <!-- header start -->
      <div class="bg-warning rounded header">
        <div class="row ">
            <!-- navbar start -->
              <div class="col-12 ">
                  <div class="bg-warning p-2 p-lg-3 rounded  d-flex justify-content-between  align-item-center">     
                      
                    <button class="show-sidebar-btn btn btn-outline-warning btn-sm d-lg-none d-block">
                        <i class="feather-menu text-white"></i>
                    </button>
                    <p></p>   
                    <div class="btn-group mt-lg-0 mt-2  mr-2">
                        <div class="dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php
                      if(isset(User::auth()->name)){
                      
                        echo User::auth()->name;
                      }
                         
                       ?>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right bg-warning dropdown-area">
                            <a href="<?php echo $url ?>logout.php?id=<?php echo User::auth()->id?>" class="dropdown-item text-white" type="button">Logout</a>
                            <div class="dropdown-divider bg-white"></div>
                            <a id="pass_change" class="dropdown-item text-white" type="button">Change Password</a>
                        </div>
                    </div>

                  </div>

              </div>
            <!-- navbar end -->
          </div>
      </div>
        <!-- header end -->

<!-- Pass Change Model Modal start -->
<div class="modal fade" id="passchange" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mTitle">Change Password</h5>
        
      </div>
      <div class="modal-body">
     
         <form  id="my-form" oldPass="<?php echo User::auth()->password?>" curId="<?php echo User::auth()->id ?>" curName="<?php echo User::auth()->name ?>">
            <div class="form-group">
              <label for="oldPassword">Old Password</label>
              <input type="password" class="form-control" id="oldPassword">
              <small id="oPass" class="text-danger"></small>
            </div>
            <div class="form-group">
              <label for="newPassword">New Password</label>
              <input type="password" class="form-control" id="newPassword">
              <small class="text-danger " id="nPass"></small>
            </div>
            <div class="form-group">
              <label for="cnewPassword">Comfirm New Password</label>
              <input type="password" class="form-control" id="cnewPassword">
              <small class="text-danger " id="cnPass"></small>
            </div>
         </form>
      </div>
      <div class="modal-footer d-flex justify-content-end">
  
        <p>
           <button type="button" class="btn btn-outline-secondary mr-2" data-dismiss="modal">cancel</button>
            <button type="submit" form="my-form" class="btn btn-danger">Change</button>
        </p>
      </div>
    </div>
  </div>
</div>
<!-- Pass Change  Maodal end -->