<?php
require_once('../config/admin.php');


if(!isset($_SESSION["admin"])){  //check if session admin found or not 
  header("location: ../index.php");
  exit();
}



$Admin = new Admin();
$msg =$Admin->insertAdmins(); //call function from class admin to insert data and the sametimes return error 
 

?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                     <!--------------------------------------- START print message ---------------------------------->

                <?php
 if($msg){
          
        if($msg == "insert success"){
            echo "<div class='alert alert-success alert-dismissible fade show messages' role='alert'>
            <span>$msg</span>  
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
        }else{

            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
            <span>$msg</span>  
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span>
    </button>
    </div>";        }
        

    }
  
 ?>

                      <!--------------------------------------- END print message ---------------------------------->



                         <!--------------------------------------- START from ---------------------------------->
                    
<h3 class="text-center mb-5 bien">Add Admins and Users</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Username</label>
      <input type="text" name="username" class="form-control" placeholder="Enter a Name">
    </div>
    <div class="form-group col-md-6">
      <label >Password</label>
      <input type="text" name="password" class="form-control" placeholder="Enter a password">
    </div>
  </div>
  <div class="form-group">
    <label>roles</label>
    <select name="role" class="form-control">
        <option value ="" selected>Select..</option>
        <option value ="superadmin">Super Admin</option>
        <option value ="admin">Admin</option>
      </select>  </div>
  
  <button type="submit"  name="send" class="btn btn-outline-danger btn-lg d-block mx-auto ">Save</button>
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