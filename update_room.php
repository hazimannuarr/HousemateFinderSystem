
<?php

include_once 'room_crud.php';
include_once 'session.php';
include_once 'database.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$increment = $conn->prepare("SELECT max(INCREMENT) FROM dev_room ");
$increment-> execute();
$getincrement = $increment->fetchColumn();
?>

<!DOCTYPE html>
<html>
<head>

  <title>Housemate Finder System : Update existing new room</title>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js%22%3E"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js%22%3E"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js%22%3E"></script>
</head>
<style type="text/css">

 body{
  background: linear-gradient(225deg, #FFA534 0%, rgba(255, 82, 33, 0.7) 100%) fixed, url(city.jpg);
  background-size: 100% 100%;
  background-repeat: no-repeat;
  background-size: cover;
}
form{
  background-color: white;
  padding: 20px 20px 10px 10px;
  border-radius: 10px;
}
</style>
<body style="background-color: #E5E7E9 ;">
  <?php include_once 'nav_bar.php'; ?>

  <div  class="container-fluid"  >
    <div class="row" style="">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" >
        <div class="page-header">
          <h2 >Update Existing Room</h2>
        </div>
        <form action="" method="post" class="form-horizontal" class="form-horizontal" enctype='multipart/form-data'>

          <div class="form-group">
            <label for="roomid" class="col-sm-3 control-label" >ID</label>
            <div class="col-sm-9">
              <input name="rid" type="text"  class="form-control" id="roomid" readonly placeholder="Room ID" value="<?php if(isset($_GET['edit'])){ echo $editrow['fld_room_id']; } else {echo 'R';echo $getincrement+1;} ?>" >
            </div>
          </div>
          <div class="form-group">
            <label for="landlordid" class="col-sm-3 control-label" >Landlord ID</label>
            <div class="col-sm-9">
              <input name="lid" type="text"  class="form-control" id="landlordid" readonly placeholder="Landlord ID" value="<?php echo $uid; ?>" >
            </div>
          </div>

          <div class="form-group">
            <label for="roomname" class="col-sm-3 control-label" >Name</label>
            <div class="col-sm-9">
              <input name="rname" type="text" class="form-control" id="roomname" placeholder="Room Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_room_name']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="roomtype" class="col-sm-3 control-label" >Room Type</label>
            <div class="col-sm-9">
              <select name="rtype" class="form-control" id="roomtype" required>
                <option value="">Please select</option>
                <option value="Single" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="Single") echo "selected"; ?>>Single</option>
                <option value="Double" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="Double") echo "selected"; ?>>Double</option>
                <option value="Medium" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="Medium") echo "selected"; ?>>Medium</option>
                <option value="Master Bedroom" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="Master Bedroom") echo "selected"; ?>>Master Bedroom</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="roomprice" class="col-sm-3 control-label" >Price</label>
            <div class="col-sm-9">
              <input name="rprice" type="text" oninput="displayDeposit(this.value)" class="form-control" pattern="[0-9]+([\.][0-9]{0,2})?" title="Only numbers allowed" id="roomprice" placeholder="Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_room_price']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="roomaddress" class="col-sm-3 control-label">Address</label>
            <div class="col-sm-9">
              <textarea name="raddress" cols="50" rows="3" class="form-control" id="roomaddress" placeholder="Insert your address"required><?php if(isset($_GET['edit'])) echo $editrow['fld_address']; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="roomstate" class="col-sm-3 control-label">State</label>
            <div class="col-sm-9">
              <!-- <input name="rstate" cols="50" rows="3" class="form-control" id="roomstate" placeholder="State" oninput="this.value = this.value.toUpperCase();" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_state']; ?>" required></input> -->
              <select name="rstate" class="form-control" id="roombathroom" required>
                <!-- <option value="">Please select</option> -->
                <option value="JOHOR" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="JOHOR") echo "selected"; ?>>JOHOR </option>
                <option value="KEDAH" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="KEDAH") echo "selected"; ?>>KEDAH </option>
                <option value="KELANTAN" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="KELANTAN") echo "selected"; ?>>KELANTAN </option>
                <option value="MELAKA" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="MELAKA") echo "selected"; ?>>MELAKA </option>
                <option value="NEGERI SEMBILAN" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="NEGERI SEMBILAN") echo "selected"; ?>>NEGERI SEMBILAN </option>
                <option value="PAHANG" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="PAHANG") echo "selected"; ?>>PAHANG </option>
                <option value="PULAU PINANG" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="PULAU PINANG") echo "selected"; ?>>PULAU PINANG </option>
                <option value="PERAK" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="PERAK") echo "selected"; ?>>PERAK </option>
                <option value="PERLIS" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="PERLIS") echo "selected"; ?>>PERLIS </option>
                <option value="TERENGGANU" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="TERENGGANU") echo "selected"; ?>>TERENGGANU </option>
                <option value="SABAH" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="SABAH") echo "selected"; ?>>SABAH </option>
                <option value="SARAWAK" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="SARAWAK") echo "selected"; ?>>SARAWAK </option>
                <option value="KUALA LUMPUR" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="KUALA LUMPUR") echo "selected"; ?>>KUALA LUMPUR </option>
                <option value="SELANGOR" <?php if(isset($_GET['edit'])) if($editrow['fld_state']=="SELANGOR") echo "selected"; ?>>SELANGOR </option>
                
                
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="roombathroom" class="col-sm-3 control-label" >Number of bathroom</label>
            <div class="col-sm-9">
              <select name="rbathroom" class="form-control" id="roombathroom" required>
                <option value="">Please select</option>
                <option value="1" <?php if(isset($_GET['edit'])) if($editrow['fld_bathrooms']=="1") echo "selected"; ?>>1 </option>
                <option value="2" <?php if(isset($_GET['edit'])) if($editrow['fld_bathrooms']=="2") echo "selected"; ?>>2 </option>
                <option value="3" <?php if(isset($_GET['edit'])) if($editrow['fld_bathrooms']=="3") echo "selected"; ?>>3 </option>
                <option value="4" <?php if(isset($_GET['edit'])) if($editrow['fld_bathrooms']=="4") echo "selected"; ?>>4 </option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="roomservice" class="col-sm-3 control-label" >Services</label>
            <div class="col-sm-9">
              <select name="rservice" class="form-control" id="roomservice" required>
                <option value="">Please select</option>
                <option value="Free Wifi" <?php if(isset($_GET['edit'])) if($editrow['fld_wifi']=="Free Wifi") echo "selected"; ?>>Free Wifi </option>
                <option value="No Free Wifi" <?php if(isset($_GET['edit'])) if($editrow['fld_wifi']=="No Free Wifi") echo "selected"; ?>>No Free Wifi </option>

              </select>
            </div>
          </div>


          <div class="form-group">
            <label for="roomfurnish" class="col-sm-3 control-label" >Room Furnishing</label>
            <div class="col-sm-9">
              <select name="rfurnish" class="form-control" id="roomfurnish" required>
                <option value="">Please select</option>
                <option value="Not Furnish" <?php if(isset($_GET['edit'])) if($editrow['fld_furnish']=="Not Furnish") echo "selected"; ?>>Not Furnish </option>
                <option value="Semi Furnish" <?php if(isset($_GET['edit'])) if($editrow['fld_furnish']=="Semi Furnish") echo "selected"; ?>>Semi Furnish </option>
                <option value="Fully Furnish" <?php if(isset($_GET['edit'])) if($editrow['fld_furnish']=="Fully Furnish") echo "selected"; ?>>Fully Furnish </option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="roomdesc" class="col-sm-3 control-label" >Description</label>
            <div class="col-sm-9">
              <textarea name="rdescription" cols="50" rows="8" class="form-control" id="roomdesc" placeholder="Describe your room" required><?php if(isset($_GET['edit'])) echo $editrow['fld_description']; ?></textarea>
            </div>
          </div>

          
          <div class="form-group">
            <label  class="col-sm-3 control-label">Deposit Multiplier (by Month)</label>
            <div class="col-sm-9">
              <select  class="form-control" id="depositMulti" oninput="displayDeposit(this.value)" >
                <option class="dropdown-item" value="">Please select</option>
                <option class="dropdown-item" value="1" >1 Month </option>
                <option class="dropdown-item" value="2" >2 Month </option>
                <option class="dropdown-item" value="3" >3 Month </option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" >Utilies Deposit</label>
            <div class="col-sm-9 ">
              <div class="radio-toolbar">
                <input type="radio" id="u1" name="depo" value="1" oninput="showIn()">
                <label for="u1" >Yes</label>

                <input type="radio" id="u2" name="depo" oninput="hideIn()" value="0">
                <label for="u2">No</label>

              </div>

            </div>
          </div>
          <div style="display: none;" class="form-group" id ="utiInput">
            <label for="util" class="col-sm-3 control-label" >Utilities Deposit Price</label>
            <div class="col-sm-9">
              <input name="util" type="number" class="form-control" oninput="displayDeposit()" id="util" placeholder="Utilities deposit" value="0" required>
            </div>
          </div>

          <div class="form-group">
            <label for="roomdeposit" class="col-sm-3 control-label">Deposit (RM)</label>
            <div class="col-sm-9">
              <input name="rdeposit" type="text" class="form-control" id="roomdeposit" placeholder="Enter amount" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_room_deposit']; ?>" required pattern="[0-9]+([\.][0-9]{0,2})?" title="Only numbers allowed">
            </div>
          </div>

          <script>
            function showIn(val){
              document.getElementById("utiInput").style.display = "block";
            }
            function hideIn(val){
              document.getElementById("utiInput").style.display = "none";
              document.getElementById("util").value = 0;
              var total = 0;
              var deposit = 0;
              var price = document.getElementById('roomprice').value;
              var multi = document.getElementById('depositMulti').value;
              var uti = document.getElementById('util').value;
              total = price * multi;
              deposit = parseInt(uti,10) + parseInt(total, 10);

              document.getElementById('roomdeposit').value= deposit;

            }
            function displayDeposit(val){
              var total = 0;
              var deposit = 0;
              var price = document.getElementById('roomprice').value;
              var multi = document.getElementById('depositMulti').value;
              var uti = document.getElementById('util').value;
              total = price * multi;
              deposit = parseInt(uti,10) + parseInt(total, 10);

              document.getElementById('roomdeposit').value= deposit;

            }
          </script>

          <div class="form-group">
            <label for="roomgender" class="col-sm-3 control-label" >Gender</label>
            <div class="col-sm-9">
              <input type="radio" name="rgender" value="Male"  id="roomgender" required <?php if(isset($_GET['edit'])) if($editrow['fld_gender']=="Male") echo "checked"; ?> >Male
              <input type="radio" name="rgender" value="Female"  id="roomgender" required <?php if(isset($_GET['edit'])) if($editrow['fld_gender']=="Female") echo "checked"; ?> >Female
            </div>
          </div>

          <div class="form-group">
            <label for="roomimages" class="col-sm-3 control-label" >Upload images</label>
            <div class="col-sm-9">
              <input type='file' name='files[]' id="roomimages" accept=".png,.jpg,.jpeg" class="form-control" title="Please Choose up to 3 images only" multiple  />
              <?php
              if(isset($_GET['edit'])){
                echo "<br>";
                for ($i=0; $i <$imagecounter-1 ; $i++) { 
                 echo "<img src=pictures/".$extracted[$i]." width='100' height='100'>";
                 echo " ";
               }}
               ?>
             </div>
           </div>

           <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">

             <?php if (isset($_GET['edit'])) { ?>
              <input type="hidden" name="oldcid" value="<?php echo $editrow['fld_room_id']; ?>">
              <input type="hidden" name="stat" value="1">
              <button class="btn btn-default" type="submit" name="update" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
            <?php } else { ?>
              <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
            <?php } ?>
            <button class="btn btn-default" type="reset" ><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>

          </div>
        </div>
        
      </form> 
    </div>
  </div>

</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!-- ------------------------------ bootstrap + css-------------------------------------------   -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">



</body>
</html>

<?php 

?>