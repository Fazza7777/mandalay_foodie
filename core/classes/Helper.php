<?php
class Helper{
    public static function redirect($path){
        header("location:$path");
    }

   public static function filter($text){
       $text = trim($text);
       $text = htmlspecialchars($text);
       $text = htmlentities($text,ENT_QUOTES);
       $text = stripcslashes($text);
     
       return $text;
   }
   public static function old($inputName){
       if(isset($_POST[$inputName])){
           echo $_POST[$inputName];
       }else{
           echo "";
       }
   }
   public static function shopTime($from,$to){
        $now = date("H a") ;
        $from = date("H", strtotime($from));
        $to = date("H", strtotime($to));
        if ($from<=$now && $to>=$now) {
            return "open";
        }else{
            return "close";
        }
   }
  public static function checkValidateError($arr,$name){
      if(isset($arr[$name])){
          echo $arr[$name];
      }
  }
  public static function address(){
    $address = [];
    $ad = DB::table("restaurants")->get();
    foreach($ad as $a){
        $address[]=$a->address_myanmar;
    }
   return array_unique($address);
  }
  public static function selectValue($check,$value){

        if($check == $value) return "selected";
         else return "";
  }
  public static function checkValue($check,$value){

    if($check == $value) return "checked";
     else return "";
}

}