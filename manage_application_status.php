<!-- Code untuk update status dalam table rental app bila landlord dah pilih nak reject atau accept -->

<?php 
include_once 'db.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['AcceptApplication'])) {

          $astatus = 'accepted';
          $applicationID = $_POST['applicationid'];
           
           try {
            
               $stmt = $conn->prepare("UPDATE dev_rental_app SET fld_status = :astatus WHERE fld_application_id = :application");
              
               $stmt->bindParam(':astatus', $astatus, PDO::PARAM_STR);
               $stmt->bindParam(':application', $applicationID, PDO::PARAM_STR);
                  
                  
               $stmt->execute();
            
               header("Location: manage_application.php");
               }
            
             catch(PDOException $e)
             {
                 echo "Error: " . $e->getMessage();
             }
            

            $conn = null;
        }

        if (isset($_POST['RejectApplication'])) {

          $astatus = 'rejected';
          $applicationID = $_POST['applicationid'];
           
           try {
            
               $stmt = $conn->prepare("UPDATE dev_rental_app SET fld_status = :astatus WHERE fld_application_id = :application");
              
               $stmt->bindParam(':astatus', $astatus, PDO::PARAM_STR);
               $stmt->bindParam(':application', $applicationID, PDO::PARAM_STR);
                  
                  
               $stmt->execute();
            
               header("Location: manage_application.php");
               }
            
             catch(PDOException $e)
             {
                 echo "Error: " . $e->getMessage();
             }
            

            $conn = null;
        }

        if (isset($_POST['Reason'])) {

          $reason = $_POST['areason'];
          $applicationID = $_POST['applicationid'];
           
           try {
            
               $stmt = $conn->prepare("UPDATE dev_rental_app SET fld_reason = :reason WHERE fld_application_id = :application");
              
               $stmt->bindParam(':reason', $reason, PDO::PARAM_STR);
               $stmt->bindParam(':application', $applicationID, PDO::PARAM_STR);
                  
                  
               $stmt->execute();
            
               header("Location: manage_application.php");
               }
            
             catch(PDOException $e)
             {
                 echo "Error: " . $e->getMessage();
             }
            

            $conn = null;
        }
?>