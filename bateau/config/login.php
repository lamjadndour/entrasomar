<?php
 require_once('dbconfig.php');

$db = new dbconfig();


class Login {
     
    function check(){
         
    global $db;

        
    
    if(isset($_POST['submit'])){
      
    
      $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
      if(empty($user) && empty($pass)){
        return $error= "remplir les champs";
      }elseif( empty($user) ){
        return $error= "Entrer votre nom d'utilisation";
    
      
    }elseif(empty($pass)){
      return $error= "Entrer votre mot de passe";
    
    }else{
    
        
    
      $stmt = $db->connection->prepare("SELECT * FROM admins WHERE username= ? AND passwords= ? ");
      $stmt->execute(array($user,$pass));
      $data = $stmt->fetch();
      $rows = $stmt->rowCount();  
   
    
      if($rows > 0){
          if($data['role'] == 'superadmin'){
              $_SESSION['admin']="admin";
            
              header('location: admin/dashboard.php');    
            }else {
              $_SESSION['user']="user";
           
              header('location: admin/dashboard.php'); 
          }    
      }else{
        return $error= "pas trouvé ";
      }
      } 
    }
    }

    






} // End class