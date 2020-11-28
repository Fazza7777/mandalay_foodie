<?php
class Restaurant{
    public function create($request){
        $validation = [];
       if(empty($request["myanmar_name"])){
          $validation["m-shop"] = "Restaurant Name (Myanmar) must be require!";
       }
       if(empty($request["english_name"])){
        $validation["e-shop"] = "Restaurant Name (English) must be require!";
        }
        if(empty($_FILES["shop"]["tmp_name"])){
            $validation["shop-img"] = "Restaurant image must be require!";
        }
        if(empty($request["meal_type"])){
            $validation["m_type"] = "Need to choose at least one!";
        }
        if(empty($request["cuisine_type"])){
            $validation["c_type"] = "Need to select at least one!";
        }
        if(empty($request["eatery_type"])){
            $validation["e_type"] = "Need to choose at least one!";
        }
        if(empty($request["m_address"])){
            $validation["m_add"] = "Address (Myanmar) must be require!";
        }
        if(empty($request["e_address"])){
            $validation["e_add"] = "Address (English) must be require!";
        }
        if(empty($request["from"])){
            $validation["fromH"] = "Opening hour must be require!";
        }
        if(empty($request["to"])){
            $validation["toH"] = "Closing hour must be require!";
        }
        $fromHour = date("g:iA", strtotime($_POST["from"]));
        $toHour = date("g:iA", strtotime($_POST["to"]));
        if(empty($request["phone_one"])){
            $validation["phone"] = "Phone number must be require!";
        }
        if(empty($request["latitude"]) && empty($request["longitude"])){
            $validation["location"] = "Location must be require!";
        }
      if(count($validation)>0){
          return $validation;
      }else{
          return "success";
      }
    }
}