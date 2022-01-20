<?php

require_once('../config/boats.php');
require_once('../config/mission.php');

  
if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit;

  }

}elseif(!isset($_SESSION["admin"]) ){
  header("location: ../index.php");
  exit;

}

   $editMission = new Mission();
   $data = $editMission->editMission();
   $mes = $editMission->editMissionRow();

   $displayBoat = new Boat(); //create a object
   $res =$displayBoat ->displayAllBoats();



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
                        if($error == "Save it"){
                            echo "<div class='alert alert-success alert-dismissible fade show messages' role='alert'>
                            <span>$error</span>  
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
                        }else{

                            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
                            <span>$error</span>  
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
  <div class="form-row">
  <input type="hidden" value="<?php echo $_GET['id-mission'] ?>" name="id_mission" class="form-control" >


    <div class="form-group col-md-6">

      <label >Status</label>
      <select name="status-mission" class="form-control">
      <option value = "<?php if(isset($data)){echo $data['status-mission'];} ?>" selected> <?php echo $data['status-mission'];?></option>

      <?php 
      if($data['status-mission'] == "Progress"){
       ?> 
        <option value="Done">Done</option>

       <?php } 
       else{
       ?> 
       <option value="Progress">Progress</option>

      <?php } ?>
      
      
    </select>
    </div>

    <div class="form-group col-md-6">
      <label >id Boat</label>
      <select name="id-boat" class="form-control">

  <?php if($res) {
  
  foreach($res as $row){ 

    if( $row['id-boat'] == $data['id-boat']){
      // $rub = $row['id-sup'];
       
   ?> 
      
    <option value="<?php echo $row['id-boat'];?>" selected ><?php echo $row['name-boat'];?></option>

    <?php
   

    }else{
   ?> 
 
        <option value="<?php echo $row['id-boat'];?>" ><?php echo $row['name-boat'];?></option>

 <?php } } }?>
    </select>  
     </div>

  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Date start</label>
      <input type="date" name="date-start" value="<?php if(isset($data)){echo $data['date-start'];} ?>" class="form-control" >
    </div>
    <div class="form-group col-md-6">
      <label >date End</label>
      <input type="date" name="date-end" value="<?php if(isset($data)){echo $data['date-end'];} ?>" class="form-control" >
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