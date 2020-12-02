
<?php 
ob_start();
require_once "template/header.php";

 if(!isset($_SESSION["user_id"])){
     Helper::redirect("login.php");
 }
 if(isset($_GET["search"]) ){
    $search = new Restaurant();
    $search = $search->search($_GET);  
}else{
    $search = Restaurant::restaurants();
}
?>
    <!-- content area start -->
    <div class="row">
           <div class="col-12">
                <div class="card border-0 p-3 ">
                    <hr>
                    <p class='mb-0 manage-head'>Table View</p>
                    <hr>
                    <div class="filter mt-2">
                        <form action="index.php" method="GET">
                            <input type="hidden" name="search" value="search">
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
                                        <a href="index.php" class="text-decoration-none"><input type="button" value="Refresh" class="form-control bg-warning text-white filter-btn filter-btn"></a>
                                    </div> 
                                </div>
                            </div>
                        </form>
                    </div>
               </div>
               <hr class="m-0">
           </div>
        <div class="col-12 mt-4">
            <div class="card  p-3 border-0 text-center shadow m-auto">
                <hr>
                <table id="address" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>                        
                            <th>Name</th> 
                            <th>Cuisine Type</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Start date</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($search['data'] as $r){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $r->name_myanmar ?></td>
                            <td><?php echo $r->cuisine_type ?></td>
                            <td><?php echo $r->phone_one ?></td>
                            <td><?php echo $r->address_myanmar ?></td>
                            <td><?php echo date("j-M-Y",strtotime($r->created_at)) ?></td>
                            <td><button class="btn btn-warning">Detail</button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                
                </table>
            </div>
        </div>
    </div>
    <!-- content area end -->
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