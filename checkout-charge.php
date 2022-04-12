<?php
    include 'config.php';

    $applicationid          = $_POST["applicationid"];
    $token = $_POST["stripeToken"];
    //$contact_name = $_POST["c_name"];
    $token_card_type = $_POST["stripeTokenType"];
    //$phone           = $_POST["phone"];
    //$email           = $_POST["stripeEmail"];
    //$address         = $_POST["address"];
    $amount          = $_POST["amount"]; 
    $desc            = $_POST["product_name"];
    $roomid = $_POST["RoomID"];
    $charge = \Stripe\Charge::create([
      "amount" => str_replace(",","",$amount) * 100,
      "currency" => 'myr',
      "description"=>$desc,
      "source"=> $token,
    ]);

      session_start();
  include_once 'db.php';
   
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


     
    include "db.php";
     
      try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
          // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE dev_rental_app SET fld_status = 'paid' WHERE fld_application_id = '$applicationid'");
        $stmt->execute();

        $stmt2 = $conn->prepare("UPDATE dev_room SET fld_status = '0' WHERE fld_room_id = '$roomid'");
        $stmt2->execute();


          }
     
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
      

      $conn = null;

    if($charge){
      header("Location:success.php?amount=$amount");
    }


?>