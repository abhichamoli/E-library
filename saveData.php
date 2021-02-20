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
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $bookName = $_POST['bookName'];
  $authorName = $_POST['authorName'];
  $Description= $_POST['Description'];


  if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $conn->exec("INSERT into books (bookName, authorName, description, imageUrl ) VALUES ('$bookName','$authorName','$Description','$fileName')");
            if($insert){
                // $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                 header("Location:index.php");
                 echo "<script>alert('Your book has been successfully uploaded')</script>";
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

else if(isset($_POST['submit']))
{
    $sql = "INSERT INTO books (bookName,authorName,description)
     VALUES ('$bookName','$authorName','$Description')";
     $conn->exec($sql);
     echo "New record created successfully";
}

else{
    $statusMsg = 'Please select a file to upload.';
}

echo "$statusMsg";

}catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
