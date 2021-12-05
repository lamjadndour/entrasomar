<?php



require_once('dbconfig.php');

$db = new dbconfig();


class Facture {
 
     function addFacture(){

      global $db;

      if(isset($_POST['send'])){
      
        $id_sup = $_POST['id_sup'];
        $id_boat = $_POST['id_boat'];
        $id_mission = $_POST['id_mission'];
        $Num_Facture = $_POST['num_facture'];
        $avance = $_POST['avance'];
        $total = $_POST['total'];
        $reste = $_POST['reste'];
        $remise = $_POST['remise'];
        $status = $_POST['status'];
        
        
      if(empty($Num_Facture) && empty($avance) && empty($status) && empty($remise) ){
      $error= "Replir toutes les champs";
      header("Location:addFacture.php?error=$error&id-mission=$id_mission&id-boat=$id_boat&total=$total");
      }elseif(empty($Num_Facture) ){
        $error= "Entrer le numéro de facture";
        header("Location:addFacture.php?error=$error&id-mission=$id_mission&id-boat=$id_boat&total=$total");
      }elseif($avance == "" ){
      $error= "Entrer l'avance";
      header("Location:addFacture.php?error=$error&id-mission=$id_mission&id-boat=$id_boat&total=$total");
      }elseif(empty($status)){
        $error= "Entrer status";
        header("Location:addFacture.php?error=$error&id-mission=$id_mission&id-boat=$id_boat&total=$total");

       }elseif(empty($remise)){
         $error= "Entrer remise";
         header("Location:addFacture.php?error=$error&id-mission=$id_mission&id-boat=$id_boat&total=$total");
     }elseif($avance > $reste){
      $error= "There cannot be the advance greater than the remainder to be paid ";
      header("Location:addFacture.php?error=$error&id-mission=$id_mission&id-boat=$id_boat&total=$total");
  }
     else{
            
        $query = $db->connection->prepare("INSERT INTO `facture` (`id-facture`,`id-sup`, `id-boat`, `id-mission`, `num_facture`, `avance`, `total`,`reste`, `remise`, `status`) VALUES (NULL,?,?,?,?,?,?,?,?,?)");
        $stm = $query->execute(array($id_sup ,$id_boat, $id_mission, $Num_Facture, $avance, $total, $reste, $remise, $status));
        if($stm){
        $error= "success";
        header("Location:showFacture.php?error=$error&id-mission=$id_mission");
        exit();
        }else{
        $error= "not insert success";
        header("Location:addFacture.php?error=$error&id-mission=$id_mission&id-boat=$id_boat&total=$total");
        exit();
        } 
         
      }
         }
      }

   function displayFacture(){
      global $db;
      $id_mission = $_GET['id-mission'];
      $stmt = $db->connection->prepare("SELECT * FROM facture WHERE `id-mission` = $id_mission");
      $stmt->execute();
      return $data = $stmt->fetchAll();
    
   }

   function displayAllFacture(){
    global $db;
    $stmt = $db->connection->prepare("SELECT * FROM facture " );
    $stmt->execute();
    return $data = $stmt->fetchAll();
  
 }
 

  function editFacture(){

       if(isset($_GET['id-facture'])){
        global $db;
        $id_facture = $_GET['id-facture'];
  
        $stmt = $db->connection->prepare("SELECT * FROM facture WHERE `id-facture` = $id_facture ");
        $stmt->execute();
        return $stmt->fetch();
   
 }
 }


  function editFactureRow(){
      global $db;

     if(isset($_POST['send'])){
      $id_mission = $_POST['id_mission'];
      $Num_Facture = $_POST['num_facture'];

      $avance = $_POST['avance'];
      $new_avance = $_POST['new_avance'];
      // $total = $_POST['total'];
      $reste = $_POST['reste'];
      // $remise = $_POST['remise'];
      $status = $_POST['status'];
      $id_facture = $_POST['id_facture'];

        
      if(empty($Num_Facture) && empty($avance) && empty($status)){
         $error= "Replir toutes les champs";
         header("Location:editFacture.php?error=$error&id-facture=$id_facture&id-mission=$id_mission");
         }elseif(empty($Num_Facture) ){
           $error= "Entrer le numéro de facture";
           header("Location:editFacture.php?error=$error&id-facture=$id_facture&id-mission=$id_mission");
         }
         elseif($avance == ""){
         $error= "Entrer l'avance";
         header("Location:editFacture.php?error=$error&id-facture=$id_facture&id-mission=$id_mission");
         }
         elseif(empty($status)){
           $error= "Entrer status";
           header("Location:editFacture.php?error=$error&id-facture=$id_facture&id-mission=$id_mission");
   
          }
          elseif($avance > $reste){
            $error= "There cannot be the advance greater than the remainder to be paid ";
            header("Location:editFacture.php?error=$error&id-facture=$id_facture&id-mission=$id_mission");
        }
       
      else{
         $stmt = $db->connection->prepare("UPDATE `facture` SET `num_facture`=?, `avance`= ?, `reste`= ?, `status`= ? WHERE `facture`.`id-facture`= ? ");
         $res = $stmt->execute(array($Num_Facture, $new_avance, $reste, $status, $id_facture));
        if($res){
          $error = "success";
          header("location: showFacture.php?error=$error&id-mission=$id_mission");
        }else{
          $error = "not success";
          header("location: showFacture.php?id-mission=$id_mission");
        }
      }
     }
}


} //END class
