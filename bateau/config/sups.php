<?php



require_once('dbconfig.php');

$db = new dbconfig();


class Suprv {
 
  function addSup(){

      global $db;

      if(isset($_POST['send'])){
      
        $name_sup = $_POST['name_sup'];
        // $id_supp = $_POST['id_supp'];
        $phone_sup = $_POST['phone_sup'];
        // $capitane_name = $_POST['capitane_name'];
        // $type = $_POST['type'];
        // $capitane_phone = $_POST['capitane_phone'];
        $date = $_POST['date'];


      if(empty($name_sup) && empty($phone_sup) & empty($date) ){
        $error= "Replir toutes les champs";
        header("Location:addSup.php?error=$error");

      }elseif( empty($name_sup) ){
        $error= "Entrer Nom de Superviseur";
        header("Location:addSup.php?error=$error");
      }elseif(empty($phone_sup)){
              $error= "Entrer Phone de Superviseur";
              header("Location:addSup.php?error=$error");

       }
    //    elseif(empty($name_boat)){
    //      $error= "Entrer le nom de bateau";
    //      header("Location:addBoat.php?error=$error");

    //  }elseif(empty($capitane_name)){
    //   $error= "Entrer le nom de capitane";
    //   header("Location:addBoat.php?error=$error");

    //  }elseif(empty($type)){
    //   $error= "entrer type";
    //   header("Location:addBoat.php?error=$error");

    //  }elseif(empty($capitane_phone)){
    //   $error= "entrer tlf de capitane";
    //   header("Location:addBoat.php?error=$error");

    // }
    elseif(empty($date)){
      $error= "Entrer la date";
      header("Location:addSup.php?error=$error");

    } else{
            
         $query = $db->connection->prepare("INSERT INTO `sup` (`id-sup`, `name-sup`, `phone-sup`, `date`) VALUES (NULL,?,?,?)");
         $stm = $query->execute(array($name_sup,$phone_sup,$date));
        // $query = $db->connection->prepare("INSERT INTO `sup` (`id-sup`, `name-sup`, `phone-sup`) VALUES (NULL,?,?)");
        // $stm = $query->execute(array($name_sup,$phone_sup));
        if($stm){
          $error= "Save it";
                header("Location:addSup.php?error=$error");
                exit();
         }else{
          $error= "not insert success";
          header("Location:addSup.php?error=$error");
          exit();
         } 


      }
      }
  }

  function displayAllSups(){
      global $db;
     
      
      $stmt = $db->connection->prepare("SELECT * FROM sup ORDER BY `id-sup` DESC");
      $stmt->execute();
      return $data = $stmt->fetchAll();
    
  }
 

  function editSup(){

       if(isset($_GET['id-sup'])){
        global $db;
        $id_Sup = $_GET['id-sup'];
  
       $stmt = $db->connection->prepare("SELECT * FROM sup WHERE `id-sup` = $id_Sup ");
      $stmt->execute();
      return $stmt->fetch();
   
 }
 }


  function editSupRow(){
      global $db;
      
     if(isset($_POST['send'])){

      // 
      $name_sup = $_POST['name-sup'];
      $phone_sup = $_POST['phone-sup'];
      $date = $_POST['date'];

      $id_sup = $_POST['id_sup'];
          $stmt = $db->connection->prepare("UPDATE `sup` SET `name-sup`= ?,`phone-sup`= ?,`date`= ? WHERE `sup`.`id-sup`= ? ");
          $res =$stmt->execute(array($name_sup,$phone_sup,$date,$id_sup));

         if($res){
            $error = "edit success";
           header("location: showSup.php?error=$error");
         }else{
          $error = "not insert success?error=$error";
         }
     }
}



} //END class
