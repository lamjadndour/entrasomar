<?php


require_once('dbconfig.php');

$db = new dbconfig();

class Delete {



function delete(){
    global $db;
  
      //Delete admins and users by  id
  if (isset($_GET['id_admin'])){
  
       $id_admin = $_GET['id_admin'];
      
  $stmt = $db->connection->prepare("DELETE FROM `admins` WHERE id_admin = ? ");
  $stmt->execute(array($id_admin));
   if ($stmt){
      header("location:showusers.php");
      exit();
   }
  
   
  }elseif(isset($_GET['id-boat'])){  //Delete Budget by id
      

    $id_boat = $_GET['id-boat'];
  
$stmt = $db->connection->prepare("DELETE FROM `boat` WHERE `id-boat` = ? ");
$stmt->execute(array($id_boat));

if($stmt){
   header("location:showBoat.php");
   exit();
}
}

elseif(isset($_GET['id_Ese'])){  //Delete Etreprise by id
      

  $id_Ese = $_GET['id_Ese'];

$stmt = $db->connection->prepare("DELETE FROM `société` WHERE Ids = ? ");
$stmt->execute(array($id_Ese));

if($stmt){
 header("location:showEse.php");
 exit();
}
}




elseif(isset($_GET['id_Ens'])){  //Delete Etreprise by id
      

  $id_Ens = $_GET['id_Ens'];

$stmt = $db->connection->prepare("DELETE FROM `enseignant` WHERE id_Ens = ? ");
$stmt->execute(array($id_Ens));

if($stmt){
 header("location:showEns.php");
 exit();
}
}
elseif(isset($_GET['id_Commande'])){  //Delete Commande by id
      

  $id_Com= $_GET['id_Commande'];

$stmt = $db->connection->prepare("DELETE FROM `opercommande` WHERE id_Commande = ? ");
$stmt->execute(array($id_Com));

if($stmt){
 header("location:showCom.php");
 exit();
}
}elseif(isset($_GET['id_rubrique'])){  //Delete rubrique by id
  
  $id_Rub= $_GET['id_rubrique'];

$stmt = $db->connection->prepare("DELETE FROM `rubrique` WHERE id_rubrique = ? ");
$stmt->execute(array($id_Rub));

if($stmt){
 header("location:showRub.php");
 exit();
}
}
elseif(isset($_GET['id_Depl'])){  //Delete rubrique by id
  
  $id_depl= $_GET['id_Depl'];

$stmt = $db->connection->prepare("DELETE FROM `operdeplacement` WHERE id_dep= ? ");
$stmt->execute(array($id_depl));

if($stmt){
 header("location:showDepl.php");
 exit();
}
}elseif(isset($_GET['id_Cmd'])){  //Delete rubrique by id
  
  $id_Cmd= $_GET['id_Cmd'];

$stmt = $db->connection->prepare("DELETE FROM `commande` WHERE id_Cmd= ? ");
$stmt->execute(array($id_Cmd));

if($stmt){
 header("location:displayCmd.php");
 exit();
}
}
elseif(isset($_GET['id_Deps'])){  //Delete rubrique by id
  
  $id_Depls= $_GET['id_Deps'];

$stmt = $db->connection->prepare("DELETE FROM `deplacement` WHERE id_Deps= ? ");
$stmt->execute(array($id_Depls));

if($stmt){
 header("location:displayDepl.php");
 exit();
}
}
elseif(isset($_GET['id_opRubs'])){  //Delete rubrique by id
  
  $id_opRubs= $_GET['id_opRubs'];

$stmt = $db->connection->prepare("DELETE FROM `operrubs` WHERE id_opRubs= ? ");
$stmt->execute(array($id_opRubs));

if($stmt){
 header("location:showOperRubs.php");
 exit();
}
}

// Start Version Taoufiq
elseif(isset($_GET['id-sup'])){  //Delete rubrique by id
  
  $id_sup= $_GET['id-sup'];

// $stmt = $db->connection->prepare("DELETE FROM `sup` WHERE id-sup= ? ");
// $stmt->execute(array($id_sup));
$stmt = $db->connection->prepare("DELETE FROM `sup` WHERE `id-sup`= ? ");
$stmt->execute(array($id_sup));
if ($stmt){
  header("location:showSup.php");
  exit();
}
}
// End Version Taoufiq

// Start Delete Plangeur
elseif(isset($_GET['id-plangeur'])){  //Delete rubrique by id
  
  $id_plangeur= $_GET['id-plangeur'];

$stmt = $db->connection->prepare("DELETE FROM `plangeur` WHERE `id-plangeur`= ? ");
$stmt->execute(array($id_plangeur));
if ($stmt){
  header("location:showPlangeur.php");
  exit();
}
}
// End Delete Plangeur

// Start Delete Tache
elseif(isset($_GET['id-tache'])){  //Delete rubrique by id
  
  $id_tache= $_GET['id-tache'];
  $id_mission= $_GET['id-mission'];

$stmt = $db->connection->prepare("DELETE FROM `tache` WHERE `id-tache`= ? ");
$stmt->execute(array($id_tache));
if ($stmt){
  header("location:showTache.php?id-mission=$id_mission");
  exit();
}
}
// End Delete Tache

// Start Delete Mission
elseif(isset($_GET['id-mission'])){  //Delete rubrique by id
  
  $id_mission= $_GET['id-mission'];

$stmt = $db->connection->prepare("DELETE FROM `mission` WHERE `id-mission`= ? ");
$stmt->execute(array($id_mission));
if ($stmt){
  header("location:showMission.php");
  exit();
}
}
// End Delete Mission

////////////// Service ////////////////////////
elseif(isset($_GET['id-service'])){  //Delete rubrique by id
  
  $id_service= $_GET['id-service'];
$stmt = $db->connection->prepare("DELETE FROM `service` WHERE `id-service`= ? ");
$stmt->execute(array($id_service));
if ($stmt){
  header("location:showService.php");
  exit();
}
}



/////////////////////End Service//////////////////////////

}//End  delete Function


  
    } //End Class