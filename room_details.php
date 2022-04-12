<?php 
      include 'database.php';
      include_once 'session.php';
      include_once 'nav_bar.php';
 ?>
 <!DOCTYPE html>
<html>
<title>Room Details</title>
<body style="background-color: #DCEDFF; font-family: 'Montserrat';">
<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM dev_room WHERE fld_room_id = :roomid");
  $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);
  $roomid = $_GET['roomid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
  $landlordprofile = $readrow['fld_landlord'];
  $gambar = $readrow['fld_room_image'];
  $extracted = explode(",", $gambar);
  $imagecounter = count($extracted);

    $room_profile = $conn->prepare("SELECT * FROM users WHERE id = $landlordprofile");
    $room_profile->execute();
    $rp = $room_profile->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>

 <!-- Carousel -->
    <div style="margin-top: 40px;">
      <div style="text-align: center; font-size: 35px; margin-top: 10px;"><?php echo $readrow['fld_room_name']; ?></div>
      <div style="text-align: center; font-size: 25px;">Address: <?php echo $readrow['fld_address'] ?></div>
      <div style="text-align: center; font-size: 20px;">Location: <?php echo $readrow['fld_state']; ?></div>
  </div>


<div class="gallery js-flickity" style="background-color: transparent; margin: 50px 50px 50px 50px;" 
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

*:not(#nav_bar, #listername, #dropdownmenu) {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  border-radius: 35px;
}

body { 
  /*font: 14px "Montserrat", sans-serif;*/
  margin: 0px 0px 0px 0px;
  background-color: #edede8;
}

.gallery {
  background: white;
}

.gallery-cell {
  width: 40%;
  /*height: 400px;*/
  margin-right: 40px;
  /*background: #white;*/*/
  /*counter-increment: gallery-cell;*/
}
/*.gallery-cell img {
  width: 100%;
  height: auto;
  position: relative;
  /*top: 50%;*/
}*/

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
 <div class="container-fluid" style="background-color: #ABD5FF; border-radius: 20px; padding: 30px; width: 1400px;">

  <div class="row">
      <div  style="background-color: #3690E9; border-radius:15px; padding: 20px; width: 1000px; margin-left: auto; margin-right: auto; margin-top: 40px;">
      <div class="row">

          <div class="col-sm" style="width: 400px;">
          <div class="thumbnail" style="padding:10px; background-color: #ffffff; border-radius:15px;">
            <div style="text-align: center; font-size: 20px; background-color: #3690E9; border-radius:15px;">
              <strong>Rental & Deposit</strong>
            </div>

              <table style="margin-left: auto;margin-right: auto; margin-top: 10px; margin-bottom: 10px;">
                <tr >
                  <td width="60%"><strong>Rent: </strong><br>RM <?php echo $readrow['fld_room_price']; ?></td>
                  <td width="60%"><strong>Deposit: </strong><br>RM <?php echo $readrow['fld_room_deposit']; ?></td>
                </tr>
              </table>

          </div>
        </div>

          <div class="col-sm" style="width: 400px;">
          <div class="thumbnail" style="padding:10px; background-color: #ffffff; border-radius:15px;">
            <div style="text-align: center; font-size: 20px; background-color: #3690E9; border-radius:15px;">
              <strong>Accomodation</strong>
            </div>
              <table style="margin-left: auto;margin-right: auto; margin-top: 10px; margin-bottom: 10px;">
                <tr >
                  <td width="50%"><strong>Wifi: </strong><br><?php echo $readrow['fld_wifi']; ?></td>
                  <td width="50%"><strong>Furnish: </strong><br><?php echo $readrow['fld_furnish']; ?></td>
                </tr>
              </table>

          </div>
        </div>

                  <div class="col-sm" style="width: 400px;">
          <div class="thumbnail" style="padding:10px; background-color: #ffffff; border-radius:15px;">
            <div style="text-align: center; font-size: 20px; background-color: #3690E9; border-radius:15px;">
              <strong>Room Details</strong>
            </div>

              <table style="margin-left: auto;margin-right: auto; margin-top: 10px; margin-bottom: 10px;">
                <tr >
                  <td width="60%"><strong>Type: </strong><br><?php echo $readrow['fld_type']; ?></td>
                  <td width="60%"><strong>Bathroom: </strong><br><?php echo $readrow['fld_bathrooms']; ?></td>
                </tr>
              </table>

          </div>
        </div>

          <div class="col-sm" style="width: 400px;">
          <div class="thumbnail" style="padding:10px; background-color: #ffffff; border-radius:15px;">
            <div style="text-align: center; font-size: 20px; background-color: #3690E9; border-radius:15px;">
              <strong>Preferences</strong>
            </div>
              <table style="margin-left: auto;margin-right: auto; margin-top: 10px; margin-bottom: 10px;">
                <tr >
                  <td width="50%"><strong>Gender: </strong><br><?php echo $readrow['fld_gender']; ?></td>
                  <td width="50%"><!-- <strong>Furnish: </strong><br><?php echo $readrow['fld_furnish']; ?> --></td>
                </tr>
              </table>

          </div>
        </div>

      </div>
  </div>
  </div>


    <div class="row">
    <div class="col-sm-8">
      <div class="thumbnail" style="margin: 50px 50px 20px 50px; background-color: #ffffff; padding: 30px; border-radius:15px;">
      <div style="text-align: center;">
        <STRONG  style="background-color: #3690E9; border-radius:15px; text-align: center; font-size: 20px; padding: 10px; padding-right: 15px; padding-left: 15px;">Description</STRONG><br><br>
      </div>
      <?php  echo nl2br($readrow['fld_description']);?>
      <br>
      <br>
      <div style="text-align: center; font-size: 11px;">Room Posted on <?php echo $readrow['fld_room_date']; ?></div>
      
    </div>
  </div>

    <div class="col-sm-4">
      <div class="thumbnail" style="margin: 50px 50px 20px 50px; background-color: #ffffff; padding: 30px; border-radius:15px;">
        <div style="text-align: center; font-size: 20px;">
          <strong style="background-color: #3690E9; border-radius:15px; text-align: center; font-size: 20px; padding: 10px; padding-right: 15px; padding-left: 15px;">Lister Profile</strong>
        </div>
        <div class="card" id="listername">
          <?php echo $rp['Username']; ?>
        </div>
        <div class="footer" style="margin-top: 10px; margin-left: 30px;">
          <div style="font-size: 20px;">
            <strong>Contact Via Email:</strong>
          </div>
          <div style="font-size: 15px; margin-bottom: 10px;">
            <a href="mailto:<?php echo $rp['Email']; ?>"><?php echo $rp['Email']; ?></a>
          </div>
        </div>
        <div class="button_section"><?php if ($utype=='TENANT') {?>
          <button type="submit" style="background-color: #4BC684; border-color: #4BC684;   box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" name="rent" class="main_bt" value="rent"onClick="location.href='rent.php?roomid=<?php echo $readrow['fld_room_id']; ?>'">Rent</button><?php } ?>
        </div>
      </div>
    </div>
  </div>

 </div><br><br>
 
 <?php 
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("UPDATE dev_room,users SET fld_visits = fld_visits+1, visit_anon=fld_visits-visit_male-visit_female+1 WHERE fld_room_id = :roomid AND users.id = $uid AND users.fld_gender=''");
  $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);
  $roomid = $_GET['roomid'];
  $stmt->execute();
  $conn = null;
  ?>
  <?php 
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("UPDATE dev_room, users SET fld_visits = fld_visits+1, visit_male = visit_male+1, visit_anon=fld_visits-visit_female-visit_male WHERE fld_room_id = :roomid AND users.id = $uid AND users.fld_gender='Male'");
  $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);
  $roomid = $_GET['roomid'];
  $stmt->execute();
  $conn = null;
  ?>
  <?php 
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("UPDATE dev_room, users SET fld_visits = fld_visits+1, visit_female = visit_female+1, visit_anon=fld_visits-visit_female-visit_male WHERE fld_room_id = :roomid AND users.id = $uid AND users.fld_gender='Female'");
  $stmt->bindParam(':roomid', $roomid, PDO::PARAM_STR);
  $roomid = $_GET['roomid'];
  $stmt->execute();
  $conn = null;
  ?>

<!-- ------------------------------ bootstrap + css-------------------------------------------   -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/styles.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>