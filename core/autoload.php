<?php
session_start();
date_default_timezone_set("Asia/Yangon");
spl_autoload_register(function($class_name){
    require_once "classes/".$class_name.".php";
});
$url =  "http://{$_SERVER['HTTP_HOST']}/mandalay_foodie/";