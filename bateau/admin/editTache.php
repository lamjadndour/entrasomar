<?php
require_once('../config/tache.php');
require_once('../config/service.php');
require_once('../config/mission.php');
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

   $editTache = new Tache();
   $data = $editTache->editTache();
   $mes = $editTache->editTacheRow();

   $displayMission = new Mission(); //create a object
   $resMission =$displayMission ->displayAllMission();

   $displayService = new Service(); //create a object
   $resService =$displayService ->displayAllService();

   $displayPlangeur = new Plangeur(); //create a object
   $resPlangeur =$displayPlangeur ->displayAll();



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
                        if($error == "edit success"){
                            echo "<div class='alert alert-success alert-dismissible fade show messages' role='alert'>
                            <span>The operation completed successfully</span>  
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
                        }else{

                            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
                            <span>The operation was not completed successfully</span>  
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>"; }
      
                }
                
                ?>

<!--------------------------------------- START from ---------------------------------->
<?php print_r($mes);   ?>

<h3 class="text-center mb-5 bien">Modifier Mission info</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " > 
<input type="hidden" value="<?php echo $_GET['id-tache'] ?>" name="id_tache" class="form-control" >

<div class="form-row">
        <input type="text" value="<?php echo $data['tache-name'] ?>" name="tache_name" class="form-control" placeholder="Entrer le nom de tache" >
</div>

    <div class="form-row">
        <div class="from-group col-md-6">
        <label >les Mission</label>
        <select name="id_mission" class="form-control">

        <?php if($resMission) {

        foreach($resMission as $rowM){ 

        if( $rowM['id-mission'] == $data['id-mission']){
            
            
        ?> 
            
        <option value="<?php echo $rowM['id-mission'];?>" selected ><?php echo $rowM['id-mission'];?></option>

        <?php


        }else{
        ?> 

        <option value="<?php echo $rowM['id-mission'];?>" ><?php echo $rowM['id-mission'];?></option>

        <?php } } }?>
        </select>
        </div>
        <div class="form-group col-md-6">

      <label >les Services</label>
      <select name="id_service" class="form-control">

        <?php if($resService) {

        foreach($resService as $row){ 

        if( $row['id-service'] == $data['id-service']){
            // $rub = $row['id-sup'];
            
        ?> 
            
        <option value="<?php echo $row['id-service'];?>" selected ><?php echo $row['name-service'];?></option>

        <?php


        }else{
        ?> 

        <option value="<?php echo $row['id-service'];?>" ><?php echo $row['name-service'];?></option>

        <?php } } }?>
        </select>
    </div>
    </div>    

  <div class="form-row">
    <div class="form-group col-md-6">

      <label >les Plangeurs</label>
      <select name="id_plangeur" class="form-control">

        <?php if($resPlangeur) {
        
        foreach($resPlangeur as $rowP){ 

            if( $rowP['id-plangeur'] == $data['id-plangeur']){
            // $rub = $row['id-sup'];
       
            ?> 
                
                <option value="<?php echo $rowP['id-plangeur'];?>" selected ><?php echo $rowP['name-plangeur'];?></option>

                <?php
            

                }else{
            ?> 
            
                    <option value="<?php echo $rowP['id-plangeur'];?>" ><?php echo $rowP['name-plangeur'];?></option>

            <?php } } }?>
                </select>  
    </div>

    <div class="form-group col-md-6">
      <label >Status</label>

      <select name="status_tache" class="form-control">
      <option value = "<?php if(isset($data)){echo $data['status-tache'];} ?>"> <?php echo $data['status-tache'];?></option>

      <?php 
      if($data['status-tache'] == "Progress"){
       ?> 
        <option value="Done">Done</option>

       <?php } 
       else{
       ?> 
       <option value="Progress">Progress</option>

      <?php } ?>
      
     
      
      
      <!-- <option value="Progress">Progress</option>
       <option value="Done">Done</option> -->
      
    </select>
     </div>

  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Date start</label>
      <input type="date" name="date_start" value="<?php if(isset($data)){echo $data['date-start'];} ?>" class="form-control" >
    </div>
    <div class="form-group col-md-6">
      <label >date End</label>
      <input type="date" name="date_end" value="<?php if(isset($data)){echo $data['date-end'];} ?>" class="form-control" >
    </div>
  </div>
 
  
  <button type="submit" name="send" class="btn btn-danger btn-lg d-block mx-auto">Modifier</button>
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