<?php 
      include 'database.php';
      include_once 'session.php';
      include_once 'nav_bar.php';
      
 ?>
 <?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM dev_room WHERE fld_room_id = :roomid");
  $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);
  $roomid = $_GET['roomid'];
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
  <title>Apply Rent</title>
</head>
<body style="background:url(city.jpg); background-size: cover; font-family: 'Montserrat';">
    <div class="text-bg">
      <br><br><br>
      <h1><strong>Rent Application Confirmation</strong></h1>
      <div class="container">
        <div class="container-fluid" style="text-align: justify; padding: 20px; background-color: white; border-radius: 25px;">
         <strong>Application Details:</strong>
         <form method="post" action="rentApplication.php">
         <table class="table">
           <tbody style="">
            <tr>
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
                <input name="RoomID" type="hidden" value="<?php echo $readrow['fld_room_id'] ?>"><input type="hidden" name="landlordID" value="<?php echo $readrow['fld_landlord'] ?>"><input type="hidden" name="roomName" value="<?php echo $readrow['fld_room_name'] ?>"><?php echo $readrow['fld_room_name']; ?>
                </td>
             </tr>
             <tr>
               <td>Address:</td>
               <td><?php echo $readrow['fld_address'] ?></td>
             </tr>
             <tr>
               <td>Room Type:</td>
               <td><?php echo $readrow['fld_type']; ?></td>
             </tr>
             <tr>
               <td>Deposit</td>
               <td>RM <?php echo $readrow['fld_room_deposit']; ?></td>
             </tr>
             <tr>
               <td>Rent</td>
               <td>RM <?php echo $readrow['fld_room_price']; ?>/Month</td>
             </tr>
           </tbody>
         </table>
         <h6 style="font-size:10px; font-style: italic;">**Rent room application will be processed within 2-3 days, please check your inbox to see your application status.**</h6>
         <div class="button_section">
          <button type="submit" name="RentApplication" class="main_bt" value="rent" style="background-color: #4BC684; border-color: #4BC684;   box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); width: 175px; margin-right: 30px;" onclick="return Rent()"> Rent </button>
          <button type="reset" name="cancel" class="main_bt" value="cancel" style="width: 175px; background-color: white; color: black; border-color: red;" onClick="location.href='room_details.php?roomid=<?php echo $readrow['fld_room_id']; ?>'"> Cancel </button>
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

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
