<?php 
      include 'database.php';
      include_once 'nav_bar_login.php';
 ?>
 <!DOCTYPE html>
<html>
<body>
<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM dev_room WHERE fld_room_id = :roomid");
  $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);
  $roomid = $_GET['roomid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
  $gambar = $readrow['fld_room_image'];
  $extracted = explode(",", $gambar);
  $imagecounter = count($extracted);
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<h1><?php echo $readrow['fld_room_name']; ?></h1>
<?php echo $readrow['fld_address'] ?><br><br>
 <!-- Carousel -->

<div class="gallery js-flickity" style="background-color: transparent;" 
  data-flickity-options='{ "freeScroll": true }'>
 <?php 
    for ($i=0; $i <$imagecounter-1 ; $i++) { 
       echo "<div class='gallery-cell'><img src=pictures/".$extracted[$i]."></div>";
     }
  ?>
</div>
 <!-- carousel css-->
 <style type="text/css">
   /* external css: flickity.css */

* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body { 
  font-family: sans-serif;
  background: linear-gradient(to bottom, white 0%, #ee580f 100%) fixed;
  margin: 0px 50px 50px 50px;
}

.gallery {
  background: white;
}

.gallery-cell {
  width: 45%;
  height: 400px;
  margin-right: 50px;
  background: #white;
  counter-increment: gallery-cell;
}

/* cell number */
.gallery-cell:before {
  display: block;
  text-align: center;
  line-height: 200px;
  font-size: 80px;
  color: white;
}
 </style>
<br><br>
 <div class="container-fluid" style="background-color: white; border-radius: 10px; padding: 10px;">
  <div class="row">
    <div class="col-sm-8">
      <div class="thumbnail" style="margin: 50px 50px 20px 50px; background-color: #E5E7E9; padding: 30px;">
      <strong>Rental & Deposit</strong><br>
      <table width="50%">
        <tr>
          <td>Rent: RM <?php echo $readrow['fld_room_price']; ?></td>
          <td>Deposit: RM <?php echo $readrow['fld_room_deposit']; ?></td></tr>
      </table><br>
      <STRONG>Preferences:</STRONG><br>
      <table width="50%">
        <tr><td>12 Month and above</td>
          <td><?php echo $readrow['fld_gender']; ?></td></tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </table><br>
      <STRONG>Room Type: </STRONG><?php echo $readrow['fld_type']; ?>
      
    </div>
  </div>
    <div class="col-sm-4">
      <div class="thumbnail" style="padding:10px; margin-top: 50px; margin-right: 50px;  background-color: #E5E7E9;">
      <strong>Lister Profile</strong><br>
      <div class="card">
       <?php echo $rp['Username']; ?>
      </div>
      <div>Room Posted on <?php echo $readrow['fld_room_date']; ?></div>
      <div class="footer" style="margin-top: 10px; margin-left: 30px;">
          <div style="font-size: 20px;">
            <strong>Contact Number/Email:</strong>
          </div>
          <div style="font-size: 15px; margin-bottom: 10px;">
            <a href="mailto:<?php echo $rp['Email']; ?>"><?php echo $rp['Email']; ?></a>
          </div>
        </div><br>
      <div class="button_section"><button type="submit" name="rent" class="main_bt" value="rent"onClick="location.href='rent.php?roomid=<?php echo $readrow['fld_room_id']; ?>'">Rent</button></div></div>
    </div>
    </div>
  <div class="row">
    <div class="col-sm-8">
      <div class="thumbnail" style="padding:20px; margin-left: 50px; margin-bottom: 50px; margin-right:50px; background-color: #E5E7E9;">
      <strong>Description</strong><br><br>
      <?php  echo nl2br($readrow['fld_description']);?>
    </div>
    </div>
  </div>

 </div><br>
 <?php 
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("UPDATE dev_room SET fld_visits = fld_visits+1, visit_anon = fld_visits-visit_male-visit_female+1 WHERE fld_room_id = :roomid");
  $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);
  $roomid = $_GET['roomid'];
  $stmt->execute();
  $conn = null;
  ?>

<!-- ------------------------------ bootstrap + css-------------------------------------------   -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/styles.css">
</body>
</html>