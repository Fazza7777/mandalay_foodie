<?php 
ob_start();
require_once "template/header.php";
if(!isset($_SESSION["user_id"])){
    Helper::redirect("login.php");
}
if(isset($_GET["search"]) ){
    $search = new Restaurant();
    $search = $search->searchForManage($_GET);
    
}else{
    $search = Restaurant::restaurants();
}


?>       

        <!-- content area start -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 p-3 ">
                    <hr>
                    <p class='mb-0 manage-head'>Manage Restaurant</p>
                    <hr>
                    <div class="filter mt-2">
                        <form action="manage_restaurant.php" method="GET">
                            <input type="hidden" value="search" name="search">
                            <div class="row">
                                <div class="col-md-4 col-12 my-1">
                                    <!-- <input type="hidden" name="search" value="search"> -->
                                    <label for="inputState">Cuisine Type</label>
                                    <select name="cuisine_type" class="form-control">
                                        <option disabled selected>Choose...</option>
                                        <option value="bbq">BBQ & Hotpot</option>
                                        <option value="fast-foods">Fast Foods (Burger & Fres)</option>
                                        <option value="chinese">Chinese</option>
                                        <option value="french">French</option>
                                        <option value="dim-sum">Dim Sum</option>
                                        <option value="indian">Indian</option>
                                        <option value="indonesian">Indonesian</option>
                                        <option value="international">International</option>
                                        <option value="italian">Italian</option>
                                        <option value="japanese">Japanese</option>
                                        <option value="korean">Korean</option>
                                        <option value="local">Local Delights</option>
                                        <option value="malaysian">Malaysian</option>
                                        <option value="mexican">Mexican</option>
                                        <option value="pizza">Pizza</option>
                                        <option value="seafood">Seafood</option>
                                        <option value="spanish">Spanish</option>
                                        <option value="steak">Steak & Grill</option>
                                        <option value="taiwanese">Taiwanese</option>
                                        <option value="thai">Thai</option>
                                        <option value="vietnamese">Vietnamese</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="inputState">Meal Type</label>
                                    <select name="meal_type" class="form-control">
                                        <option disabled selected>Choose...</option>
                                            <option value="brunch">Brunch</option>
                                            <option value="dinner">Dinner</option>
                                            <option value="drinks">Drinks & Desserts</option>
                                            <option value="allday">All Day</option>
                                           
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="inputState">Eatery Type</label>
                                    <select name="eatery_type" class="form-control">
                                        <option selected disabled>Choose...</option>
                                        <option value="barpub">Bar & Pub</option>
                                        <option value="cofe">Cofe</option>
                                        <option value="cousaldining">Cousal Dining</option>
                                        <option value="food-court">Food Court</option>
                                        <option value="restaurant">Restaurant</option>
                                    </select>
                                </div>
                              
                            </div>
                            <div class="row">
                               <div class="col-md-4 col-12">
                                    <label for="inputState">Features</label>
                                    <select name="features" class="form-control">
                                        <option selected disabled>Choose...</option>
                                        <option value="halal" >Halal</option>
                                        <option value="vegetrian" >Vegetrian</option>
                                        <option value="air_conditioned" >Air-conditioned</option>
                                        <option value="wifi" >Wi-Fi</option>
                                        <option value="parking" >Parking</option>
                                        <option value="credit_card" >Accept Credit Card</option>
                                        <option value="foreign_currency" >Accept Foreign Currency</option>
                                        <option value="delivery" >Delivery</option>
                                        <option value="buffet" >Buffet</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="inputState">Address</label>
                                    <select name="address" class="form-control">
                                        <option selected disabled>Choose...</option>
                                        <?php foreach(Helper::address() as $addr){ ?>
                                        <option value="<?php echo $addr ?>" ><?php echo $addr ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <input type="submit" value="Filter" class="form-control bg-warning text-white filter-btn filter-btn">
                                    </div> 
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <a href="manage_restaurant.php" class="text-decoration-none"><input type="button" value="Refresh" class="form-control bg-warning text-white filter-btn filter-btn"></a>
                                    </div> 
                                </div>
                            </div>
                        </form>
                        </div>
                </div>
                <hr class="m-0">
            </div>
            <div class="col-12 mt-5">
                <div class="row">
                    <div class="col-12">
                       <p class="ml-2">
                         <a class="pag" href="<?php echo $search['prev_page'] ?>" ><i class=" feather-arrow-left"></i> Prev</a>
                         <a class="pag"  href="<?php echo $search['next_page'] ?>">Next <i class=" feather-arrow-right"></i></a>     
                       </p>
                    </div>
                    <!-- // Search Data -->
                    <?php
                       foreach ($search['data'] as $r) {
                    ?>    
                    <div class="col-lg-4 col-md-6 col-12  rounded mb-3 p-3 res-card">
                        <div class="px-3 py-2 shadow-sm border-0 rounded card">
                            <div class="card-body shop-header">
                                <span>
                                    <img src="upload/<?php echo $r->restaurant_image ?>" alt="" class="manage_img">
                                </span>
                                <span class="edit-shop-text"><?php echo $r->name_myanmar ?></span>
                                <hr>
                            </div>
                            <p>
                                    <i class="feather-phone mr-2"></i> <span class="font-weight-bold"><?php echo $r->phone_one ?></span>
                            </p>
                            <hr class="m-2">
                            <p>
                                <i class="feather-map-pin mr-2"></i> <span class="font-weight-bold"><?php echo $r->address_myanmar ?></span>
                            </p>
                            <hr class="m-2">
                            <?php       
                              if (Helper::shopTime($r->from_hour,$r->to_hour) == "open") { 
                            ?>
                                 <p class="font-weight-bold mt-3"><i class="feather-clock mr-2"></i>Now : <span class="alert py-2 ml-2 alert-success">Open</span></p>
                            <?php } else { ?> 
                                <p class="font-weight-bold mt-3"><i class="feather-clock mr-2"></i>Now : <span class="alert py-2 ml-2 alert-danger">Close</span></p>
                            <?php } ?>
                          <hr>
                            <p class="py-2">
                                <a href="restaurant_edit.php?id=<?php echo $r->id ?>" class="btn btn-warning btn-sm mr-2"><i class="feather-edit"></i> Edit</a>
                                <button id="res_delete" name="<?php echo $r->name_myanmar ?>" res_id="<?php echo $r->id ?>" class="btn btn-warning btn-sm mr-2"><i class="feather-trash-2"> </i>Delete</button>
                            </p>
                        </div>
                    </div>
                    <?php
                        }
                      
                     ?>
    
                   
                </div>
                
            </div>
        <!-- content area end -->
    </div>
    <!-- content end -->

<?php require_once "template/footer.php" ?>
<script>
  var restaurants = document.querySelectorAll("#res_delete")
  restaurants.forEach(r=>{
     
      r.addEventListener("click",function(){
        var resId = r.getAttribute("res_id")
        var name = r.getAttribute("name")

        swal({
              title: `Are you sure Delete? `,
              text:`Restaurant - ${name}`,
              icon: "warning",
              buttons: true,
              dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {      
                axios.get(`api.php?res_del&id=${resId}`)
                .then(response=>{
                toastr.success(`${name} : Delete success!`)
                setTimeout(go,500)   
                    function go(){
                      location.href ="manage_restaurant.php"
                    }    
              
                }) 
            
            }  
     
        })
     
  })
}) 
</script>
