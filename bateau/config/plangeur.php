<?php

require_once('dbconfig.php');

$db = new dbconfig();


class Plangeur {
 
    function addPlangeur(){

      global $db;

      if(isset($_POST['send'])){
      
        $name_plangeur = $_POST['name_plangeur'];
        $phone_plangeur = $_POST['phone_plangeur'];
        
      if(empty($name_plangeur) && empty($phone_plangeur) ){
      $error= "Replir toutes les champs";
      header("Location:addPlangeur.php?error=$error");

      }elseif( empty($name_plangeur) ){
      $error= "Entrer sle nom de planguer";
      header("Location:addPlangeur.php?error=$error");
      }elseif(empty($phone_plangeur)){
          $error= "Entrer télephone de plangeur";
          header("Location:addPlangeur.php?error=$error");

       }else{
            
         $query = $db->connection->prepare("INSERT INTO `plangeur` (`id-plangeur`, `name-plangeur`, `phone-plangeur`) VALUES (NULL,?,?)");
         $stm = $query->execute(array($name_plangeur, $phone_plangeur));
         if($stm){
          $error= "Save it";
                header("Location:showPlangeur.php?error=$error");
                exit();
         }else{
          $error= "not insert success";
          header("Location:showPlangeur.php?error=$error");
          exit();
         } 


      }
         }
      }

   function displayAll(){
      global $db;
      
      $stmt = $db->connection->prepare("SELECT * FROM `plangeur` ORDER BY `id-plangeur` DESC");
      $stmt->execute();
      return $data = $stmt->fetchAll();

}

 

  function editPlangeur(){

       if(isset($_GET['id-plangeur'])){
        global $db;
        $id_Plangeur = $_GET['id-plangeur'];
  
       $stmt = $db->connection->prepare("SELECT * FROM plangeur WHERE `id-plangeur` = $id_Plangeur ");
      $stmt->execute();
      return $stmt->fetch();
   
 }
 }


  function editPlangeurRow(){
      global $db;
      
     if(isset($_POST['send'])){
        $name_plangeur = $_POST['name_plangeur'];
        $phone_plangeur = $_POST['phone_plangeur'];
      
        $id_Plangeur = $_POST['id_plangeur'];
         $stmt = $db->connection->prepare("UPDATE `plangeur` SET `name-plangeur`= ?,`phone-plangeur`= ?  WHERE `plangeur`.`id-plangeur`= ? ");
          $res =$stmt->execute(array($name_plangeur,$phone_plangeur,$id_Plangeur));
         if($res){
      // return $error['success'] = "insert success";
           header("location: showPlangeur.php");
         }else{
          // return $error = "not insert success";
         }
     }
}


} //END class
