<?php

require_once('../config/boats.php');
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

   $editBoat = new Boat();
   $data = $editBoat->editBoat();
   $mes = $editBoat->editBoatRow();

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
<h3 class="text-center mb-5 bien">Modifier Bateau info</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Serie bateau</label>
      <input type="text" value="<?php if(isset($data)){echo $data['serie-boat'];} ?>" name="serie-boat" class="form-control" placeholder="Enter a Name">
    </div>
    <div class="form-group col-md-6">
      <label >mokabil</label>
      <select name="id-sup" class="form-control">

        <?php if($res) {
        
        foreach($res as $row){ 

          if( $row['id-sup'] == $data['id-sup']){
            // $rub = $row['id-sup'];
            
        ?> 
            
          <option value="<?php echo $row['id-sup'];?>" selected ><?php echo $row['name-sup'];?></option>

          <?php
        

          }else{
        ?> 
 
        <option value="<?php echo $row['id-sup'];?>" ><?php echo $row['name-sup'];?></option>

    <?php } } }?>
        </select>     </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label >Bateau name</label>
          <input type="text" value="<?php if(isset($data)){echo $data['name-boat'];} ?>" name="name-boat" class="form-control" placeholder="Enter a Name">
        </div>
        <div class="form-group col-md-6">
          <label >Nom capitane</label>
          <input type="text" value="<?php if(isset($data)){echo $data['name-capitane-boat'];} ?>" name="name-capitane-boat" class="form-control" placeholder="Enter a Last Name">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label >type Bateau</label>
          <input type="text" value="<?php if(isset($data)){echo $data['type-boat'];} ?>" name="type-boat" class="form-control" placeholder="Enter a Name">
        </div>
        <div class="form-group col-md-6">
          <label >phone capitane</label>
          <input type="text" value="<?php if(isset($data)){echo $data['capitane-phone-boat'];} ?>" name="capitane-phone-boat" class="form-control" placeholder="Enter a Last Name">
        </div>
      </div>
      <div class="form-group">
        <label>Date</label>
        <input type="date" name="date" value="<?php if(isset($data)){echo $data['date'];} ?>" class="form-control" >
        </div>
      <div class="form-group col-md-6">
          
          <input type="hidden" value="<?php echo $_GET['id-boat'] ?>" name="id_boat" class="form-control" >
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