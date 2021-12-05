<?php

require_once('../config/sups.php');
require_once('../config/sup.php');

  
if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit;

  }

}elseif(!isset($_SESSION["admin"]) ){
  header("location: ../index.php");
  exit;

}

   $editSuprv = new Suprv();
   $data = $editSuprv->editSup();
   $mes = $editSuprv->editSupRow();

   $displaySup = new Sup(); //create a object
   $res =$displaySup ->displaySup();



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
<h3 class="text-center mb-5 bien">Modifier Superviseur info</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Name Superviseur</label>
      <input type="text" value="<?php if(isset($data)){echo $data['name-sup'];} ?>" name="name-sup" class="form-control" placeholder="Enter a Name">
    </div>
    <div class="form-group col-md-6">
      <label >Phone Superviseur</label>
      <input type="text" value="<?php if(isset($data)){echo $data['phone-sup'];} ?>" name="phone-sup" class="form-control" placeholder="Enter a Phone">
    </div>
    
  </div>
  
  
  <div class="form-group">
    <label>Date</label>
    <input type="date" name="date" value="<?php if(isset($data)){echo $data['date'];} ?>" class="form-control" >
  </div>
  <div class="form-group col-md-6">
    <input type="hidden" value="<?php echo $_GET['id-sup'] ?>" name="id_sup" class="form-control" >
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