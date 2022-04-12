  <?php  
    include_once 'database.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  
 
//Update
if (isset($_POST['update'])) {
   
    try {
        
            $stmt = $conn->prepare("UPDATE users SET id = :uid,
              Username = :username,
              Email = :email,
              fld_gender = :gender,
              fld_phone = :phone         
              WHERE id = :olduid");
               
            $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);            
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);          
            $stmt->bindParam(':olduid', $olduid, PDO::PARAM_STR);
                       
                    $uid = $_POST['id'];
                    
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $gender = $_POST['gender'];
                    $phone = $_POST['phone'];
                    $olduid = $_POST['olduid'];
                    
            $stmt->execute();
            echo "<script>
                      alert('Update Success!');
                      window.location.href='profile.php';
                  </script>";
               

 }
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
//UpdatePicture
if (isset($_POST['save-user'])) {
   
    try {
        
            $stmt = $conn->prepare("UPDATE users SET id = :uid,
              fld_photo = :photo
              WHERE id = :olduid");
               
            $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);            
            $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
            $stmt->bindParam(':olduid', $olduid, PDO::PARAM_STR);
                       
                    $uid = $_POST['id'];
                    $photo = $_POST['uphoto'];
                    $olduid = $_POST['olduid'];
            $stmt->execute();
            echo "<script>
                      alert('Update Success!');
                      window.location.href='profile.php';
                  </script>";
               

 }
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :uid");

   
    $stmt->bindParam('uid', $rid, PDO::PARAM_STR);
       
    $uid = $_GET['edit'];
     
    $stmt->execute();
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
      $gambar = $editrow['fld_room_image'];
      $extracted = explode(",", $gambar);
      $imagecounter = count($extracted);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

?>