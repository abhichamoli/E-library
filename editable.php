<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$statusMsg = "";


    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      echo "Connection failed:". e->getMessage();
    }

    $bookName = $_POST['bookName'];
    $authorName = $_POST['authorName'];
    $Description= $_POST['Description'];
    $ID = $_GET['query'];


       if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
         // Allow certain file formats
         $allowTypes = array('jpg','png','jpeg','gif','pdf');
         if(in_array($fileType, $allowTypes)){
         // Upload file to server
             if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                 // Insert image file name into database
                 $sql = "UPDATE books
                         SET bookName=?, authorName=?, description=?, imageUrl=?
          		           WHERE id=?";
                         $q = $conn->prepare($sql);
                         $q->execute(array($bookName,$authorName,$Description,$fileName,$ID));
                     if($q){
                     // $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                      header("Location:index.php");
                      //echo "<script>alert('Your book has been successfully uploaded');</script>";
                 }else{
                     $statusMsg = "File upload failed, please try again.";
                 }
             }else{
                 $statusMsg = "Sorry, there was an error uploading your file.";
             }
         }else{
             $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
         }
       }

      //echo $ID.$authorName.$Description.$bookName;
?>
