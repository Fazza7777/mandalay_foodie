
<!-- side  bar start -->
<div class="col-12 col-lg-3 col-xl-2 vh-100 sidebar bg-warning mt-3 rounded shadow">
    <div class="d-flex justify-content-end mt-3">
        <div class="hide-sidebar-btn btn btn-outline-warning btn-sm d-lg-none d-block">
            <i class="feather-x text-white"></i>
        </div>
    </div>
    <div class="side-header text-center mt-lg-1">
        <p class='text-white'>Mandalay Foodie</p>
        <img src="<?php echo $url; ?>img/logo.jpg" alt="" class="logo rounded">
        <hr>
    </div>
    <div class="nav-menu mt-4">
        <ul>
            <li class="menu-title">
                <span>Report</span>
            </li>
            <li class="menu-item">
             
              
                <a href="<?php echo $url; ?>index.php" class="menu-item-link ">
                   <i class="feather-list mr-2"></i> Table View
                </a>
  
            
            <span ><i class="feather-chevron-right"></i></span>
            </li>
            <li class="menu-item">     
              
                <a href="" class="menu-item-link"><i class="feather-bar-chart-2 mr-3"></i>Chart View</a>
                 <span ><i class="feather-chevron-right text-white font-weight-bold"></i></span>
            </li>
            <li class="menu-spacer"></li>
            <li class="menu-title">
              <span>Restaurant</span>
            </li>
            <li class="menu-item">

                <a href="<?php echo $url; ?>insert_restaurant.php" class="menu-item-link">
                  <i class="feather-shopping-bag mr-3"></i> Insert restaurant
                </a>
            
                <span ><i class="feather-chevron-right"></i></span>
            </li>
            <li class="menu-item">
               
                <a href="<?php echo $url; ?>manage_restaurant.php" class="menu-item-link">
                <i class="feather-check-circle mr-3"></i>
                Manage restaurant
                </a>
               <span ><i class="feather-chevron-right text-white font-weight-bold"></i></span>
            </li>
            <li class="menu-spacer"></li>
            <li class="menu-title">
               <span>Admin</span>
            </li>
            <li class="menu-item">
                
                <a href="<?php echo $url; ?>registration.php" class="menu-item-link"><i class="feather-users mr-3"></i> User Registration</a>

                <span ><i class="feather-chevron-right text-white font-weight-bold"></i></span>
            </li>
            <li class="menu-item">
                
                <a href="<?php echo $url ?>logout.php?id=<?php echo User::auth()->id?>" class="menu-item-link"><i class="feather-log-out mr-3"></i> Logout</a>
                <span ><i class="feather-chevron-right text-white font-weight-bold"></i></span>
            </li>
            <li class="menu-spacer"></li>
        </ul>
    </div>
</div>