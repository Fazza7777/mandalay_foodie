<?php
session_start();
spl_autoload_register(function($class_name){
    require_once "classes/".$class_name.".php";
});
$url =  "http://{$_SERVER['HTTP_HOST']}/mandalay_foodie/";