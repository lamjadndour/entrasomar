<?php



require_once('dbconfig.php');

$db = new dbconfig();


class Tache {
 
     function addTache(){

      global $db;
 
      if(isset($_POST['send'])){

        $tache_name = $_POST['tache_name'];
        $id_mission = $_POST['id_mission'];
        $id_service = $_POST['id_service'];
        $id_plangeur = $_POST['id_plangeur'];
        $status_tache = "Progress";
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];
     
        

      if(empty($tache_name) && empty($id_service) && empty($id_plangeur) && empty($status_tache) && empty($date_start) & empty($date_end) ){
      $error= "Replir toutes les champs";
      header("Location:addTache.php?error=$error&id-mission=$id_mission");

       }elseif(empty($tache_name)){
         $error= "Entrer le nom de tache";
         header("Location:addTache.php?error=$error&id-mission=$id_mission");

      }elseif(empty($id_mission)){
              $error= "Entrer id de mission";
              header("Location:addTache.php?error=$error&id-mission=$id_mission");

       }elseif(empty($id_service)){
         $error= "Entrer id de service";
         header("Location:addTache.php?error=$error&id-mission=$id_mission");

        }elseif(empty($id_plangeur)){
        $error= "Entrer le nom de capitane";
        header("Location:addTache.php?error=$error&id-mission=$id_mission");

        }elseif(empty($status_tache)){
        $error= "Entrer status de tache";
        header("Location:addTache.php?error=$error&id-mission=$id_mission");

        }elseif(empty($date_start)){
        $error= "entrer la date de départ ";
        header("Location:addTache.php?error=$error&id-mission=$id_mission");

        }elseif(empty($date_end)){
        $error= "Entrer la date de d'expiration";
        header("Location:addTache.php?error=$error&id-mission=$id_mission");

        } else{
            
         $query = $db->connection->prepare("INSERT INTO `tache` (`id-tache`,`tache-name`,`id-mission`, `id-service`, `id-plangeur`, `status-tache`, `date-start`, `date-end`) VALUES (NULL,?,?,?,?,?,?,?)");
         $stm = $query->execute(array($tache_name, $id_mission,$id_service,$id_plangeur,$status_tache,$date_start,$date_end));
         if($stm){
          $error= "Save it";
                header("Location:showTache.php?error=$error&id-mission=$id_mission");
                exit();
         }else{
          $error= "not insert success";
          header("Location:addTache.php?error=$error&id-mission=$id_mission");
          exit();
         } 


      }
         }
      }

   function displayAllTache(){
     
         $stmt = $db->connection->prepare("SELECT * FROM tache ");
         $stmt->execute(array(2));
         return $data = $stmt->fetchAll();
    
   }


function displayTacheByMission(){
     
   if(isset($_GET['id-mission'])){
      global $db;
      $id_mission = $_GET['id-mission'];
      $stmt = $db->connection->prepare("SELECT * FROM tache WHERE `id-mission` = ?");
      $stmt->execute(array($id_mission));
      return $data = $stmt->fetchAll();
 
   }
}

 

  function editTache(){

       if(isset($_GET['id-tache'])){
        global $db;
        $id_tache = $_GET['id-tache'];
  
      $stmt = $db->connection->prepare("SELECT * FROM tache WHERE `id-tache` = $id_tache ");
      $stmt->execute();
      return $stmt->fetch();
   
 }
 }


  function editTacheRow(){
      global $db;
      
     if(isset($_POST['send'])){
        $tache_name = $_POST['tache_name'];
        $id_mission = $_POST['id_mission'];
        $id_service = $_POST['id_service'];
        $id_plangeur = $_POST['id_plangeur'];
        $status_tache = $_POST['status_tache'];
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];

        $id_tache = $_POST['id_tache'];
         $stmt = $db->connection->prepare("UPDATE `tache` SET `tache-name`= ?, `id-mission`= ?,`id-service`= ?,`id-plangeur`= ?,`status-tache`= ?,`date-start`= ? ,`date-end`= ? WHERE `tache`.`id-tache`= ? ");
          $res =$stmt->execute(array($tache_name, $id_mission, $id_service, $id_plangeur, $status_tache, $date_start, $date_end,$id_tache));
         if($res){
          $error = "edit success";
           header("location: editTache.php?error=$error&id-tache=$id_tache");
         }else{
          $error = "not success";
          header("location: editTache.php?error=$error&id-tache=$id_tache");
         }
     }
}





} //END class
