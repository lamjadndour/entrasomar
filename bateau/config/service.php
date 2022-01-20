<?php

require_once('dbconfig.php');

$db = new dbconfig();


class Service {
 
    function addService(){

      global $db;

      if(isset($_POST['send'])){
      
        $name_service = $_POST['name_service'];
        // $price_service = $_POST['price_service'];
        
      // if(empty($name_service)){
      // $error= "Replir toutes les champs";
      // header("Location:addService.php?error=$error");

      // }
      if( empty($name_service) ){
      $error= "Entrer le nom de Categorie";
      header("Location:addService.php?error=$error");
      // }elseif(empty($price_service)){
      //         $error= "Entrer prix de service";
      //         header("Location:addService.php?error=$error");

      }
      else{
            
         $query = $db->connection->prepare("INSERT INTO `service` (`id-service`, `name-service`) VALUES (NULL,?)");
         $stm = $query->execute(array($name_service));
         if($stm){
          $error= "Save it";
                header("Location:addService.php?error=$error");
                exit();
         }else{
          $error= "not insert success";
          header("Location:addService.php?error=$error");
          exit();
         } 


      }
         }
      }

// get all service
function displayAllService(){
    global $db;
    
    $stmt = $db->connection->prepare("SELECT * FROM `service` ");
    $stmt->execute();
    return $data = $stmt->fetchAll();

}
//get Service 

  function getService(){

       if(isset($_GET['id-service'])){
        global $db;
        $id_Service = $_GET['id-service'];
  
       $stmt = $db->connection->prepare("SELECT * FROM service WHERE `id-service` = $id_Service ");
      $stmt->execute();
      return $stmt->fetch();
   
 }
 }

//Edit service
  function editServiceRow(){
      global $db;
      
     if(isset($_POST['send'])){
       $name_service = $_POST['name_service'];
      //  $price_service = $_POST['price_service'];
       $id_service = $_POST['id_service'];
         $stmt = $db->connection->prepare("UPDATE `service` SET `name-service`= ? WHERE `service`.`id-service`= ? ");
          $res =$stmt->execute(array($name_service,$id_service));
         if($res){
      // return $error['success'] = "insert success";
           header("location: showService.php");
         }else{
          // return $error = "not insert success";
         }
     }
}


} //END class
