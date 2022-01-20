<?php



require_once('dbconfig.php');

$db = new dbconfig();


class Mission {
 
     function addMission(){

      global $db;

      if(isset($_POST['send'])){
      
        $status_name = 'Progress';
        $id_boat = $_POST['id_boat'];
        $date_start = date('Y-m-d H:i:s');
        $date_end = date('Y-m-d H:i:s');
        
      if(empty($status_name) && empty($id_boat) && empty($name_boat) && empty($date_start) && empty($date_end) ){
      $error= "Replir toutes les champs";
      header("Location:addMission.php?error=$error");

      }elseif( empty($status_name) ){
      $error= "Entrer status name de Misiion";
      header("Location:addMission.php?error=$error");
      }elseif(empty($id_boat)){
              $error= "Entrer id de boat";
              header("Location:addMission.php?error=$error");

       }
   //     elseif(empty($date_start)){
   //       $error= "Entrer le nom de bateau";
   //       header("Location:addMission.php?error=$error");

   //   }elseif(empty($date_end)){
   //    $error= "Entrer le nom de capitane";
   //    header("Location:addMission.php?error=$error");
   //   }

     
      else{
            
         $query = $db->connection->prepare("INSERT INTO `mission` (`id-mission`, `status-mission`, `id-boat`, `date-start`, `date-end`) VALUES (NULL,?,?,?,?)");
         $stm = $query->execute(array($status_name ,$id_boat, $date_start, $date_end));
         if($stm){
          $error= "success";
            header("Location:showMission.php?error=$error");
            exit();
         }else{
          $error= "not insert success";
          header("Location:showMission.php?error=$error");
          exit();
         } 
         
      }
         }
      }

   function displayAllMission(){
      global $db;
     
      $stmt = $db->connection->prepare("SELECT * FROM mission ORDER BY `id-mission` DESC");
      $stmt->execute();
      return $data = $stmt->fetchAll();
    
   }
 

  function editMission(){

       if(isset($_GET['id-mission'])){
        global $db;
        $id_Mission = $_GET['id-mission'];
  
       $stmt = $db->connection->prepare("SELECT * FROM mission WHERE `id-mission` = $id_Mission ");
      $stmt->execute();
      return $stmt->fetch();
   
 }
 }


  function editMissionRow(){
      global $db;
      
     if(isset($_POST['send'])){
       $status_mission = $_POST['status-mission'];
       $id_boat = $_POST['id-boat'];
       $date_start = $_POST['date-start'];
       $date_end = $_POST['date-end'];
       $id_mission = $_POST['id_mission'];
       
       $stmt = $db->connection->prepare("UPDATE `mission` SET `status-mission`= ?,`id-boat`= ?,`date-start`= ?,`date-end`= ? WHERE `mission`.`id-mission`= ? ");
          $res = $stmt->execute(array($status_mission, $id_boat, $date_start, $date_end, $id_mission));
         if($res){
          $error = "success";
           header("location: showMission.php?error=$error");
         }else{
          $error = "not insert success";
          header("location: showMission.php?error=$error");
         }
     }
}


} //END class
