
<?php 
ob_start();
require_once "template/header.php";
if(!isset($_SESSION["user_id"])){
  Helper::redirect("login.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
   $user = new User();
   $user = $user->register($_POST);  
   if($user == "register"){
    Helper::redirect("registration.php");
   }
}
?>     
<!-- content area start -->
  <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row mt-5">
                <div class="col-md-10 offset-md-1 col-sm-12">
                    <div class="card  p-3 shadow-sm rounded">
                      <div class="card-body">
                          <div class="row">
                              <!-- RegisterTable Form  start -->
                              <div class="col-12">
                                  <h3 class="text-center mb-5">User Registration</h3>
                              </div>
                              <!-- RegisterTable Form  end -->
                              <div class="col-lg-10 offset-md-1">
                                  <form method="POST" action="">
                                      <div class="form-group row">
                                          <label for="name" class="col-sm-3 col-form-label">Username</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="username" class="form-control" id="name">
                                            <?php if(isset($user) && is_array($user)){
                                                    if(isset($user["name"])){
                                            ?>
                                              <small class="text-danger pt-2"> <?php echo $user["name"] ?></small> 
                                              <i class="feather-alert-circle text-danger"></i>
                                            <?php } } ?>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                            <label for="email" class="col-sm-3 col-form-label">E-mail Address</label>
                                            <div class="col-sm-9">
                                                <input type="email"  name="email" class="form-control" id="email">
                                                <?php if(isset($user) && is_array($user)){ 
                                                    if(isset($user["email"])){
                                                  ?>
                                                  <small class="text-danger pt-2"> <?php echo $user["email"] ?></small> <i class="feather-alert-circle text-danger"></i>
                                                  <?php } 
                                                    if(isset($user["email-invalid"])){
                                                    ?> 
                                                    <small class="text-danger pt-2"> <?php echo $user["email-invalid"] ?></small> <i class="feather-alert-circle text-danger"></i>
                                                    <?php } 
                                                    if(isset($user["email-had"])){?>
                                                      <small class="text-danger pt-2"> <?php echo $user["email-had"] ?></small> <i class="feather-alert-circle text-danger"></i>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                      </div> 
                                      <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                          <input type="password" name="password" class="form-control" id="password">
                                          <?php if(isset($user) && is_array($user)){ 
                                                    if(isset($user["password"])){
                                            ?>
                                                  <small class="text-danger pt-2"> <?php echo $user["password"] ?></small> <i class="feather-alert-circle text-danger"></i>
                                                  <?php } 
                                                    if(isset($user["password-l"])){
                                                    ?> 
                                                    <small class="text-danger pt-2"> <?php echo $user["password-l"] ?></small> <i class="feather-alert-circle text-danger"></i>
                                                    <?php } ?>
                                            <?php } ?>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                            <label for="confirm_password" class="col-sm-3 col-form-label">Comfirm Password</label>
                                            <div class="col-sm-9">
                                            <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                            <?php if(isset($user) && is_array($user)){ 
                                                    if(isset($user["c-password"])){
                                            ?>
                                                  <small class="text-danger pt-2"> <?php echo $user["c-password"] ?></small> <i class="feather-alert-circle text-danger"></i>
                                                  <?php } 
                                                    if(isset($user["notsame-password"])){
                                                    ?> 
                                                    <small class="text-danger pt-2"> <?php echo $user["notsame-password"] ?></small> <i class="feather-alert-circle text-danger"></i>
                                                    <?php } ?>
                                            <?php } ?>
                                            </div>
                                      </div> 
                                      <button class="btn btn-warning float-right btn-sm">Register</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
              
            </div>
        </div>
          <!-- RegisterTable Column  start -->
        <div class=" col-12 col-lg-10 offset-lg-1">
          <div class="card mt-4 border-0">
              <table class="table register-table table-hover table-striped-md table-responsive-sm " >
                  <thead class="thead-warning">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                       <?php if(User::auth()->id ==1){ ?>
                      <th scope="col">Delete</th>
                      <?php }else{?>
                      <th scope="col">Create Date</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody id="action">
                   <!-- Show Register User -->
                  <?php
                    $no = 1;
                     $user = DB::table("users")->orderBy("id","desc")->get();
                     foreach($user as $u){
                  ?>
                    <tr>
                      <th scope="row"><?php echo $no++; ?></th>
                      <td><?php echo $u->name; ?></td>
                      <td><?php echo $u->email; ?></td>
                     
                      <td class="d-flex justify-content-center text-nowrap">
                      <?php if(User::auth()->id ==1 && $u->id != User::auth()->id){ ?>
                        <button adminId="<?php echo User::auth() ?  User::auth()->id : 0; ?>" id="deleteAcc" accountName="<?php echo $u->name ?>" accountId="<?php echo $u->id ?>" class=" btn-sm btn btn-danger"><i class="feather-trash-2"></i> Delete</button>
                      <?php }else if(User::auth()->id !=1 ){ ?>
                        <?php echo date("j / M / Y",strtotime($u->create_at)); ?>
                      <?php }else{ ?>
                        
                      <?php } ?>
                      </td> 
                    </tr> 
                     <?php } ?>
                  </tbody>
                </table>
          </div>
        </div>
        <!-- RegisterTable Column  end -->
    </div>
  </div>
<!-- content area end -->

<?php require_once "template/footer.php" ?>  
<script src="<?php echo $url ?>js/register.js"></script>
<script>
