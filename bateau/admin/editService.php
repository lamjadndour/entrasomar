<?php

require_once('../config/service.php');

  
if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit;

  }

}elseif(!isset($_SESSION["admin"]) ){
  header("location: ../index.php");
  exit;

}

   $editService = new Service();
   $data = $editService->getService();
   $mes = $editService->editServiceRow();

   $displayService = new Service(); //create a object
   $res =$displayService ->displayAllService();



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
      <label >Name Service</label>
      <input type="text" value="<?php if(isset($data)){echo $data['name-service'];} ?>" name="name_service" class="form-control" placeholder="Enter a Name">
    </div>
    <div class="form-group col-md-6">
      <label >prix Service</label>
      <input type="text" value="<?php if(isset($data)){echo $data['price-service'];} ?>" name="price_service" class="form-control" placeholder="Enter a prix">
    </div>
    
  </div>
  
  
  <div class="form-group">
    <label>Date</label>
    <input type="date" name="date" value="<?php if(isset($data)){echo $data['date'];} ?>" class="form-control" >
  </div>
  <div class="form-group col-md-6">
    <input type="hidden" value="<?php echo $_GET['id-service'] ?>" name="id_service" class="form-control" >
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