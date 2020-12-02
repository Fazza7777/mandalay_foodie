<?php
class Restaurant{
    public  function create($request){
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
          $myanmar_name = $request["myanmar_name"];
          $english_name = $request["english_name"];
          $cuisine_type = $request["cuisine_type"];
          $meal_type = $request["meal_type"];
          $eatery_type = $request["eatery_type"];
          $restaurant_image = $_FILES["shop"]["name"];
          $m_address = $request["m_address"];
          $e_address = $request["e_address"];
          $phone_one = $request["phone_one"];
          if(isset($request["phone_two"]))  $phone_two = $request["phone_two"];
          if(isset($request["facebook-id"]))  $facebook = $request["facebook-id"];
          if(isset($request["website-url"]))  $website= $request["website-url"];
          if(isset($request["signature"]))  $signature= $request["signature"];
          $latitude = $request["latitude"];
          $longitude = $request["longitude"];
          $from = $request["from"];
          $to = $request["to"];
          //Features
          if(empty($_FILES["menu"]["name"])) $menu_image = "default_menu.png";
          else $menu_image = $_FILES["menu"]["name"];
          if(isset($request["Halal"])) $halal = $request["Halal"];
          else $halal = 0;
          if(isset($request["Vegetrian"])) $vegetrian = $request["Vegetrian"];
          else $vegetrian = 0;
          if(isset($request["air"])) $air = $request["air"];
          else $air = 0;
          if(isset($request["wifi"])) $wifi = $request["wifi"];
          else $wifi = 0;
          if(isset($request["parking"])) $parking = $request["parking"];
          else $parking = 0;
          if(isset($request["credit_card"])) $credit = $request["credit_card"];
          else $credit = 0;
          if(isset($request["foreign"])) $foreign = $request["foreign"];
          else $foreign = 0;
          if(isset($request["delivery"])) $delivery = $request["delivery"];
          else $delivery = 0;
          if(isset($request["buffet"])) $buffet = $request["buffet"];
          else $buffet = 0;
         // Menu
         if(isset($request["monday"])) $monday = $request["monday"];
         else $monday = 0;
         if(isset($request["tuesday"])) $tuesday = $request["tuesday"];
         else $tuesday = 0;
         if(isset($request["wednesday"])) $wednesday = $request["wednesday"];
         else $wednesday = 0;
         if(isset($request["thursday"])) $thursday = $request["thursday"];
         else $thursday = 0;
         if(isset($request["fridy"])) $fridy = $request["fridy"];
         else $fridy = 0;
         if(isset($request["saturday"])) $saturday = $request["saturday"];
         else $saturday = 0;
         if(isset($request["sunday"])) $sunday = $request["sunday"];
         else $sunday = 0;

          $restaurant= DB::create("restaurants",[
            "name_myanmar" => $myanmar_name,
            "name_english" => $english_name,
            "restaurant_image"=>$restaurant_image,
            "cuisine_type"=>$cuisine_type,
            "meal_type"=>$meal_type,
            "eatery_type"=>$eatery_type,
            "halal"=>$halal,
            "vegetrian"=>$vegetrian,
            "air_conditioned"=>$air,
            "wifi"=>$wifi,
            "parking"=>$parking,
            "credit_card"=>$credit,
            "foreign_currency"=>$foreign,
            "delivery"=>$delivery,
            "buffet"=>$buffet,
            "address_myanmar"=>$m_address,
            "address_english"=>$e_address,
            "menu"=>$menu_image,
            "phone_one"=>$phone_one,
            "phone_two"=>$phone_two,
            "from_hour"=>$from,
            "to_hour"=>$to,
            "monday"=>$monday,
            "tuesday"=>$tuesday,
            "wednesday"=>$wednesday,
            "thursday"=>$thursday,
            "friday"=>$fridy,
            "saturday"=>$saturday,
            "sunday"=>$sunday,
            "facebook_id"=>$facebook,
            "website_url"=>$website,
            "signature_food"=>$signature,
            "latitude"=>$latitude,
            "longitude"=>$longitude,

          ]);
        if($restaurant){
            Helper::redirect("index.php");
        }else{
            return "fail";
        }
      }
    }
    public static function restaurants(){
       return $restaurants = DB::table("restaurants")->orderBy("id","desc")->paginate(6);
    }
    public static function all(){
        return $restaurants = DB::table("restaurants")->orderBy("id","desc")->get();
     }
     public function search($request){
         
        if(empty($request["cuisine_type"])){
            $c_type="nothing";        
        }else{
            $c_type = $request["cuisine_type"];
        }
        if(empty($request["meal_type"])){       
            $m_type="nothing";
        }else{
            $m_type = $request["meal_type"];
        }
        if(empty($request["eatery_type"])){
          
            $e_type="nothing";
        }else{
            $e_type = $request["eatery_type"];
        }
        if(empty($request["address"])){    
            $add="nothing";
        }else{
            $add = $request["address"];
        }
        if(isset($request["features"])){
            $wifi = self::checkFeatures($request["features"],"wifi");
            $air = self::checkFeatures($request["features"],"air_conditioned");
            $halal = self::checkFeatures($request["features"],"halal");
            $veg = self::checkFeatures($request["features"],"vegetrian");
            $parking = self::checkFeatures($request["features"],"parking");
            $credit = self::checkFeatures($request["features"],"credit_card");
            $foreign = self::checkFeatures($request["features"],"foreign_currency");
            $buffet = self::checkFeatures($request["features"],"buffet");
            $delivery = self::checkFeatures($request["features"],"delivery");
        }else{
            $wifi = "nothing"; 
            $air = "nothing";
            $halal = "nothing"; 
            $veg = "nothing"; 
            $parking = "nothing"; 
            $credit = "nothing"; 
            $foreign = "nothing"; 
            $buffet = "nothing"; 
            $delivery = "nothing"; 
        }

         $search = DB::table("restaurants")
                 ->where("cuisine_type","like","%".$c_type."%")
                ->orwhere("meal_type","like","%".$m_type."%")
                ->orwhere("eatery_type","like","%".$e_type."%")
                ->orwhere("address_myanmar","like","%".$add."%")
                ->orwhere("vegetrian","like","%".$veg."%")
                ->orwhere("halal","like","%".$halal."%")
                ->orwhere("wifi","like","%".$wifi."%")
                ->orwhere("air_conditioned","like","%".$air."%")
                ->orwhere("parking","like","%".$parking."%")
                ->orwhere("credit_card","like","%".$credit."%")
                ->orwhere("foreign_currency","like","%".$foreign."%")
                ->orwhere("buffet","like","%".$buffet."%")
                ->orwhere("delivery","like","%".$delivery."%")
                ->orderBy("id","desc")
                ->paginate(12);
      
        if($search){
            return  $search;
        }
       
     }
     public static function checkFeatures($features,$f){
         if(isset($features) && $features==$f){
            $feature="1";
           }else{
               $feature = "nothing";
           }
           return $feature;
     }
}