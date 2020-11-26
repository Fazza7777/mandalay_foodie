<?php
require_once "core/autoload.php";
if($_GET["id"]){
    session_destroy();
    Helper::redirect("login.php");
}else{
    Helper::redirect("login.php");
}