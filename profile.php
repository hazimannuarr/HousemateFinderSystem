<?php 
include 'profile_crud.php';
include 'pictureForm.php';
include 'database.php';

include_once 'session.php';
include_once 'nav_bar.php';

?>
<!DOCTYPE html>
<html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/styles.css">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<title>Profile</title>
<body style="font-family: 'Montserrat';">
  <?php
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
  ?>

  <!-- Carousel -->

<!-- <div class="gallery js-flickity"
  data-flickity-options='{ "wrapAround": true }'>
 <?php 
    for ($i=0; $i <$imagecounter-1 ; $i++) { 
       echo "<div class='gallery-cell'><img src=pictures/".$extracted[$i]."></div>";
     }
  ?>
</div> -->
<!-- carousel css-->
<style type="text/css">
 /* external css: flickity.css */

 * {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body { 
  font-family: sans-serif;
  background: url(city.jpg);
  background-size: 100% 100%;
  background-repeat: no-repeat;
  background-size: cover;
}

.gallery {
  background: white;
}

.gallery-cell {
  width: 45%;
  height: 400px;
  margin-right: 10px;
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
#profileDisplay{
  display: block;
  width: 100vw;
  height: 45vh;
  margin: 10px auto;
  border-radius: 50%; 
  object-fit: cover;
}
</style>
<br><br>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
      <div class="thumbnail" style="margin: 50px 50px 20px 50px; background-color: white; padding: 30px; border-radius: 25px;">
        <form action="profile.php" method="post" enctype="multipart/form-data">
          <?php if(!empty($msg)): ?>
            <div class="alert <?php echo $css_class;?>">
              <?php echo $msg; ?>   
            </div>
          <?php endif; ?>

          <div class="form-group text-center">
            <?php 
            $profilepicName = $uid . '.jpg';
            $path ='images/default.jpg';
            if ((file_exists('images/' . $profilepicName)) ){
              /*$profilepicName = $uid . '.jpg';
              $path ='images/' . $profilepicName;*/ 
              /*echo "<img src=". $path ." onclick=triggerClick() id=profileDisplay />";*/
              ?>
                <img src="images/<?php echo $readrow['id']; ?>.jpg" onclick="triggerClick()" id="profileDisplay" />
              <?php }
              else{ ?>
                 <img src="images/default.jpg" onclick="triggerClick()" id="profileDisplay" />
              <?php }?>
              
              <!-- /* "<img src=".$target." onclick=triggerClick() id=profileDisplay/>"*/
               /*"<'".$target."' onclick=triggerClick() id=profileDisplay />"*/ -->
               
               
               <!-- <img src="images/<?php echo $readrow['id']; ?>.jpg" onclick="triggerClick()" id="profileDisplay" /> -->


               <label for="profilepic"><strong>Profile Picture</strong></label>
               <input type="file" name="profilepic" onchange="displayPic(this)" id="profilepic" style="display: none;">

             </div>

             <input type="hidden" name="uphoto" class="form-control" id="photo" value="<?php echo $readrow['id']; ?>.jpg" required></input>


             <input type="hidden" name="id" class="form-control" id="uid" value="<?php echo $readrow['id']; ?>" readonly required></input>

             <input type="hidden" name="olduid" value="<?php echo $readrow['id']; ?>">
             <div class="form-group">
              <button type="submit" name="save-user" class="btn btn-primary btn-block">Update Picture</button>
            </div>
          </form>

          <strong>Full Name:</strong><br>
          <table width="50%">
            <tr>
              <td><?php echo $readrow['Username']; ?></td>
            </tr>
          </table><br>
          <STRONG>Email:</STRONG><br>
          <table width="50%">
            <tr>
              <td><?php echo $readrow['Email']; ?></td></tr>
            </tr>
          </table><br>
          <STRONG>User Type:</STRONG><br>
          <table width="50%">
            <tr>
              <td><?php echo $readrow['User_type']; ?></td></tr>
            </tr>
          </table><br>
          <STRONG>Gender:</STRONG><br>
          <table width="50%">
            <tr>
              <td><?php echo $readrow['fld_gender']; ?></td></tr>
            </tr>
          </table><br>
          <STRONG>Contact Number:</STRONG><br>
          <table width="50%">
            <tr>
              <td><?php echo $readrow['fld_phone']; ?></td></tr>
            </tr>
          </table><br>
          <STRONG>Created at:</STRONG><br>
          <table width="50%">
            <tr>
              <td><?php echo $readrow['created_at']; ?></td></tr>
            </tr>
          </table><br>

        </div>
      </div>
      <div class="col-sm-8">
        <div class="thumbnail" style="padding:25px; margin-top: 50px;  background-color: white; border-radius: 25px; width: 900px;">
          <strong>Edit Profile</strong><br>
          <form action="" method="post" class="form-horizontal" class="form-horizontal" enctype='multipart/form-data'>
            <div class="form-group">
              <label for="uid" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="id" class="form-control" id="uid" value="<?php echo $readrow['id']; ?>" readonly required></input>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="col-sm-3 control-label">Full Name</label>
              <div class="col-sm-9">

                <input name="username" class="form-control" id="username" value="<?php echo $readrow['Username']; ?>" required></input>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-3 control-label">Email</label>
              <div class="col-sm-9">
                <input name="email" class="form-control" id="email" value="<?php echo $readrow['Email']; ?>" required></input>
              </div>
            </div>

            <div class="form-group">
              <label for="gender" class="col-sm-3 control-label">Gender</label>
              <div class="col-sm-9">
                <!-- <input name="email" class="form-control" id="email" value="<?php echo $readrow['fld_gender']; ?>" required></input> -->
                <div class="radio-toolbar">
                  <input type="radio" id="ugender" name="gender" value="Male" <?php if($readrow['fld_gender']=="Male") echo "checked"; ?>>
                  <label for="ugender"><i class="fas fa-mars fa-2x"  style="color:lightblue;"></i><br>Male</label>

                  <input type="radio" id="ugender" name="gender" value="Female" <?php if($readrow['fld_gender']=="Female") echo "checked"; ?>>
                  <label for="ugender"><i class="fas fa-venus fa-2x"  style="color:pink;"></i><br>Female</label>

                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="phone" class="col-sm-3 control-label">Phone Number</label>
              <div class="col-sm-9">
                <input name="phone" class="form-control" id="phone" value="<?php echo $readrow['fld_phone']; ?>" required></input>
              </div>
            </div>

       <!--  <div>

        </div>
        <div class="footer" style="margin-top: 10px;">
    
        </div><br> -->
        <!-- <div class="button_section"><button type="submit" name="rent" class="main_bt" value="rent"onClick="location.href='rent.php?roomid=<?php echo $readrow['fld_room_id']; ?>'">Rent</button></div></div>
        -->

        <input type="hidden" name="olduid" value="<?php echo $readrow['id']; ?>">
        <div class="button_section">
          <button class="main_bt" style="background-color: #4BC684; border-color: #4BC684;   box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); width: 175px; "type="submit" name="update" >Update</button>
        </div>

      </form>
    </div>
  </div>
</div>


</div><br>


<!-- ------------------------------ bootstrap + css-------------------------------------------   -->


<script>
  function imgPlaceholder(){

  }
  function triggerClick(){
    document.querySelector('#profilepic').click();
  }

  function displayPic(e){
    if(e.files[0]){
      var reader = new FileReader();

      reader.onload = function(e){
        document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  }
</script>
</body>
</html>