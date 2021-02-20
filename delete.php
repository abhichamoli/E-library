<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";


    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      echo "Connection failed:". e->getMessage();
    }

      $ID = $_GET['query'];
      $sql = "DELETE FROM books WHERE id=$ID";

      try {
        $conn->exec($sql);
        header('location: index.php');
        echo "<script>alert('the book has been deleted successfully')</script>";

      } catch (PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
      }

 ?>
