<?php
require_once "core/autoload.php";
if(isset($_SESSION["user_id"])){
    echo $_SESSION["user_id"];
}else{
    echo "as";
}