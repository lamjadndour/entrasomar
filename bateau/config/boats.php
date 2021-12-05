<?php



require_once('dbconfig.php');

$db = new dbconfig();


class Boat {
 
    function addBoat(){

      global $db;

      if(isset($_POST['send'])){
      
        $serie_boat = $_POST['serie_boat'];
        $id_supp = $_POST['id_supp'];
        $name_boat = $_POST['name_boat'];
        $capitane_name = $_POST['capitane_name'];
        $type = $_POST['type'];
        $capitane_phone = $_POST['capitane_phone'];
        $date = $_POST['date'];
      if(empty($serie_boat) && empty($id_supp) && empty($name_boat) && empty($capitane_name) && empty($type) && empty($capitane_phone) & empty($date) ){
      $error= "Replir toutes les champs";
      header("Location:addBoat.php?error=$error");

      }elseif( empty($serie_boat) ){
      $error= "Entrer serie de bateau";
      header("Location:addBoat.php?error=$error");
      }elseif(empty($id_supp)){
              $error= "Entrer id de mokabil";
              header("Location:addBoat.php?error=$error");

       }elseif(empty($name_boat)){
         $error= "Entrer le nom de bateau";
         header("Location:addBoat.php?error=$error");

     }elseif(empty($capitane_name)){
      $error= "Entrer le nom de capitane";
      header("Location:addBoat.php?error=$error");

     }elseif(empty($type)){
      $error= "entrer type";
      header("Location:addBoat.php?error=$error");

     }elseif(empty($capitane_phone)){
      $error= "entrer tlf de capitane";
      header("Location:addBoat.php?error=$error");

    }elseif(empty($date)){
      $error= "Entrer la date";
      header("Location:addBoat.php?error=$error");

    } else{
            
         $query = $db->connection->prepare("INSERT INTO `boat` (`id-boat`, `serie-boat`, `id-sup`, `name-boat`, `name-capitane-boat`, `type-boat`, `capitane-phone-boat`, `date`) VALUES (NULL,?,?,?,?,?,?,?)");
         $stm = $query->execute(array($serie_boat,$id_supp,$name_boat,$capitane_name,$type,$capitane_phone,$date));
         if($stm){
          $error= "success";
                header("Location:addBoat.php?error=$error");
                exit();
         }else{
          $error= "not insert success";
          header("Location:addBoat.php?error=$error");
          exit();
         } 


      }
         }
      }

   function displayAllBoats(){
      global $db;
      
      $stmt = $db->connection->prepare("SELECT * FROM boat ORDER BY `id-boat` DESC");
      $stmt->execute();
      return $data = $stmt->fetchAll();
    
    }
 

  function editBoat(){

       if(isset($_GET['id-boat'])){
        global $db;
        $id_Boat = $_GET['id-boat'];
  
       $stmt = $db->connection->prepare("SELECT * FROM boat WHERE `id-boat` = $id_Boat ");
      $stmt->execute();
      return $stmt->fetch();
   
 }
 }


  function editBoatRow(){
      global $db;
      
     if(isset($_POST['send'])){
      $serie_boat = $_POST['serie-boat'];
       $id_supp = $_POST['id-sup'];
       $name_boat = $_POST['name-boat'];
       $capitane_name = $_POST['name-capitane-boat'];
       $type = $_POST['type-boat'];
       $capitane_phone = $_POST['capitane-phone-boat'];
       $date = $_POST['date'];
       $id_boat = $_POST['id_boat'];
         $stmt = $db->connection->prepare("UPDATE `boat` SET `serie-boat`= ?,`id-sup`= ?,`name-boat`= ?,`name-capitane-boat`= ?,`type-boat`= ?,`capitane-phone-boat`= ? ,`date`= ? WHERE `boat`.`id-boat`= ? ");
          $res =$stmt->execute(array($serie_boat,$id_supp,$name_boat,$capitane_name,$type,$capitane_phone,$date,$id_boat));
         if($res){
          $error = "success";
           header("location: showBoat.php?error=$error");
         }else{
           $error = "not insert success";
           header("location: showBoat.php?error=$error");
         }
     }
}


} //END class
