
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

  <title>Create new room</title>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js%22%3E"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js%22%3E"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js%22%3E"></script>
</head>
<style type="text/css">
  @import url("css/styles.css");
  body{

    background: url(city.jpg);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-size: cover;
  }
  .radio-toolbar {
    margin: 10px;

  }

  .radio-toolbar input[type="radio"] {
    opacity: 0;
    position: fixed;
    width: 0;
  }

  .radio-toolbar label {
    display: inline-block;
    background-color: #ddd;
    padding: 10px 20px;
    font-family: sans-serif, Arial;
    font-size: 16px;
    border: 0px solid #444;
    border-radius: 4px;
  }

  .radio-toolbar label:hover {
    background-color: #dfd;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  .radio-toolbar input[type="radio"]:focus + label {
    border: 0px solid #444;

  }

  .radio-toolbar input[type="radio"]:checked + label {
    background-color: #bfb;
    border-color: 1px #4c4;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
  label{
    display: flex;
    flex-wrap: wrap;
    text-align: center;
  }
  .lbl-map{
    font-style: normal !important;
  }
  i{
   text-shadow: 0.1px 0.5px 4px #000000;
 }
 .tab-content{
  background-color: white;
  padding:10px 10px 10px 10px;
}

strong{
  color:black;
}

.btn-primary{
  background-color: orange;
}

#btn-tab{
  background-color: orange;
  border: 0px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.coordinates {
  background: rgba(0, 0, 0, 0.5);
  color: #fff;
  position: absolute;
  bottom: 40px;
  left: 10px;
  padding: 5px 10px;
  margin: 0;
  font-size: 11px;
  line-height: 18px;
  border-radius: 3px;
  display: none;
}

.map{
  margin: auto;
  width: 50%;
  border: 0px solid #73AD21;
  padding: 10px;
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  align-self: center;
  justify-content: center;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

#myBtn{
  border-radius: 5px;
  border: 1px solid;
  background: white;
  padding: 5px;
  margin: auto;
  position: absolute;
  top: auto;
}
</style>
<body style="background-color: #E5E7E9; font-family: 'Montserrat'">
  <?php include_once 'nav_bar.php'; ?>

  <div  class="container-fluid"  >

    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" >
      <div class="page-header">
        <h2 style="font-family: sans-serif; font-style: bold;"><strong>Create a new room</strong></h2>
      </div>

      <form action="" method="post" class="form-horizontal" class="form-horizontal" enctype='multipart/form-data'>
        <h5>Please fill all the room details</h5>
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home"><strong>Room Title</strong></a></li>
          <li><a data-toggle="tab" href="#menu1"><strong>Details</strong></a></li>
          <li><a data-toggle="tab" href="#menu2"><strong>Address</strong></a></li>
          <li><a data-toggle="tab" href="#menu3"><strong>Price</strong></a></li>

        </ul>
        <div class="tab-content">
          <br>
          <!-- tabhome  -->
          <div id="home" class="tab-pane fade in active">
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
         <!--  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
          

          <div id="map"></div>


          <script>
            function initMap() {
              const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8,
                center: { lat: -34.397, lng: 150.644 },
              });
              const geocoder = new google.maps.Geocoder();
              document.getElementById("submit").addEventListener("click", () => {
                geocodeAddress(geocoder, map);
              });
            }

            function geocodeAddress(geocoder, resultsMap) {
              const address = document.getElementById("address").value;
              geocoder.geocode({ address: address }, (results, status) => {
                if (status === "OK") {
                  resultsMap.setCenter(results[0].geometry.location);
                  new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location,
                  });
                } else {
                  alert(
                    "Geocode was not successful for the following reason: " + status
                    );
                }
              });
            }
          </script>
          <script
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAv2uw_a1UQd07oUldLn0sIAhZloLFcOWI&callback=initMap&libraries=&v=weekly"
          defer
          ></script> -->


         <!--  <div id="floating-panel">
            <input id="address" type="textbox" value="Sydney, NSW" />
            <input id="submit" type="button" value="Geocode" />
          </div>
        -->
        <!-- <div class="form-group">
          <label for="roomaddress" class="col-sm-3 control-label">Address</label>
          <div class="col-sm-9">
            <textarea name="raddress" cols="50" rows="3" class="form-control" id="roomaddress" placeholder="Insert your address"required><?php if(isset($_GET['edit'])) echo $editrow['fld_address']; ?></textarea>
          </div>
        </div> -->
       <!--  <div class="form-group">
          <label for="roomaddress" class="col-sm-3 control-label">Address</label>
          <div class="col-sm-9">
            <textarea name="raddress" cols="50" rows="3" class="form-control" id="roomaddress" placeholder="Insert your address"required></textarea>           

            <input type="city" 
            class="form-control" 
            id="inputCity" 
            placeholder="City">
            <input type="zip" 
            class="form-control" 
            id="inputZip" 
            placeholder="Postcode">

            <input type="state" name="rstate" 
            class="form-control" 
            id="inputState"  onkeyup="this.value = this.value.toUpperCase();"
            placeholder="State" style="">


          </div>
        </div> -->

        <div class="form-group">
          <label for="roomdesc" class="col-sm-3 control-label" >Description</label>
          <div class="col-sm-9">
            <textarea name="rdescription" cols="50" rows="8" class="form-control" id="roomdesc" placeholder="Describe your room" required><?php if(isset($_GET['edit'])) echo $editrow['fld_description']; ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label for="roomgender" class="col-sm-3 control-label" >Gender Preferences</label>
          <div class="col-sm-9">
            <!-- <input type="radio" name="rgender" value="Male"  id="roomgender" data-icon='' required <?php if(isset($_GET['edit'])) if($editrow['fld_gender']=="Male") echo "checked"; ?> >Male
            <i class="fas fa-mars fa-2x"></i>
            <input type="radio" name="rgender" value="Female"  id="roomgender"  data-icon='' required <?php if(isset($_GET['edit'])) if($editrow['fld_gender']=="Female") echo "checked"; ?> >Female -->
            <div class="radio-toolbar">
              <input type="radio" id="gen1" name="rgender" value="Male">

              <label for="gen1"><i class="fas fa-mars fa-2x" style="color:lightblue;"></i><br>Male</label>

              <input type="radio" id="gen2" name="rgender" value="Female">
              <label for="gen2"><i class="fas fa-venus fa-2x" style="color:pink;"></i><br>Female</label>

            </div>
          </div>

        </div>
        <a id="btn-tab" class="btn btn-primary btnNext">Next</a>
      </div>



      <!-- Menu1  -->
      <div id="menu1" class="tab-pane fade menu1">
        <br>
        <div class="form-group">
          <label for="roomtype" class="col-sm-3 control-label" >Room Type</label>
          <div class="col-sm-9 ">
              <!-- <select name="rtype" class="form-control" id="roomtype" required>
                <option value="">Please select</option>
                <option value="Single" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="Single") echo "selected"; ?>>Single</option>
                <option value="Double" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="Double") echo "selected"; ?>>Double</option>
                <option value="Medium" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="Medium") echo "selected"; ?>>Medium</option>
                <option value="Master Bedroom" <?php if(isset($_GET['edit'])) if($editrow['fld_type']=="Master Bedroom") echo "selected"; ?>>Master Bedroom</option>
              </select> -->
              <div class="radio-toolbar">
                <input type="radio" id="type1" name="rtype" value="Single" checked>
                <label for="type1">Single</label>

                <input type="radio" id="type2" name="rtype" value="Double">
                <label for="type2">Double</label>

                <input type="radio" id="type3" name="rtype" value="Medium">
                <label for="type3">Medium</label> 

                <input type="radio" id="type4" name="rtype" value="Master Bedroom">
                <label for="type4">Master Bedroom</label> 
              </div>

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
                <option value="Free Wifi" <?php if(isset($_GET['edit'])) if($editrow['fld_bathrooms']=="1") echo "selected"; ?>>Free Wifi </option>
                <option value="No Free Wifi" <?php if(isset($_GET['edit'])) if($editrow['fld_bathrooms']=="2") echo "selected"; ?>>No Free Wifi </option>

              </select>
            </div>
          </div>


          <div class="form-group" id="app-cover">
            <label for="roomfurnish" class="col-sm-3 control-label" >Room Furnishing</label>
            <div class="col-sm-9">
              <select name="rfurnish" class="form-control" id="roomfurnish" required>
                <option class="dropdown-item" value="">Please select</option>
                <option class="dropdown-item" value="Not Furnish" <?php if(isset($_GET['edit'])) if($editrow['fld_furnish']=="Not Furnish") echo "selected"; ?>>Not Furnish </option>
                <option class="dropdown-item" value="Semi Furnish" <?php if(isset($_GET['edit'])) if($editrow['fld_furnish']=="Semi Furnish") echo "selected"; ?>>Semi Furnish </option>
                <option class="dropdown-item" value="Fully Furnish" <?php if(isset($_GET['edit'])) if($editrow['fld_furnishbathrooms']=="Fully Furnish") echo "selected"; ?>>Fully Furnish </option>
              </select>
            </div>
            
          </div>

          <div class="form-group">
            <label for="roomimages" class="col-sm-3 control-label" >Upload images</label>
            <div class="col-sm-9">
              <input type='file' name='files[]' id="roomimages" accept=".png,.jpg,.jpeg" class="form-control" title="Please Choose up to 3 images only" multiple  required />
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

           <a id="btn-tab" class="btn btn-primary btnPrevious" >Previous</a>
           <a id="btn-tab" class="btn btn-primary btnNext" >Next</a>
         </div>
         <!-- Menu2  -->
         
         <div id="menu2" class="tab-pane fade menu1">
          <label class="col-sm-3 control-label">Choose your location</label>
          
          <!-- Map  -->
          <!-- Trigger/Open The Modal -->
          <div class="col-sm-9">
          <button id="myBtn">Open Map</button>
          <br>
          </div><br>

          <!-- The Modal -->
          <div id="myModal" class="modal " style="margin: auto;">

            <!-- Modal content -->
            <div class="modal-content">
              <span class="close">&times;</span>
              <h3 class="col-sm-5 control-label"><strong>Choose your location</strong></h3>
              <div class="map">
                <div id="map" style='width: 25vw; height: 35vh;' ></div> <p class="lbl-map">Please enter the keyword of your location and drag the marker for more accurate result</p>
                <pre hidden id="coordinates" class="coordinates"></pre><br>
                Address:
                <textarea name="" cols="50" rows="3" class="form-control" id="add" placeholder="Location address" readonly></textarea>
              </div>
            </div>
          </div>
          <br>

          <div class="form-group" style="visibility: hidden; position: absolute;">
            <label for="Lng" class="col-sm-3 control-label">Longitude</label>
            <div class="col-sm-9">
              <input name="rlongitude" cols="50" rows="3" class="form-control" id="Lng" readonly placeholder="Longitude"required><?php if(isset($_GET['edit'])) echo $editrow['fld_address']; ?></input>
            </div>
          </div>

          <div class="form-group" style="visibility: hidden; position: absolute;">
            <label for="Lat" class="col-sm-3 control-label">Latitude</label>
            <div class="col-sm-9">
              <input name="rlatitude" cols="50" rows="3" class="form-control" id="Lat" readonly placeholder="latitude"required><?php if(isset($_GET['edit'])) echo $editrow['fld_address']; ?></input>
            </div>
          </div>

          <div class="form-group">
            <label for="roomaddress" class="col-sm-3 control-label">Address</label>
            <div class="col-sm-9">
              <textarea name="raddress" cols="50" rows="3" class="form-control" id="add2" placeholder="Insert your address"required></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="roomaddress" class="col-sm-3 control-label">State</label>
            <div class="col-sm-9">
              <!-- <input name="rstate" cols="50" rows="3" class="form-control" id="state" placeholder="State" oninput="this.value = this.value.toUpperCase();" required></input> -->
              <select name="rstate" class="form-control" id="roombathroom" required>
                <option value="">PLEASE SELECT</option>
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
          <!-- inputs  -->
         <!--  <div id="map" style='width: 40vw; height: 40vh;' ></div>
          <pre id="coordinates" class="coordinates"></pre> -->

          <!-- <input type="text" id="Lng" name="" value="" placeholder="longitude">
            <input type="text" id="Lat" name="" value="" placeholder="laitude"> -->
            <!-- <textarea type="text" id="add" name="" value="" placeholder="address"></textarea>
              <textarea type="text" id="state" name="" value="" placeholder="address"></textarea> -->

              <a id="btn-tab" class="btn btn-primary btnPrevious" >Previous</a>
              <a id="btn-tab" class="btn btn-primary btnNext" >Next</a>
            </div>

            <!-- Menu3  -->
            <div id="menu3" class="tab-pane fade">
              <br>

              <div class="form-group">
                <label for="roomprice" class="col-sm-3 control-label" >Price (RM)</label>
                <div class="col-sm-9">
              <!-- <label class="form-label" for="customRange2">Example range</label>
              <div class="range">
                <input type="range" for="roomprice" class="form-range" min="0" max="2000" id="customRange2" />
              </div> -->
              <!-- <input type="range" class="pmd-range-tooltip" id="slider" name="rangeInput" min="0" max="10000" data-toggle="tooltip" data-placement="right" title=" RM10000" oninput="updateTextInput(this.value);"> -->
              
              <input name="rprice" type="text" class="form-control" pattern="[0-9]+([\.][0-9]{0,2})?" title="Only numbers allowed" id="roomprice" placeholder="Price" oninput="updateSliderInput(this.value)" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_room_price']; ?>" required>
              <!-- <small id="" class="form-text text-muted">Max price is RM2000</small> -->

              
            </div>
          </div>

          <div class="form-group">
            <label for="roomdeposit" class="col-sm-3 control-label">Deposit Multiplier (by Month)</label>
            <div class="col-sm-9">
              <select  class="form-control" id="depositMulti" oninput="displayDeposit(this.value)" required>
                <option class="dropdown-item" value="">Please select</option>
                <option class="dropdown-item" value="1" >1 Month </option>
                <option class="dropdown-item" value="2" >2 Month </option>
                <option class="dropdown-item" value="3" >3 Month </option>
              </select>
            </div>
          </div>

          

          

          <div class="form-group">
            <label  for="roomtype" class="col-sm-3 control-label" >Utilies Deposit</label>
            <div class="col-sm-9 ">
              <div class="radio-toolbar">
                <input type="radio" id="u1" name="depo" value="1" oninput="showIn()">
                <label for="u1">Yes</label>

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

          <div  class="form-group" >
            <label for="roomdeposit" class="col-sm-3 control-label">Deposit (RM)</label>
            <div class="col-sm-9">
              <input name="rdeposit" type="text" class="form-control" id="roomdeposit" placeholder="Enter amount" oninput="" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_room_deposit']; ?>" required pattern="[0-9]+([\.][0-9]{0,2})?" title="Only numbers allowed" readonly>
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
          </script>

          

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">

             <?php if (isset($_GET['edit'])) { ?>
              <input type="hidden" name="oldcid" value="<?php echo $editrow['fld_room_id']; ?>">

              <button class="btn btn-default" type="submit" name="update" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
            <?php } else { ?>
              <input type="hidden" name="stat" value="1">
              <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
            <?php } ?>
            <button class="btn btn-default" type="reset" ><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>

          </div>
        </div>
        
        <a id="btn-tab" class="btn btn-primary btnPrevious" >Previous</a>
      </div>











        <!-- <div id="address">
            <div class="form-group" >
              <input type="street" 
                     class="form-control" 
                     id="autocomplete" 
                     placeholder="Street">
              
              <input type="city" 
                     class="form-control" 
                     id="inputCity" 
                     placeholder="City">
              
              <input type="state" 
                     class="form-control" 
                     id="inputState" 
                     placeholder="State" style="  text-transform: uppercase;">
              
              
            </div>
          </div> -->

          


          <!--  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAv2uw_a1UQd07oUldLn0sIAhZloLFcOWI&libraries=places&callback=initAutocomplete" async defer></script> -->


          

          


          

          
        </form> 
      </div>


    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- ------------------------------ bootstrap + css-------------------------------------------   -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Scipt Popup -->
    <script>
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal 
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>
    <script>
      // function updateTextInput(val) {
      //   var total = 0;
      //   var deposit = 0;
      //   var multi = document.getElementById('depositMulti').value;
      //   var uti = document.getElementById('util').value;
      //   total = val * multi;
      //   deposit = parseInt(uti,10) + parseInt(total, 10);
      //   document.getElementById('roomprice').value=val; 
      //   document.getElementById('roomdeposit').value= deposit;
      // }
      function updateSliderInput(val) {
        var total = 0;
        var deposit = 0;
        var multi = document.getElementById('depositMulti').value;
        var uti = document.getElementById('util').value;
        total = val * multi;
        deposit = parseInt(uti,10) + parseInt(total, 10);
        document.getElementById('slider').value=val; 
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
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>

    <script>
      /**** JQuery *******/
      $('.btnNext').click(function(){
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
      });

      $('.btnPrevious').click(function(){
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
      });

    </script>
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
<!-- <script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " w3-red";
  }
</script> -->
<!-- Script Api  -->
<script src="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.css" rel="stylesheet" />
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
type="text/css"
/>
<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>


<!-- Script Api  -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>

<script>
  mapboxgl.accessToken = 'pk.eyJ1IjoicnVzeWFpZHk5OSIsImEiOiJja2preGFyczAwMDZhMnVsbXcyNWhxYm12In0.CcCMKs4kcp5_8XaCCSJKHA';
  var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [-79.4512, 43.6568],
    zoom: 13
  });

  var geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    marker: {
      color: 'orange'
    },
    mapboxgl: mapboxgl
  });

  map.addControl(geocoder); 


  geocoder.on('result', function(e) {
    console.log(e.result.center);
    geocoder.clear();
    var marker = new mapboxgl
    .Marker({ draggable: true, color: "blue" })
    .setLngLat(e.result.center)
    .addTo(map)



    function onDragEnd() {
      var lngLat = marker.getLngLat();
      coordinates.style.display = 'block';
      coordinates.innerHTML =
      'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
      var lng = lngLat.lng;
      var lat = lngLat.lat;
      document.getElementById("Lng").value =lngLat.lng ; 
      document.getElementById("Lat").value =lngLat.lat ;

      var url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'
      + lng + ',' + lat 
      + '.json?access_token=' + mapboxgl.accessToken; 
      /*window.open(url);*/


      async function getAddress(){
        const response = await fetch(url);
        const data = await response.json();
        var a = data.features[0].place_name;
        var b = data.features[2].text;
        b = b.toString().toUpperCase();
        console.log(data);
        console.log(a);
        document.getElementById("add").value =a ;
        document.getElementById("add2").value =a ;
        document.getElementById("state").value =b ;
      }

      getAddress();

    }
    marker.on('dragend', onDragEnd);

  });  

</script>

</body>
</html>

<?php 

?>