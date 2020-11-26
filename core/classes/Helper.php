<?php
class Helper{
    public static function redirect($path){
        header("location:$path");
    }
    public static function old($request){
           if(isset($_SESSION[$request])){
               echo $_SESSION[$request];
            
           }
    }

   public static function filter($text){
       $text = trim($text);
       $text = htmlspecialchars($text);
       $text = htmlentities($text,ENT_QUOTES);
       $text = stripcslashes($text);
     
       return $text;
   }
   public static function checkValidateError($arr,$checkvalue){  
           if (isset($checkvalue)) {
              echo $arr[$checkvalue];
           }    
   }
}