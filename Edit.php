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
      $stmt = $conn->prepare("SELECT * from books WHERE id=$ID");
      $stmt->execute();
      $Record = $stmt->fetchAll();
      foreach($Record as $Record){
      $var = $Record['id'];
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<form class = "container" action="<?php echo "editable.php?query=$var" ?>"  method="post" enctype="multipart/form-data">
    <legend>EDIT BOOK:</legend>
    <div class="form-group">
      <label for="bookname">BookName:</label>
      <input type="text" name="bookName" value="<?php echo $Record['bookName']; ?>" id="bookName"><br>
    </div>
    <div class="form-group">
      <label for="authorName">authorName:</label>
      <input type="text" name="authorName"  value="<?php echo $Record['authorName']; ?>" id="authorName"><br>
    </div>
    <div class="form-group">
      <label for="Description">Description:</label>
      <textarea name="Description"  rows="8" cols="80"><?php echo $Record['description']; ?></textarea><br>
    </div>
    <div class="form-group">
      <label for="image">image:</label>
      <input type="file" id="file" name="file"><br>
    </div>
    <div class="form-group">
      <input type="submit", name="submit", value = "submit">
    </div>
</form>

<?php
  }
?>
