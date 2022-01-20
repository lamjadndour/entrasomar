<?php

require_once('../config/plangeur.php');

  
if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit;

  }

}elseif(!isset($_SESSION["admin"]) ){
  header("location: ../index.php");
  exit;

}

   $editPlanguer = new Plangeur();
   $data = $editPlanguer->editPlangeur();
   $mes = $editPlanguer->editPlangeurRow();

   $displayPlangeur = new Plangeur(); //create a object
   $res =$displayPlangeur ->displayAll();



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
<?php print_r($mes);   ?>
<h3 class="text-center mb-5 bien">Modifier Plangeur info</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Name Plangeur</label>
      <input type="text" value="<?php if(isset($data)){echo $data['name-plangeur'];} ?>" name="name_plangeur" class="form-control" placeholder="Enter a Name">
    </div>
    <div class="form-group col-md-6">
      <label >phone Plangeur</label>
      <input type="text" value="<?php if(isset($data)){echo $data['phone-plangeur'];} ?>" name="phone_plangeur" class="form-control" placeholder="Enter phone number">
    </div>
    
  </div>
  
  
  <div class="form-group col-md-6">
    <input type="hidden" value="<?php echo $_GET['id-plangeur'] ?>" name="id_plangeur" class="form-control" >
  </div>
   
  
  <button type="submit"  name="send" class="btn btn-danger btn-lg d-block mx-auto">Modifier</button>
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