<!-- Code untuk insert rent application ke database -->
<?php
  session_start();
  include_once 'db.php';
   
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['RentApplication'])) {
     
    include "db.php";
     
      try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
          // Prepare the SQL statement
          $stmt = $conn->prepare("INSERT INTO dev_rental_app(fld_application_id, fld_application_date, fld_status, fld_room_id, fld_tenant_id, fld_landlord_id, fld_room_name, fld_tenant_name) VALUES (:appid, :appdate, :status, :room, :uid, :landlord, :roomName, :tenant)");
         
          // Bind the parameters
          $stmt->bindParam(':appid', $appid, PDO::PARAM_STR);
          $stmt->bindParam(':appdate', $appdate, PDO::PARAM_STR);
          $stmt->bindParam(':status', $status, PDO::PARAM_STR);
          $stmt->bindParam(':room', $room, PDO::PARAM_STR);
          $stmt->bindParam(':uid', $email, PDO::PARAM_STR);
          $stmt->bindParam(':landlord', $landlord, PDO::PARAM_STR);
          $stmt->bindParam(':roomName', $roomName, PDO::PARAM_STR);
          $stmt->bindParam(':tenant', $tenant, PDO::PARAM_STR);

          // Give value to the variables
          $appid = uniqid('A', true);
          $status = "pending";
          $appdate = date("Y-m-d",time());
          $room = $_POST['RoomID'];
          $email = $_POST['id'];
          $landlord = $_POST['landlordID'];
          $roomName = $_POST['roomName'];
          $tenant = $_POST['tenantName'];
         
        $stmt->execute();
        header("Location: index.php");
          }
     
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
      }

      $conn = null;
?>

