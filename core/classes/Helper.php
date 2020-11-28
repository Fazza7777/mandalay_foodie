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

   public static function clearError(){
       $_SESSION["error"] = [];
   }
}