<?php
  
    $db_server = "localhost";
    $db_user = "root"; 
    $db_pass = ""; 
    $db_name = "dbtrangsuc"; 
    $conn = mysqli_connect('localhost','root','','dbtrangsuc') or die('Kết nối thất bại');

    // try {
    //   $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    // }
    //   // Catch for failed connection to the database
    // catch(mysqli_sql_exception) {
    //   echo "<h1 class='text-danger'>kết nối thất bại!</h1>";
    // }
    // function connectdb(){   
    //     $servername = "localhost";
    //     $username = "root";
    //     $password = "";
        
        
    //     try {
    //       $conn = new PDO("mysql:host=$servername;dbname=dbtrangsuc", $username, $password);
    //     // set the PDO error mode to exception
    //       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     //  echo "Connected successfully";
    //     } catch(PDOException $e) {
    //     //  echo "Connection failed: " . $e->getMessage();
    //     }
    //    return $conn;
    // } 

    
  // $db_name = "mysql:host=localhost;dbname=dbtrangsuc";
  // $username = "root";
  // $password = "";

  // $conn = new PDO($db_name, $username, $password);

?>