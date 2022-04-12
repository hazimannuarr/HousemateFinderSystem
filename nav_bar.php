<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Stackoverflow preview fix, please ignore */
    .navbar-nav {
      flex-direction: row;
    }
    
    .nav-link {
      padding-right: .5rem !important;
      padding-left: .5rem !important;
    }
    
    /* Fixes dropdown menus placed on the right side */
    .ml-auto .dropdown-menu {
      left: auto !important;
      right: 0px;
    }

    .dropdown-toggle::after { 
            content: none; 
        } 

    body {
      font: 14px "Montserrat", sans-serif;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav_bar" style="margin-bottom: 0px; height: 55px;">

   <a class="navbar-brand" href="search.php">Housemate Finder System</a>
   <div class="container-fluid">
    <div class="navbar-header" style="text-align: center;">

    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a style="margin-top: 4px;" class="nav-link" href="search.php">Home</a>
        </li>

        <li class="nav-item">
          <a style="margin-top: 4px; margin-left: 15px;" class="nav-link" href="list.php">Search Room</a>
        </li>

      <!-- <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li> -->
    </ul>

    <ul  class="navbar-nav ml-auto" style="float: right;" >
      <li class="dropdown">
        <a style="" href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php  echo $name; echo " | "; echo $utype; echo "\t"; ?> </span>
          <?php 
            $profilepicName = $uid . '.jpg';
            $path ='images/default.jpg';
            if ((file_exists('images/' . $profilepicName)) ){
              /*$profilepicName = $uid . '.jpg';
              $path ='images/' . $profilepicName;*/ 
              /*echo "<img src=". $path ." onclick=triggerClick() id=profileDisplay />";*/
              ?>
          <img alt="profile-image" class="rounded-circle" src="images/<?php echo $readrow['id']; ?>.jpg" style="width: 35px;"/>
          <?php }
              else{ ?>
                 <img src="images/default.jpg" class="rounded-circle" src="images/default.jpg" style="width: 35px;" />
              <?php }?>

           <span style="font-size: 10px" class="glyphicon glyphicon-triangle-bottom"></span> 
         <ul class="dropdown-menu" id="dropdownmenu">
          <li><a href="profile.php" class="nav-link ">Profile</a></li>
          <?php 
          if ($utype == "LANDLORD") { ?>
            <li><a href="index.php" class="nav-link">Dashboard</a></li>
            <li><a href="add_room.php" class="nav-link">Add new room</a></li>
            <li><a href="manage_application.php" class="nav-link">Rent Request</a></li>
            <li><a href="manage_asset.php" class="nav-link">Manage Asset</a></li>
          <?php }elseif ($utype == "TENANT") { ?>
            <li><a href="list.php" class="nav-link">Rent Room</a></li>
            <li><a href="index.php" class="nav-link">Application Status</a></li>
          <?php } ?>
          <li><a href="changepassword.php" class="nav-link">Change Password</a></li>
          <li><a href="logout.php" class="nav-link">Logout</a></li>
        </ul>
      </li>
    </ul>

  </div>
</div>
</nav>
</body>
</html>