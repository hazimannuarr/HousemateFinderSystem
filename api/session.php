 <?php
include("database.php");

session_start();


 $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $uid = $_SESSION['userId'];
  
  $stmt = $conn->prepare("SELECT * FROM users WHERE id = '$uid'");

  $stmt->execute();
  
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);

  $uid = $readrow['id'];
  $name = $readrow['Username'];
  $email= $readrow['Email'];
  $utype = $readrow['User_type'];
    
if($uid==''){
  header("location:login.php");
  }
  else {
  header("");
  }
?>