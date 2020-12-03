
<?php 
ob_start();
require_once "template/header.php";

 if(!isset($_SESSION["user_id"])){
     Helper::redirect("login.php");
 }
 if(isset($_GET["id"]) ){
    $res = Restaurant::singleRestaurant($_GET["id"]);
    // print_r($res);
}
?>
<!-- content area start -->
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <p class="text-center">
                <img src="<?php echo $url ?>/img/logo.jpg" alt="logo" class="detail-logo">
            </p>
        </div>
    </div>
    <div class="row detail">
        <div class="col-12 my-5">
            <div class="heade_detail d-flex justify-content-between ">
                <p>Restaurant Details</p>
                <p class="mr-2 current-time"> <?php echo Helper::shopTime($res->from_hour,$res->to_hour) == "open" ? "<span class='alert alert-success py-2'><i class='feather-clock'></i> - Open</span>" : "<span class='alert alert-warning py-2'><i class='feather-clock'></i> - Close</span>" ?></p>
            </div>
        </div>
         <!-- name logo -->
        <div class="col-12 col-md-4 mt-md-0 mt-3">
            <div class="shop-logo ">
                <img src="upload/<?php echo $res->restaurant_image ?>" alt="shop-logo" class="img-thumbnail rounded shop_logo">
            </div>
        </div>
        <div class="col-12 col-md-4 mt-md-2 mt-3">
            <h5 class="font-weight-normal alert alert-primary">Restaurant Name (Myanmar)</h5>
            <p class=" name"> <?php echo $res->name_myanmar ?></p>
        </div>
        <div class="col-12 col-md-4 mt-md-2 mt-3">
            <h5 class="font-weight-normal alert alert-primary">Restaurant Name (English)</h5>
            <p class=" name"> <?php echo $res->name_english ?></p>
        </div>
         <!-- /type food -->
         <div class="col-12 col-md-4 mt-3">
            <h5 class="font-weight-normal alert alert-info">Cuisine Type</h5>
            <p class=" name"> <?php echo $res->cuisine_type ?></p>
         </div>
         <div class="col-12 col-md-4 mt-3">
             <h5 class="font-weight-normal alert alert-info">Meal Type</h5>
             <p class=" name"> <?php echo $res->meal_type ?></p>
         </div>
         <div class="col-12 col-md-4 mt-3">
             <h5 class="font-weight-normal alert alert-info">Eatery Type</h5> 
             <p class=" name"> <?php echo $res->eatery_type ?></p>
         </div>
          <!-- Features -->
          <div class="col-12 col-md-4 mt-3">
             <h5 class="font-weight-normal alert alert-success">Features</h5> 
             <p class="name-big"> 
               <div class="row features">
                   <div class="col-md-4 col-6 pl-md-0 pl-3">
                     <?php echo $res->halal == 1 ? "<i class='feather-info mr-2'></i><span>Halal</span>":'' ?>
                   </div>
                   <div class="col-md-4 col-6 pl-md-0 pl-3">
                      <?php echo $res->vegetrian == 1 ? "<i class='feather-info mr-2'></i><span >Vegetrian</span>":'' ?>
                   </div>
                   <div class="col-md-4 col-6 pl-md-0 pl-3">
                       <?php echo $res->air_conditioned == 1 ? "<i class='feather-airplay mr-2'></i><span>Air Conditioned </span>":'' ?>
                   </div>
                   <div class="col-md-4 col-6 pl-md-0 pl-3">
                      <?php echo $res->wifi == 1 ? "<i class='feather-wifi mr-2'></i><span>Wifi</span>":'' ?>
                   </div>
                   <div class="col-md-4 col-6 pl-md-0 pl-3">
                      <?php echo $res->parking == 1 ? "<i class='feather-square mr-2'></i><span>Parking</span>":'' ?>
                   </div>
                   <div class="col-md-4 col-6 pl-md-0 pl-3">
                      <?php echo $res->credit_card == 1 ? "<i class='feather-credit-card mr-2'></i><span>Credit Card</span>":'' ?>
                   </div>
                   <div class="col-md-4 col-6 pl-md-0 pl-3">
                      <?php echo $res->foreign_currency == 1 ? "<i class='feather-dollar-sign '></i><span>Forein Currency</span>":'' ?>
                   </div>
                   <div class="col-md-4 col-6 pl-md-0 pl-3">
                     <?php echo $res->delivery == 1 ? "<i class='feather-truck mr-2'></i><span>Delivery</span>":'' ?>
                   </div>
                   <div class="col-md-4 col-6 pl-md-0 pl-3">
                     <?php echo $res->buffet == 1 ? "<i class='feather-info mr-2'></i><span>Buffet</span>":'' ?>
                   </div>
               </div>
            </p>
          </div>
         <!-- close day -->
         <div class="col-12 col-md-4 mt-3">
             <h5 class="font-weight-normal alert alert-warning">Close Day</h5> 
             <p class="name-big"> 
               <div class="row features">
                   <div class="col-4 sevenDay">
                     <?php echo $res->monday == 1 ? "<i class='feather-calendar mr-2'></i><span>Monday</span>":'' ?>
                   </div>
                   <div class="col-4 sevenDay">
                      <?php echo $res->tuesday == 1 ? "<i class='feather-calendar mr-2'></i><span>Tuesday</span>":'' ?>
                   </div>
                   <div class="col-4 sevenDay">
                       <?php echo $res->wednesday == 1 ? "<i class='feather-calendar mr-2'></i><span>Wednesday</span>":'' ?>
                   </div>
                   <div class="col-4 sevenDay">
                      <?php echo $res->thursday == 1 ? "<i class='feather-calendar mr-2'></i><span>Thursday</span>":'' ?>
                   </div>
                   <div class="col-4 sevenDay">
                      <?php echo $res->friday == 1 ? "<i class='feather-calendar mr-2'></i><span>Friday</span>":'' ?>
                   </div>
                   <div class="col-4 sevenDay">
                      <?php echo $res->saturday == 1 ? "<i class='feather-calendar mr-2'></i><span>Saturday</span>":'' ?>
                   </div>
                   <div class="col-4 sevenDay">
                      <?php echo $res->sunday == 1 ? "<i class='feather-calendar '></i><span>Sunday</span>":'' ?>
                   </div>

               </div>
            </p>
        </div>
        <!-- Open hour close hour -->
        <div class="col-12 col-md-4 mt-md-2 mt-3">
            <h5 class="font-weight-normal alert alert-warning">Open - Close Time</h5>
            <p class="name"> 
                <span class="mb-0">From : <?php echo date("g A",strtotime($res->from_hour)) ?> - To : <?php echo date("g A",strtotime($res->to_hour)) ?></span>

            </p>
        </div>
        <!-- Menu Signature Food -->

        <div class="col-12 col-md-4 mt-md-2 mt-3">
            <h5 class="font-weight-normal alert alert-info">Signature Food</h5>
            <p class=" name"> <?php echo $res->signature_food ?></p>
        </div>
        <div class="col-12 col-md-4 mt-md-2 mt-3">
           <h5 class="font-weight-normal alert alert-info">Menu</h5>
            <?php if( $res->menu == 'default_menu.png'){ ?>
                <p class="text-warning text-center name"><i class="feather-image"></i> Not have menu image</p>
            <?php }else{?>
                <p class="text-center name"> <a href="upload/<?php echo $res->menu ?>" target="_blank" class="text-warning text-decoration-none "><i class="feather-eye"></i> View Menu</a></p>
            <?php } ?>
        </div>
        <!-- Address menu -->
        <div class="col-12 mt-4 mb-5">
            <div class="heade_detail w-50">
                <p><i class="feather-phone-call"></i> Address & Contact</p>
               
            </div>
        </div>
        <div class="col-12 col-md-4 mt-md-2 mt-3">
            <h5 class="font-weight-normal alert alert-primary">Phone</h5>
            <p class=" name"> <?php echo $res->phone_one ?> <?php echo $res->phone_two != null ? '<span> , '.$res->phone_two.' </span>' : '' ?></p>
        </div>
        <div class="col-12 col-md-4 mt-md-2 mt-3">
            <h5 class="font-weight-normal alert alert-primary">Address (Myanmar)</h5>
            <p class=" name"> <?php echo $res->address_myanmar ?></p>
        </div>
        <div class="col-12 col-md-4 mt-md-2 mt-3">
            <h5 class="font-weight-normal alert alert-primary">Address (English)</h5>
            <p class=" name"> <?php echo $res->address_english ?></p>
        </div>
        <div class="col-12 col-md-4 mt-md-2 mt-3">
            <h5 class="font-weight-normal alert alert-primary">Facebook ID</h5>
            <p class="text-center name"><a class="text-decoration-none" href="<?php echo $res->facebook_id ?>" target="_blank"><i class="feather-facebook"></i> Facebook</a></p>
        </div>
        <div class="col-12 col-md-4 mt-md-2 mt-3">
            <h5 class="font-weight-normal alert alert-primary">Website Url</h5>
            <p class="text-center name"><i class="feather-link-2 text-primary"></i> <a class="text-decoration-none" href="<?php echo $res->website_url ?>" target="_blank"> Website</a></p>
        </div>
        <div class="col-12 col-md-4 mt-md-2 mt-3">
            <h5 class="font-weight-normal alert alert-primary">Location</h5>
            <p class="">
               <p class="mb-0 location"> Latitude : <?php echo $res->latitude ?></p>
               <p class="mb-0 location"> Longitude : <?php echo $res->longitude ?></p>
            </p>
        </div>
        <div class="col-12 mt-3">
            <hr>
            <a href="<?php echo $url ?>/index.php" class="btn btn-warning"><i class="feather-home"></i> Back</a>
        </div>
    </div>
</div>
<!-- content area end -->

<?php require_once "template/footer.php" ?>
<script src="<?php echo $url ?>vendor/data_table/jquery.dataTables.min.js"></script>
<script src="<?php echo $url ?>vendor/data_table/dataTables.bootstrap4.min.js"></script>
<script>
     $(document).ready(function() {
     $('#address').DataTable();
     } );



</script>