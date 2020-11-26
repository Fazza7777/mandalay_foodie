<?php
require_once "core/autoload.php";
if(isset($_GET["accDelete"])){
   $delId =  $_GET["id"];
   $delUser = DB::table("users")->delete("users",$delId);
    $html = showTable();
   echo $html;
}

## Edit 
if(isset($_GET["accEdit"])){
    $id = $_GET["edit_id"];
    $editData = DB::table("users")->where("id",$id)->first();
    echo json_encode($editData);
}
##update
if(isset($_POST["username"])){
    $id = $_POST["id"];
   $username = $_POST["username"];
   $email = $_POST["email"];
   $user = DB::table("users")->where("email",$email)->andWhere("id","!=",$id)->first();
   if($user){
       echo "already_exist";
   }else{
     $update_success = DB::update("users",[
          "name"=>$username,
          "email"=>$email
      ],$id);
       if($update_success){
          $html = showTable();
          echo $html;
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
             <button id='editAcc' accountName='{$u->name}' accountId='{$u->id}' class=' btn-sm btn btn-success mr-3'><i class='feather-edit mr-1'></i> Edit</button>
             <button id='deleteAcc' accountName='{$u->name}' accountId='{$u->id}' class=' btn-sm btn btn-danger'><i class='feather-trash-2'></i> Delete</button>
             </td>
         </tr> 
        ";
    }
    return $html;
}