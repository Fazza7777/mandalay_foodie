<?php
class User{
    ##auth
     public static function auth(){
         if(isset($_SESSION["user_id"])){
            return  $user = DB::table("users")->where("id",$_SESSION["user_id"])->first();
         }else{
             return false;
         }
     }
    ## Register 
    public function register($request){
      
       $validation = [];
       ##name validation
       if(empty($request["username"])){
           $validation["name"] = "နာမည် ထည့်ရန်လိုအပ်ပါသည်";
       }else{
           $_SESSION["oldname"] = $request["username"];
       }
       ##email validation
       if(empty($request["email"])){
        $validation["email"] = "အီးမေးလ် ထည့်ရန်လိုအပ်ပါသည်";
       }else{
           if(!filter_var($request["email"],FILTER_VALIDATE_EMAIL)){
             $validation["email-invalid"] = "Invalid Email Format";
           }else{
                $_SESSION["oldemail"] = $request["email"];
              }
       }
       $emailCheck = DB::table("users")->where("email",$request["email"])->first();
       if($emailCheck){
         $validation["email-had"] = "အီးမေးလ် သည်အသုံပြုပီးသားဖြစ်ပါသည်";
       }
       ##password validation
       if(empty($request["password"])){
        $validation["password"] = "စကားဝှက် ထည့်ရန်လိုအပ်ပါသည်";
       }elseif(strlen($request["password"]) < 6){
        $validation["password-l"] = "စကားဝှက် သည်အနည်းဆုံး ၆လုံး ထည့်ရန်လိုအပ်ပါသည်";
      }
        if(empty($request["confirm_password"])){
         $validation["c-password"] = "အတည်ပြုစကားဝှက် ထည့်ရန်လိုအပ်ပါသည်";
        }
        if($request["password"] !== $request["confirm_password"]){
            $validation["notsame-password"] = "စကားဝှက်များတူညီရန်လိုအပ်ပါသည်";
        }

        if(count($validation) > 0){
            return $validation;
        }else{

            $user = DB::create("users",[
                "name"=>Helper::filter($request["username"]),
                "email"=>Helper::filter($request["email"]),
                "password"=>password_hash($request["password"],PASSWORD_DEFAULT)
            ]);
            if($user){
             $_SESSION["user_id"] = 1;
              Helper::redirect("registration.php");
            }
        }
    }
    ## Login 
    public function login($request){
        $validation = [];
        $emailCheck = DB::table("users")->where("email",$request["email"])->first();
        ##email validation
       if(empty($request["email"])){
        $validation["email"] = "အီးမေးလ် ထည့်ရန်လိုအပ်ပါသည်";
       }else{
           if(!filter_var($request["email"],FILTER_VALIDATE_EMAIL)){
             $validation["email-invalid"] = "Invalid Email Format";
           }else{
                
                if(!$emailCheck){
                 $validation["noregister"] = "အီးမေးလ်သည် Register မပြုလုပ်ရသေးပါ";
                }else{
                    if(!password_verify($request["password"],$emailCheck->password)){
                        $validation["password-false"] = "စကားဝှက် မှားနေပါသည်";
                    }
                }
           }
        }
        ## validation password
        if (empty($request["password"])) {
            $validation["password"] = "စကားဝှက် ထည့်ရန်လိုအပ်ပါသည်";
        }
        if(count($validation)>0){
            return $validation;
        }else{
            $_SESSION["user_id"] = $emailCheck->id;
            return "login_success";
        }
    }
}