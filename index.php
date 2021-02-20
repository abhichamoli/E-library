<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Booklist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="master.css" type="text/css">

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

      $stmt = $conn->prepare("SELECT * from books");
      $stmt->execute();
      $bookRecord = $stmt->fetchAll();
      echo "<table>";
      echo "<tr>";
      foreach($bookRecord as $bookRecord){
        $path = $bookRecord['imageUrl'];
        //echo "</br>";

        echo "<td>";

        echo "<img class='frame' src='uploads/bookFrame2.jpg' width = 300 height = 300 >";

        echo "<img class='img' src='uploads/$path' alt = 'no image' width = 200 height = 250  >";
        echo "<div class='name'>";
        $var = $bookRecord['id'];
        echo "<a href='bookDetails.php?id=$var'>";
        echo $bookRecord['bookName'];
        echo "</a>";
        echo "</div>";

       echo "<style>";
       echo " td {";
                echo "position: relative;";
                echo "top: 0;";
                echo "left: 0;";
              echo"}";

              echo ".frame {";
                  echo "position: relative;";
                  echo "top: 0;";
                  echo "left:0;";
                  // echo "border: 1px solid #000000;";
                echo "}";

                echo ".img {";
                  echo "position: absolute;";
                  echo "top: 20px;";
                  echo "left: 35px;";
                  // echo "align-item:center";
                  // echo "border: 1px solid #000000;";
                echo "}";
      echo "</style>";


        echo "</td>";

      }


       // echo "<img class='frame' src='uploads/bookFrame2.jpg' width = 300 height = 300 >";
       // echo "<img class='img' src='uploads/signin.png' alt = 'no image' width = 100 height = 100  >";
        echo "</tr>";
        echo "</table>";

        //echo "</br>";
        // echo $bookRecord['bookName'];
        // echo "</br>";
        // echo $bookRecord['authorName'];
        // echo "</br>";
        // echo $bookRecord['description'];
        // echo "</br>";
        // echo "</br>";

      // $stmt = $conn->prepare("SELECT imageUrl from books");
      // $stmt->execute();
      // $bookRecord = $stmt->fetchAll();
      // foreach($bookRecord as $bookRecord){
      //   $path = $bookRecord['imageUrl'];
      //   //echo "</br>";
      //   echo "<img src='uploads/$path'>";
      // }

      ?>
    </body>
</html>
