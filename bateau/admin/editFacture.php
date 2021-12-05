<?php

require_once('../config/facture.php');

  
if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit;

  }

}elseif(!isset($_SESSION["admin"]) ){
  header("location: ../index.php");
  exit;

}

   $editFacture = new Facture();
   $data = $editFacture->editFacture();
   $mes = $editFacture->editFactureRow();


?>




<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
<!--------------------------------------- START Container---------------------------------->

    <main class="dash-content">
    <div class="container-fluid">
                   
    <?php
                if(isset($_GET["error"])){
                    $error =$_GET["error"];
                       
                            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
                            <span>$error</span>  
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
      
                }
                
                ?>


<!--------------------------------------- START from ---------------------------------->

<h3 class="text-center mb-5 bien">Modifier Facture</h3>

<div class="col-md-2 productbox ">
    <div class="producttitle">rest a payer</div>
    <div class="productprice"><div class="pull-right"></div>
    <div class="pricetext"><?php echo $data['reste'] ?> DH</div></div>

</div>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >  
      
  <div class="form-row">

   <input type="hidden" name="id_facture" id="id_facture" value="<?php echo $_GET['id-facture'] ?>">
   <div class="form-group col-md-6">
      <label >Numero de facture</label>
      <input type="text" class="form-control" value="<?php echo $data['num_facture']; ?>" name="num_facture" >
    </div>

    <div class="form-group col-md-6">
      <label >Avance (DH)</label>
      <input type="text" class="form-control" id="avance" name="avance" value="0" min="0" placeholder="Entrer l'avance" >
    </div>

    <input type="hidden" value="<?php echo $_GET['id-mission']; ?>" name="id_mission" class="form-control" >
    <input type="hidden" id="new_avance" name="new_avance" value="<?php echo $data['avance'] ;?>" >

    <input type="hidden" id="reste" name="total" value="<?php echo $data['reste'] ?>" >
    
    <input type="hidden" id="reste_avance" name="reste">

    <!-- <div class="form-group col-md-6">
      <label >Prix final</label>
      <input type="text" name="remise" id="remise" class="form-control" placeholder="Entrer le Prix final" onchange="Reste()">
   </div> -->

  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >status</label>
      <select name="status" class="form-control">
      <option value = "<?php if(isset($data)){echo $data['status'];} ?>" selected> <?php echo $data['status'];?></option>

      <?php 
      if($data['status'] == "Progress"){
       ?> 
        <option value="Done">Done</option>

       <?php } 
       else{
       ?> 
       <option value="Progress">Progress</option>

      <?php } ?>
      
      
    </select>
    </div>

  </div>

  
  <button type="submit" name="send" class="btn btn-outline-danger btn-lg d-block mx-auto " onclick="ResteAvance()">Modifier Facture</button>
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