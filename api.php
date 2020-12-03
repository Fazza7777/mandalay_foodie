<?php
require_once "core/autoload.php";
if(isset($_GET["accDelete"])){
   $delId =  $_GET["id"];
   $delUser = DB::table("users")->delete("users",$delId);
    $html = showTable();
    echo $html;
}


//del restaurant
if(isset($_GET["res_del"])){
    $id = $_GET["id"];
    $res = DB::delete("restaurants",$id);

}
//change password
if(isset($_POST["currentUserId"])){
    $id= $_POST["currentUserId"];
    $currentOldPassword = $_POST["currentold_password"];
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];
 
    if(!password_verify($oldPassword,$currentOldPassword)){
        echo "incorrect";
    }else{
       $changePass = DB::update("users",[
           "password"=>password_hash($newPassword,PASSWORD_DEFAULT)
       ],$id);
       if($changePass){
           echo "success";
       }
    }

}
//common code
function showTable(){
    $html = "";
    $id=1;
    $users = DB::table("users")->orderBy("id","desc")->get();
    foreach($users as $u){
        $html.="
         <tr>
             <th scope='row'>".$id++."</th>
             <td>{$u->name}</td>
             <td>{$u->email}</td>
             <td class='d-flex justify-content-center text-nowrap'>
             <button id='deleteAcc' accountName='{$u->name}' accountId='{$u->id}' class=' btn-sm btn btn-danger'><i class='feather-trash-2'></i> Delete</button>
             </td>
         </tr> 
        ";
    }
    return $html;
}