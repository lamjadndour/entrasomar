<?php
 require_once('dbconfig.php');

$db = new dbconfig();


class Admin{


    function insertAdmins(){
        global $db;

      
$error =array();
if(isset($_POST['send'])){

 $userName = $_POST['username'];
 $passWord = $_POST['password'];
 $role = $_POST['role'];

if(empty($_POST['username']) && empty($_POST['password']) && empty($_POST['role'])){
 return $error['fill'] = "fill the fields";
}elseif( empty($_POST['username']) ){
    return $error['user'] = "Enter a username";


}elseif(empty($_POST['password'])){
    return $error['pass'] = "Enter a password";

}elseif(empty($_POST['role'])){
    return $error['pass'] = "Enter a role";
    
    }else{


        $stmt = $db->connection->prepare("INSERT INTO `admins` (`id_admin`, `username`, `passwords`, `role`) VALUES (NULL,?, ?,? )");
         $stmt->execute(array($userName,$passWord,$role));
   if($stmt){
    return $error['success'] = "insert success";
   }else{
    return $error['eroror'] = "not insert success";
   }
   
}


}

}  

     function editUserget(){
        global $db;
  if(isset($_GET['id_admin'])){
  
      $id_admin = $_GET['id_admin'];

  $stmt = $db->connection->prepare("SELECT * FROM admins WHERE id_admin= ? ");
  $stmt->execute(array($id_admin));
  return $stmt->fetch();

   
  }  
     }


         function editUserpost(){
                

  global $db;
  if(isset($_POST['send'])){
  
   $userName = $_POST['username'];
   $passWord = $_POST['password'];
   $role = $_POST['role'];
   $id=$_POST['id'];
   
  
  
  $stmt = $db->connection->prepare("UPDATE `admins` SET `username`= ?,`passwords`= ?,`role`= ? WHERE id_admin= ?");
  $stmt->execute(array($userName,$passWord,$role,$id));
  if($stmt){
      // $error['success'] = "insert success";
      header("location: showusers.php");
     }else{
        // $error = "not insert success";
     }
     
  
}
         }



     function displayadmins(){   
        global $db;

$stmt = $db->connection->prepare("SELECT * FROM admins");
  $stmt->execute();
  return $stmt->fetchAll();


     }



} //END class