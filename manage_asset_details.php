<!-- JANGAN DELETE! MODAL DESCRIPTION UNTUK BILIK MANAGE ASSET -->
<?php 
      include 'database.php';
      include_once 'session.php';
      include_once 'nav_bar.php';
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

<div class="gallery js-flickity" style="background-color: transparent; margin-top: 80px;" 
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
  background-color: #d8b26e;  
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
 <div class="container-fluid" style="background-color: white; border-radius: 10px; padding: 10px;  ">
  <div>
      <div style="text-align: center; font-size: 30px; margin-top: 10px;"><?php echo $readrow['fld_room_name']; ?></div>
      <div style="text-align: center; font-size: 20px;">Address: <?php echo $readrow['fld_address'] ?></div>
      <div style="text-align: center; font-size: 15px;">Location: <?php echo $readrow['fld_state']; ?></div>
  </div>
  <br>


      <div  style="background-color: grey; border-radius:15px; width: 600px; margin-left: auto; margin-right: auto; padding-bottom: 40px;">
      <div class="row">

          <div class="col-sm px-2" style="margin-left: 50px;">
          <div class="thumbnail" style="padding:10px; margin-top: 50px; margin-right: 50px;  background-color: #E5E7E9; border-radius:15px;">
            <div style="text-align: center; font-size: 20px; background-color: #D4AF37; border-radius:15px;">
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

          <div class="col-sm px-2">
          <div class="thumbnail" style="padding:10px; margin-top: 50px; margin-right: 50px;  background-color: #E5E7E9; border-radius:15px;">
            <div style="text-align: center; font-size: 20px; background-color: #D4AF37; border-radius:15px;">
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

      </div>

      <div class="row" >

          <div class="col-sm" style="margin-left: 50px;">
          <div class="thumbnail" style="padding:10px; margin-top: 50px; margin-right: 50px;  background-color: #E5E7E9; border-radius:15px;">
            <div style="text-align: center; font-size: 20px; background-color: #D4AF37; border-radius:15px;">
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

          <div class="col-sm">
          <div class="thumbnail" style="padding:10px; margin-top: 50px; margin-right: 50px;  background-color: #E5E7E9; border-radius:15px;">
            <div style="text-align: center; font-size: 20px; background-color: #D4AF37; border-radius:15px;">
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
<br>
  <div class="row">
    <div class="col-sm">
      <div class="thumbnail" style="padding:20px; margin-left: 50px; margin-bottom: 50px; margin-right:50px; border-radius:15px;background-color: #E5E7E9;">
      <div style="text-align: center;">
        <STRONG  style="background-color: #D4AF37; border-radius:15px; text-align: center; font-size: 15px; padding: 5px; padding-right: 10px; padding-left: 10px;">Description</STRONG><br><br>
      </div>
      <?php  echo nl2br($readrow['fld_description']);?>
      <br>
      <br>
      <div style="text-align: center; font-size: 11px;">Room Posted on <?php echo $readrow['fld_room_date']; ?></div>
    </div>
    </div>
  </div>

 </div><br>
 

<!-- ------------------------------ bootstrap + css-------------------------------------------   -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/styles.css">
</body>
</html>