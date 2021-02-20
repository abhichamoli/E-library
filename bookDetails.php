<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Booklist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="/master.css" type="text/css"> -->

    <style media="screen">

    .detail{
      border: 2px solid blue;
      margin-left: 15px;
      margin-right: 15px;
      border-radius: 20px;
      height: 400px;
    }

    #other, #de{
      padding-left: 10px;
      float:left;
      /* display:block; */
      width: 49%
    }

    #edit, #delete{
      margin-top: 20px;
      margin-left: 30px;
    }

    /* #delete{
      margin-right: 30px;
    } */

    </style>

  </head>
  <body>

    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">
        <img src="/uploads/logo.png" alt="EBOOKLIST" height="50" width="100">
      </a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="ADDform.html">ADDNEWBOOK</a></li>
    </ul>
  </div>
  </nav>

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

    $ID = $_GET['id'];
    $stmt = $conn->prepare("SELECT * from books WHERE id=$ID");
    $stmt->execute();
    $Record = $stmt->fetchAll();
    foreach($Record as $Record){
        $path = $Record['imageUrl'];
        echo "<div class='detail'>";
        echo "<div id='other'>";
        echo "<img class='img' src='uploads/$path' alt = 'no image' width = 200 height = 250  >";
        //echo "</br>";
        echo "<h1>";
        echo $Record['bookName'];
        echo "</h1>";
        //echo "</br>";
        echo "<h4>";
        echo "by  ";
        echo $Record['authorName'];
        echo "</h2>";
        //echo "</br>";
        echo "</div>";
        echo "<div id='des'>";
        echo "<h4> DESCRIPTION <h4>";
        //echo "</br>";
        echo $Record['description'];
        echo "</div>";
        echo "</div>";
        $var = $Record['id'];

        echo "<a href='Edit.php?query=$var'>";
        echo "<button id='edit' type='button' class='btn btn-primary'>Edit Book details</button>";
        echo "</a>";
        echo "<a href='delete.php?query=$var'>";
        echo "<button  id='delete' type='button' class='btn btn-danger'>Delete Book</button>";
        echo "</a>";

        // echo "</br>";
        // echo "</br>";
      }

 ?>
