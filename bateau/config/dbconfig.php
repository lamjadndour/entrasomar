<?php 
    session_start();

    class dbconfig
    {
        public $connection;

        public function __construct()
        {
            $this->db_connect();
        }
       
        public function db_connect(){


        
        $servername = "localhost";
        $username = "root";
        $password = "";

     try {
       $this->connection = new PDO("mysql:host=$servername;dbname=entrasomar2", $username, $password);
  // set the PDO error mode to exception
          $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //  echo "Connected successfully";
         } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
               }


        }



    }




?>