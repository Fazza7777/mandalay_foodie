<?php 
ob_start();
require_once "template/header.php";

  if(!isset($_SESSION["user_id"])){
      Helper::redirect("login.php");
  }
  if(isset($_GET["id"])){
    $data = DB::table("restaurants")->where("id",$_GET['id'])->first();
    // echo $data->name_myanmar;
  }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $res = new Restaurant();
    $res = $res->create($_POST);

  //  echo date("g:iA", strtotime($_POST["from"]));
  // echo "<pre>";
  // print_r($res);
    //print_r($_POST);

  }

?>

<!--      Insert Form  start*/ -->

<div class="container my-5">
   <div class="card shadow">
       <div class="card-header text-center ">
           <h3 class="insert_head font-weight-light">Restaurant Registration Form</h3>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <form method="POST" enctype="multipart/form-data">
                       <div class="form-row">
                           <!-- Name start -->
                           <div class="col-12 mb-2 col-lg-6">
                               <div class="form-group">
                                   <label for="m-name">Restaurant Name (Myanmar)</label>
                                   <input type="text" class="form-control <?php echo isset($res["m-shop"]) ? 'border-danger' : ''?>" id="m-name" value="<?php echo  $data->name_myanmar ?>"
                                    name="myanmar_name">
                                    <?php if(isset($res["m-shop"])){ ?>
                                       <small class="text-danger"><?php echo $res["m-shop"] ?></small>
                                    <?php } ?>
                               </div>
                           </div>
                           <div class="col-12 mb-2 col-lg-6">
                              <div class="form-group">
                                   <label for="m-name">Restaurant Name (English)</label>
                                   <input type="text" class="form-control <?php echo isset($res["m-shop"]) ? 'border-danger' : ''?>" id="m-name" 
                                   value="<?php echo  $data->name_english ?>" name="english_name">
                                   <?php if(isset($res["e-shop"])){ ?>
                                       <small class="text-danger"><?php echo $res["e-shop"] ?></small>
                                    <?php } ?>
                               </div>
                           </div>
                            <!-- Name end -->
                           <div class="col-12 mb-2 col-lg-6">
                              <div class="form-group ">
                                <label for="image">Choose Image</label>
                                <input type="file" name="shop" class="form-control-file" id="image">
                                <?php if(isset($res["shop-img"])){ ?>
                                       <small class="text-danger"><?php echo $res["shop-img"] ?></small>
                                <?php } ?>
                             </div>
                           </div>
                            <!-- Cuisine Type Start -->
                           <div class="col-12 mb-2 col-lg-6">
                              <div class="form-group">
                                <label for="c-type">Cuisine type</label>
                                <select name="cuisine_type" class="custom-select <?php echo isset($res["cuisine_type"]) ? 'border-danger' : ''?>" >
                          
                                    <option value="bbq" <?php echo Helper::selectValue($data->cuisine_type,"bbq") ?>>BBQ & Hotpot</option>
                                    <option value="fast-foods" <?php echo Helper::selectValue($data->cuisine_type,"fast-foods") ?>>Fast Foods (Burger & Fres)</option>
                                    <option value="chinese" <?php echo Helper::selectValue($data->cuisine_type,"chinese") ?>>Chinese</option>
                                    <option value="french" <?php echo Helper::selectValue($data->cuisine_type,"french") ?>>French</option>
                                    <option value="dim-sum" <?php echo Helper::selectValue($data->cuisine_type,"dim-sum") ?>>Dim Sum</option>
                                    <option value="indian" <?php echo Helper::selectValue($data->cuisine_type,"indian") ?>>Indian</option>
                                    <option value="indonesian" <?php echo Helper::selectValue($data->cuisine_type,"indonesian") ?>>Indonesian</option>
                                    <option value="international" <?php echo Helper::selectValue($data->cuisine_type,"international") ?>>International</option>
                                    <option value="italian" <?php echo Helper::selectValue($data->cuisine_type,"italian") ?>>Italian</option>
                                    <option value="japanese" <?php echo Helper::selectValue($data->cuisine_type,"japanese") ?>>Japanese</option>
                                    <option value="korean" <?php echo Helper::selectValue($data->cuisine_type,"korean") ?>>Korean</option>
                                    <option value="local" <?php echo Helper::selectValue($data->cuisine_type,"local") ?>>Local Delights</option>
                                    <option value="malaysian" <?php echo Helper::selectValue($data->cuisine_type,"malaysian") ?>>Malaysian</option>
                                    <option value="mexican" <?php echo Helper::selectValue($data->cuisine_type,"mexican") ?>>Mexican</option>
                                    <option value="pizza" <?php echo Helper::selectValue($data->cuisine_type,"pizza") ?>>Pizza</option>
                                    <option value="seafood" <?php echo Helper::selectValue($data->cuisine_type,"seafood") ?>>Seafood</option>
                                    <option value="spanish" <?php echo Helper::selectValue($data->cuisine_type,"spanish") ?>>Spanish</option>
                                    <option value="steak" <?php echo Helper::selectValue($data->cuisine_type,"steak") ?>>Steak & Grill</option>
                                    <option value="taiwanese" <?php echo Helper::selectValue($data->cuisine_type,"taiwanese") ?>>Taiwanese</option>
                                    <option value="thai" <?php echo Helper::selectValue($data->cuisine_type,"thai") ?>>Thai</option>
                                    <option value="vietnamese" <?php echo Helper::selectValue($data->cuisine_type,"vietnamese") ?>>Vietnamese</option>
                                </select>
                                <?php if(isset($res["c_type"])){ ?>
                                       <small class="text-danger"><?php echo $res["c_type"] ?></small>
                                <?php } ?>
                             </div>
                           </div>
                            <!-- Cuisine Type end -->
                            <!-- Meal Type Start -->
                             <div class="col-12 mb-2">
                                <label for="">Meal Type</label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio mr-lg-5 mx-0 custom-control-inline">
                                        <input type="radio" id="radio1" <?php echo Helper::checkValue($data->meal_type,"brunch") ?> name="meal_type" value="brunch" class="custom-control-input">
                                        <label class="custom-control-label" for="radio1">Brunch</label>
                                    </div>
                                    <div class="custom-control custom-radio mx-lg-5 mx-0 custom-control-inline">
                                       <input type="radio" id="radio2" <?php echo Helper::checkValue($data->meal_type,"dinner") ?> name="meal_type" value="dinner" class="custom-control-input">
                                       <label class="custom-control-label" for="radio2">Dinner</label>
                                    </div>
                                    <div class="custom-control custom-radio mx-lg-5 mx-0 custom-control-inline">
                                       <input type="radio" id="radio3" name="meal_type" <?php echo Helper::checkValue($data->meal_type,"drinks") ?> value="drinks" class="custom-control-input">
                                       <label class="custom-control-label" for="radio3">Drinks & Desserts</label>
                                    </div>
                                    <div class="custom-control custom-radio mx-lg-5 mx-0 custom-control-inline">
                                       <input type="radio" id="radio4" name="meal_type" <?php echo Helper::checkValue($data->meal_type,"allday") ?> value="allday" class="custom-control-input">
                                       <label class="custom-control-label" for="radio4">All Day</label>
                                    </div>
                                </div>
                                <?php if(isset($res["m_type"])){ ?>
                                       <small class="text-danger"><?php echo $res["m_type"] ?></small>
                                <?php } ?>
                             </div>
                            <!-- Meal Type End -->
                            <!-- Eatery Type start -->
                             <div class="col-12 mb-2">
                                <label for="">Eatery Type</label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio mr-lg-5 mx-0 custom-control-inline">
                                        <input type="radio" id="e-radio1" <?php echo Helper::checkValue($data->eatery_type,"barpub") ?> name="eatery_type" value="barpub" class="custom-control-input">
                                        <label class="custom-control-label" for="e-radio1">Bar & Pub</label>
                                    </div>
                                    <div class="custom-control custom-radio mx-lg-5 mx-0 custom-control-inline">
                                       <input type="radio" id="e-radio2" <?php echo Helper::checkValue($data->eatery_type,"cofe") ?> name="eatery_type" value="cofe" class="custom-control-input">
                                       <label class="custom-control-label" for="e-radio2">Cofe</label>
                                    </div>
                                    <div class="custom-control custom-radio mx-lg-5 mx-0 custom-control-inline">
                                       <input type="radio" id="e-radio3" <?php echo Helper::checkValue($data->eatery_type,"cousaldining") ?> name="eatery_type" value="cousaldining" class="custom-control-input">
                                       <label class="custom-control-label" for="e-radio3">Cousal Dining</label>
                                    </div>
                                    <div class="custom-control custom-radio mx-lg-5 mx-0 custom-control-inline">
                                       <input type="radio" id="e-radio4" <?php echo Helper::checkValue($data->eatery_type,"food-court") ?> name="eatery_type" value="food-court" class="custom-control-input">
                                       <label class="custom-control-label" for="e-radio4">Food Court</label>
                                    </div>
                                    <div class="custom-control custom-radio mx-lg-5 mx-0 custom-control-inline">
                                       <input type="radio" id="e-radio5" <?php echo Helper::checkValue($data->eatery_type,"restaurant") ?> name="eatery_type" value="restaurant" class="custom-control-input">
                                       <label class="custom-control-label" for="e-radio5">Restaurant</label>
                                    </div>
                                </div>
                                <?php if(isset($res["e_type"])){ ?>
                                       <small class="text-danger"><?php echo $res["e_type"] ?></small>
                                <?php } ?>
                             </div>
                            <!-- Eatery Type End -->
                            <!-- Features start -->
                             <div class="col-12 mb-2">
                               <label for="features">Features</label>
                                <div class="form-group">
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input"  <?php echo Helper::checkValue($data->halal,"1") ?> type="checkbox" name="Halal" value="1" id="c1" name="halal">
                                      <label class="custom-control-label" for="c1">Halal</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input"  <?php echo Helper::checkValue($data->vegetrian,"1") ?> type="checkbox" name="Vegetrian" value="1" id="c2" name="vegetrian">
                                      <label class="custom-control-label" for="c2">Vegetrian</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input"  <?php echo Helper::checkValue($data->air_conditioned,"1") ?> type="checkbox" name="air" value="1" id="c3" name="Air-conditioned">
                                      <label class="custom-control-label" for="c3">Air-conditioned</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input"  <?php echo Helper::checkValue($data->wifi,"1") ?> type="checkbox" name="wifi" value="1" id="c4" >
                                      <label class="custom-control-label" for="c4">Wi-Fi</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input"  <?php echo Helper::checkValue($data->parking,"1") ?> type="checkbox" name="parking" value="1" id="c5" >
                                      <label class="custom-control-label" for="c5">Parking</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input"  <?php echo Helper::checkValue($data->credit_card,"1") ?> type="checkbox" name="credit_card" value="1" id="c6" >
                                      <label class="custom-control-label" for="c6">Accept Credit Card</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input"  <?php echo Helper::checkValue($data->foreign_currency,"1") ?> type="checkbox" name="foreign" value="1" id="c7" >
                                      <label class="custom-control-label" for="c7">Accept Foreign Currency</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input"  <?php echo Helper::checkValue($data->delivery,"1") ?> type="checkbox" name="delivery" value="1" id="c8" >
                                      <label class="custom-control-label" for="c8">Delivery</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input"  <?php echo Helper::checkValue($data->buffet,"1") ?> type="checkbox" name="buffet" value="1"  id="c9" >
                                      <label class="custom-control-label" for="c9">Buffet</label>
                                    </div>
                                </div>

                             </div>
                             <!-- Features  End -->
                             <!-- Address  start -->
                             <div class="col-12 col-lg-6">
                                 <div class="form-group">
                                   <label for="m-address">Address (Myanmar)</label>
                                   <textarea name="m_address"   id="m-address" cols="20" rows="5" class="form-control <?php echo isset($res["m_add"]) ? 'border-danger' : ''?>"><?php echo  $data->address_myanmar ?></textarea>
                                     <?php if(isset($res["m_add"])){ ?>
                                       <small class="text-danger"><?php echo $res["m_add"] ?></small>
                                      <?php } ?>
                                 </div>

                             </div>
                             <div class="col-12 col-lg-6">
                                 <div class="form-group">
                                   <label for="e-address">Address (English)</label>
                                   <textarea name="e_address" id="" cols="20" rows="5" class="form-control <?php echo isset($res["e_add"]) ? 'border-danger' : ''?>"><?php echo  $data->address_english ?></textarea>
                                     <?php if(isset($res["e_add"])){ ?>
                                       <small class="text-danger"><?php echo $res["e_add"] ?></small>
                                      <?php } ?>
                                 </div>

                             </div>
                            <!-- Address  End -->
                             <!-- Menu  start -->
                            <div class="col-12 mb-2 col-lg-6">
                              <div class="form-group ">
                                <label for="image"> Menu</label>
                                <input type="file" name="menu" class="form-control-file" id="image">
                             </div>
                            </div>
                             <!-- Menu  End -->
                            <!-- Contact Start -->
                             <div class="col-12 mb-2 col-lg-6">
                                <div class="form-row">
                                
                                      <div class="col-12 col-md-6 mb-2">
                                          <label for="">Phone Number 1</label>
                                          <input type="number" name="phone_one"  value="<?php echo  $data->phone_one ?>" class="form-control <?php echo isset($res["phone"]) ? 'border-danger' : ''?>" >
                                          <?php if(isset($res["phone"])){ ?>
                                             <small class="text-danger"><?php echo $res["phone"] ?></small>
                                          <?php } ?>
                                      </div>
                                      <div class="col-12 col-md-6 mb-2">
                                          <label for="">Phone Number 2</label>
                                          <input type="number" name="phone_two" value="<?php echo  $data->phone_two ?>" class="form-control" >
                                      </div>
                                
                                </div>
                             </div>
                            <!-- Contact End -->
                            <!-- Open Hour Start -->
                             <div class="col-12 mb-3">
                              <div class="form-row">
                               
                                  <div class="col-12 col-md-6 mb-2">
         
                                    <label for="">Opening Hour From</label>
                                    <input type="time" value="<?php echo  $data->from_hour ?>" name="from" class="form-control <?php echo isset($res["fromH"]) ? 'border-danger' : ''?>" >
                                    <?php if(isset($res["fromH"])){ ?>
                                       <small class="text-danger"><?php echo $res["fromH"] ?></small>
                                    <?php } ?>
     
                                  </div>
                                  <div class="col-12 col-md-6 mb-2">
           
                                    <label for="">Opening Hour To</label>
        
                                    <input type="time" name="to" value="<?php echo  $data->to_hour ?>" class="form-control <?php echo isset($res["toH"]) ? 'border-danger' : ''?>">
                                    <?php if(isset($res["toH"])){ ?>
                                       <small class="text-danger"><?php echo $res["toH"] ?></small>
                                    <?php } ?>
       
                                  </div>
                                 
                              </div>
                             </div>
                             <!-- Open Hour End-->
                             <!-- Close Day start-->
                             <div class="col-12 mb-2">
                                <label for="features">Close Day</label>
                                <div class="form-group">
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input" <?php echo Helper::checkValue($data->monday,"1") ?> type="checkbox" name="monday" id="monday" value="1">
                                      <label class="custom-control-label" for="monday">Monday</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input" <?php echo Helper::checkValue($data->tuesday,"1") ?> type="checkbox" name="tuesday" id="tuesday" value="1">
                                      <label class="custom-control-label" for="tuesday">Tuesday</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input" <?php echo Helper::checkValue($data->wednesday,"1") ?> type="checkbox" name="wednesday" id="wednesday" value="1">
                                      <label class="custom-control-label" for="wednesday">Wednesday</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input" <?php echo Helper::checkValue($data->thursday,"1") ?> type="checkbox" name="thursday" id="thursday" value="1">
                                      <label class="custom-control-label" for="thursday">Thursday</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input" <?php echo Helper::checkValue($data->friday,"1") ?> type="checkbox" name="friday" id="Friday" value="1">
                                      <label class="custom-control-label" for="Friday">Friday</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input" <?php echo Helper::checkValue($data->saturday,"1") ?> type="checkbox" name="saturday" id="Saturday" value="1">
                                      <label class="custom-control-label" for="Saturday">Saturday</label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input class="custom-control-input" <?php echo Helper::checkValue($data->sunday,"1") ?> type="checkbox" name="sunday" id="Sunday" value="1">
                                      <label class="custom-control-label" for="Sunday">Sunday</label>
                                    </div>

                                </div>
                             </div>
                             <!--Cloase Day End-->
                             <!-- Id start-->
                             <div class="col-12 mb-3">
                              <div class="form-row">
                               
                                  <div class="col-6">
         
                                    <label for="">Facebook ID</label>
    
                                    <input type="text" value="<?php echo  $data->facebook_id ?>" name="facebook-id" class="form-control" >
     
                                  </div>
                                  <div class="col-6">
           
                                    <label for="">Website URL</label>
        
                                    <input type="text" name="website-url" value="<?php echo  $data->facebook_id ?>" class="form-control">
       
                                  </div>
                                 
                              </div>
                             </div>
                             <!-- Id start-->
                             <!-- signature start -->
                             <div class="col-12 col-lg-6 mb-3">
                                 <div class="form-group">
                                     <label for="signature">Signature Foods</label>
                                     <textarea name="signature" id="signature" class="form-control w-75" cols="30" rows="4"><?php echo  $data->signature_food ?></textarea>
                                 </div>
                             </div>
                             <!-- Location start -->
                             <div class="col-12 col-lg-6 mb-3">
                                 <label for="">Location</label>
                                <div class="custom-control custom-radio l-common mt-2 current" >
                                    <input type="radio" id="current" name="location"  class="custom-control-input">
                                    <label class="custom-control-label" for="current">My Current Location</label>
                                </div>
                                <div class="custom-control custom-radio l-common mt-3 manual">
                                    <input type="radio" id="manual" name="location"  class="custom-control-input">
                                    <label class="custom-control-label" for="manual">Manual</label>
                                </div>
                                <?php if(isset($res["location"])){ ?>
                                       <small class="text-danger"><?php echo $res["location"] ?></small>
                                <?php } ?>
                                <p id="demo" class="text-danger"></p>
                                <div class="row mt-4" id="location-text">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-12 col-md-4"><label for="">Latitude</label></div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" class="form-control" name="latitude" id="lati">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                                <div class="col-12 col-md-4"><label for="">Longitude</label></div>
                                                <div class="col-12 col-md-8">
                                                 <input type="text" class="form-control" name="longitude" id="longi">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             <!-- button -->
                             <div class="col-12 ">
                                 <button class="btn btn-warning">Insert Restaurant</button>
                             </div>
                         
                       </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>

<!--      Insert Form  end*/ -->
<?php require_once "template/footer.php"; ?>
<script src="<?php echo $url ?>/js/location.js"></script>
