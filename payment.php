<?php 
      include 'database.php';
      include_once 'session.php';
      include_once 'nav_bar.php';
      
 ?>
 <?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM dev_rental_app, dev_room WHERE fld_application_id = :appid AND dev_rental_app.fld_room_id = dev_room.fld_room_id");
  $stmt->bindParam(':appid', $appid, PDO::PARAM_STR);
  $appid = $_GET['appid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Deposit Payment</title>
</head>
<body style="background:url(city.jpg); background-size: cover; font-family: 'Montserrat';">
    <div class="text-bg">
      <br><br><br>
      <h1><strong>Deposit Payment</strong></h1>
      <div class="container">
        <div class="container-fluid" style="text-align: justify; padding: 20px; background-color: white; border-radius: 25px;">
         <strong>Application Details:</strong>
         <form method="post" action="checkout-charge.php">
         <table  class="table">
           <tbody >
            <tr >
              <td>Name:</td>
              <td><?php echo $name; ?><input type="hidden" name="id" value="<?php echo $uid; ?>"><input type="hidden" name="tenantName" value="<?php echo $name; ?>"></td>
            </tr>
            <tr>
              <td>Email:</td>
              <td><input type="hidden" name="email" style="width: 100%;" value="<?php echo $email; ?>"><?php echo $email; ?> </td>
            </tr>
             <tr>
               <td>Room:</td>
               <td>
                <input name="RoomID" type="hidden" value="<?php echo $readrow['fld_room_id'] ?>">
                <input type="hidden" name="landlordID" value="<?php echo $readrow['fld_landlord_id'] ?>">
                <input type="hidden" name="roomName" value="<?php echo $readrow['fld_room_name'] ?>">
                <?php echo $readrow['fld_room_name']; ?>
                </td>
             </tr>
             <tr>
               <td>Application Date:</td>
               <td><?php echo $readrow['fld_application_date'] ?></td>
             </tr>

             <tr>
               <td>Room Type:</td>
               <td><?php echo $readrow['fld_type']; ?></td>
             </tr>
             <tr>
               <td>Rent:</td>
               <td>RM <?php echo $readrow['fld_room_price']; ?>/Month</td>
             </tr>
             <tr style="font-weight: bold;">
               <td>Deposit (Total payment):</td>
               <td>RM <?php echo $readrow['fld_room_deposit']; ?></td>
             </tr>
             
             
             <input name="applicationid" type="hidden" value="<?php echo $readrow['fld_application_id'] ?>">
             <input type="hidden" name="amount" value="<?php echo $readrow['fld_room_deposit']?>">
              <input type="hidden" name="product_name" value="<?php echo $readrow['fld_room_name']?>">
           </tbody>
         </table>
         <h5 style="font-size:10px; font-style: italic;">**Rent room application will be processed within 2-3 days, please check your inbox to see your application status.**</h5>
         <div style="align-items: center; display: flex; justify-content: center;">
          <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51I2I2oLcJAnDOeJ4K2PDAxx3f3m3qaGZHOfkmGrovgm290SwlOCRrXUw8m1NSIPYM57PMFY9qetBHl60erjTidJC00d5oR8rS3"
                data-amount=<?php echo str_replace(",","",$readrow['fld_room_deposit']) * 100?>
                data-name="<?php echo $readrow['fld_room_name']?>"
                data-description="<?php echo $readrow['fld_address']?>"
                data-currency="myr"
                data-locale="auto">
                </script>
          <!-- <button type="submit" name="RentApplication" class="main_bt" value="rent" style="margin-right: 20px; width: 200px;" onclick="return Rent()"> Rent </button> -->
          <button type="reset" name="cancel" class="main_bt" value="cancel" style="width: 130px; height: 35px; border-radius: 10px; background-color: white; border-color: red; color: black; margin-left: 20px; justify-content: center; align-items: center; display: flex;" onClick="location.href='room_details.php?roomid=<?php echo $readrow['fld_room_id']; ?>'"> Cancel </button>
        </div>
       </form>
        </div>
        
    </div>
</body>
</html>
<script type="text/javascript">
  function Rent() {
    alert("Rent Application Submitted");
    location.href="search.php";
  }
</script>
<!-- ------------------------------ bootstrap + css-------------------------------------------   -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/styles.css">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
