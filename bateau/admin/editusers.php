<?php
require_once('../config/admin.php');

if(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
}


$editAdmins = new Admin();
$data =$editAdmins->editUserget();
$msg =$editAdmins->editUserpost();




?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                 

                         <!--------------------------------------- START from ---------------------------------->
<h3 class="text-center mb-5 bien">Edit Admins and Users</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Username</label>
      <input type="text" value="<?php if(isset($data)){echo $data['username'];} ?>" name="username" class="form-control" placeholder="Enter a Name">
    </div>
    <div class="form-group col-md-6">
      <label >Password</label>
      <input type="text" value="<?php if(isset($data)){echo $data['passwords'];} ?>" name="password" class="form-control" placeholder="Enter a password">
    </div>
  </div>
  <div class="form-group col-md-6">
      
      <input type="hidden" value="<?php echo $_GET['id_admin'] ?>" name="id" class="form-control" placeholder="Enter a password">
    </div>
  </div>
  <div class="form-group">
    <label class="d-block text-center text-danger">roles</label>
    <select name="role"  class="form-control">
    <?php  if(isset($data)){ 
         if($data['role'] == "admin"){
            
          echo '<option value ="">Select..</option>
             <option value ="admin" selected >Admin</option>
             <option value ="user">User</option>';
            }else{
                
           echo
             '<option value ="">Select..</option>
             <option value ="admin" >Admin</option>
             <option value ="user" selected>User</option>';
            }
        }
         ?>
        
      </select>  </div>
  
  <button type="submit"  name="send" class="btn btn-outline-danger btn-lg d-block mx-auto">Edit</button>
</form> 





     <!--------------------------------------- END from ---------------------------------->


                </div>
            </main>

           <!--------------------------------------- START Container---------------------------------->

        </div>
    </div>
    <?php
    require_once('../includes/script.php');
   ?>
</body>

</html>