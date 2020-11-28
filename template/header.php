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
                            <a class="dropdown-item text-white" type="button">Change Password</a>
                        </div>
                    </div>

                  </div>

              </div>
            <!-- navbar end -->
          </div>
      </div>
        <!-- header end -->
