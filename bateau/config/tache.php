<?php



require_once('dbconfig.php');

$db = new dbconfig();


class Tache {
 
     function addTache(){

      global $db;
 
      if(isset($_POST['send'])){

        $tache_name = $_POST['tache_name'];
        $id_mission = $_POST['id_mission'];
        $category = $_POST['category'];
        $id_plangeur = $_POST['id_plangeur'];
        $price = $_POST['price'];
        $qte = $_POST['qte'];
        $status_tache = "Progress";
        $prime = $_POST['prime'];
        $date = $_POST['date'];
        
      //   $date_end = $_POST['date_end'];
     
        

      if(empty($tache_name) && empty($id_service) && empty($id_plangeur) && empty($status_tache) && empty($prime) & empty($date) ){
      $error= "Replir toutes les champs";
      header("Location:addTache.php?error=$error&id-mission=$id_mission");

       }elseif(empty($tache_name)){
         $error= "Entrer le nom de tache";
         header("Location:addTache.php?error=$error&id-mission=$id_mission");

      }elseif(empty($id_mission)){
              $error= "Entrer id de mission";
              header("Location:addTache.php?error=$error&id-mission=$id_mission");

       }elseif(empty($category)){
         $error= "Entrer id de service";
         header("Location:addTache.php?error=$error&id-mission=$id_mission");

        }elseif(empty($id_plangeur)){
        $error= "Entrer le nom de capitane";
        header("Location:addTache.php?error=$error&id-mission=$id_mission");

        }
        elseif(empty($status_tache)){
        $error= "Entrer status de tache";
        header("Location:addTache.php?error=$error&id-mission=$id_mission");
        }
        elseif(empty($prime)){
        $error= "Entrer prime (oui ou non)";
        header("Location:addTache.php?error=$error&id-mission=$id_mission");

        }elseif(empty($date)){
        $error= "entrer la date ";
        header("Location:addTache.php?error=$error&id-mission=$id_mission");
      }
      
    else{
            
         $query = $db->connection->prepare("INSERT INTO `tache` (`id-tache`,`tache-name`,`id-mission`, `category`, `id-plangeur`, `price`, `quantite`, `status-tache`, `prime`, `date`) VALUES (NULL,?,?,?,?,?,?,?,?,?)");
         $stm = $query->execute(array($tache_name, $id_mission,$category,$id_plangeur,$price, $qte, $status_tache,$prime,$date));
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


   function displayTachePlang(){

      if(isset($_GET['id-plangeur'])){
      $id_plangeur = $_GET['id-plangeur'];
      $stmt = $db->connection->prepare("SELECT * FROM tache WHERE `id-plangeur` = ? ");
      $stmt->execute(array($id_plangeur));
      return $data = $stmt->fetchAll();
      }
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
      $category = $_POST['category'];
      $id_plangeur = $_POST['id_plangeur'];
      $price = $_POST['price'];
      $qte = $_POST['qte'];
      $status_tache = $_POST['status_tache'];
      $prime = $_POST['prime'];
      $date = $_POST['date'];


        $id_tache = $_POST['id_tache'];
         $stmt = $db->connection->prepare("UPDATE `tache` SET `tache-name`= ?, `id-mission`= ?,`category`= ?,`id-plangeur`= ?, `price` = ? ,`quantite` = ?, `status-tache`= ?,`prime`= ? ,`date`= ? WHERE `tache`.`id-tache`= ? ");
          $res =$stmt->execute(array($tache_name, $id_mission, $category, $id_plangeur, $price, $qte, $status_tache, $prime, $date, $id_tache));
         if($res){
          $error = "edit success";
           header("location: editTache.php?error=$error&id-tache=$id_tache&id-mission=$id_mission");
         }else{
          $error = "not success";
          header("location: editTache.php?error=$error&id-tache=$id_tache&id-mission=$id_mission");
         }
     }
}





} //END class
