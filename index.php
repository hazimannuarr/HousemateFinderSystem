<?php 
include_once 'db.php';
include_once 'session.php';
 ?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/> -->
</head>
<title>Index</title>
<body style="font-family:  'Montserrat';">
   <div class="grid-container">
     <div class="menu-icon">
      <i class="fas fa-bars header__menu"></i>
    </div>
     
    <header class="header">
      <div class="header__home"><a href="dash.php" style="color: black;">Housemate Finder System</a></div>
      <div class="dropdown">
        <button class="dropbtn" onclick="myFunction()"><?php  echo $name; echo " | "; echo $utype; ?>
          <?php 
            $profilepicName = $uid . '.jpg';
            $path ='images/default.jpg';
            if ((file_exists('images/' . $profilepicName)) ){
              /*$profilepicName = $uid . '.jpg';
              $path ='images/' . $profilepicName;*/ 
              /*echo "<img src=". $path ." onclick=triggerClick() id=profileDisplay />";*/
              ?>
          <img alt="profile-image" style="width: 35px; border-radius: 50%; vertical-align: middle;" src="images/<?php echo $readrow['id']; ?>.jpg" style="width: 35px;"/></a> 
          <?php }
              else{ ?>
                 <img src="images/default.jpg" style="width: 35px; border-radius: 50%; vertical-align: middle;" src="images/default.jpg" style="width: 35px;" />
              <?php }?>
          <i class="fa fa-caret-down"></i>

        </button>
        <div class="dropdown-content" id="myDropdown">
          <a href="profile.php">Profile</a>
          <?php 
            if ($utype == "LANDLORD") { ?>
              <a href="index.php">Dashboard</a>
              <a href="add_room.php">Add new room</a>
              <a href="manage_application.php">Rent Request</a>
              <a href="manage_asset.php">Manage Asset</a>
            <?php }elseif ($utype == "TENANT") { ?>
              <a href="list.php">Rent Room</a>
              <a href="#" class="nav-link">Application Status</a>
            <?php } ?>
          <a href="changepassword.php">Change Password</a>
          <a href="logout.php">Logout</a>
        </div>
        </div> 

    </header>

    <aside class="sidenav">
      <div class="sidenav__close-icon">
        <i class="fas fa-times sidenav__brand-close"></i>
      </div>
      <ul class="sidenav__list">

        <li class="sidenav__list-item"><a href="search.php">Home</a></li>
        <li class="sidenav__list-item"><a href="profile.php">Profile</a></li>
        <?php if ($utype == "TENANT"){ ?>
          <li class="sidenav__list-item"><a href="list.php">Room</a></li>
          <li class="sidenav__list-item"><a href="dash.php">Application Status</a></li>
        <?php }elseif ($utype == "LANDLORD") { ?>
          <li class="sidenav__list-item"><a href="manage_asset.php">Manage Asset</a></li>
          <li class="sidenav__list-item"><a href="manage_application.php">Rent Request</a></li>
          
        <?php } ?>
        
      </ul>
    </aside>

    <?php if ($utype == "LANDLORD"){ ?>
    <main class="main">

            <div class="main-overview1" style=" height: 350px; ">
        <div class="card" style=" height: fit-content; background-color:padding: 10px;">
          <?php
          try {
            /* Establish the database connection */
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /* select all the weekly tasks from the table googlechart */
            $result = $conn->query("SELECT fld_room_name, fld_visits FROM dev_room WHERE fld_landlord = $uid");
            $rows = array();
            $table = array();
            $table['cols'] = array(

              array('label' => 'Room', 'type' => 'string'),
              array('label' => 'Visit', 'type' => 'number'),

          );
              /* Extract the information from $result */
              foreach($result as $r) {

                $temp = array();

                // the following line will be used to slice the Pie chart

                $temp[] = array('v' => (string) $r['fld_room_name']); 

                // Values of each slice

                $temp[] = array('v' => (int) $r['fld_visits']); 
                $rows[] = array('c' => $temp);
              }

          $table['rows'] = $rows;

          // convert data into JSON format
          $jsonTable = json_encode($table);
          //echo $jsonTable;
          } catch(PDOException $e) {
              echo 'ERROR: ' . $e->getMessage();
          }
          $conn = null;
          ?>
              <!--Load the Ajax API-->
              <script type="text/javascript" src="https://www.google.com/jsapi"></script>
              <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
              <script type="text/javascript">

              // Load the Visualization API and the piechart package.
              google.load('visualization', '1', {'packages':['corechart']});

              // Set a callback to run when the Google Visualization API is loaded.
              google.setOnLoadCallback(drawChart);

              function drawChart() {

                // Create our data table out of JSON data loaded from server.
                var data = new google.visualization.DataTable(<?=$jsonTable?>);
                var options = {
                     title: 'Total Visits for Registered Room',
                    is3D: 'true',
                    width: 1240,
                    height: 350,
                    animation: {
          duration: 1000,
          easing: 'out',
          startup: true
      }
                  };
                // Instantiate and draw our chart, passing in some options.
                // Do not forget to check your div ID
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
              }
              </script>
          <div id="chart_div"></div>
        </div>
      </div>

      <div class="main-overview" style="height: 350px;">

        <!-- room visit by gender -->

        <div class="card"style="background-color: white; padding: 10px; height: 300px;">
        <div id="chart-container">
          <canvas id="bar-chartcanvas"></canvas>
        </div>
        
        <script src="js/bar.js"></script>
        </div>

        <!-- table popular room -->
        <div class="card" style=" background-color: white;  padding: 10px; height: 300px;">
          Top 3 Popular Room<br>
          <table class="table table-striped table-bordered" >
            <tr align="center">
            <th>Bil</th>
            <th>Room</th>
            <th>Rent Inquiry</th>
            <th>Total Visits</th>
            </tr>
            <tr>
              <?php 
              try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT *, count(dev_rental_app.fld_status) as status, dev_room.fld_visits as visit FROM  dev_rental_app, dev_room WHERE dev_rental_app.fld_landlord_id = $uid AND dev_room.fld_landlord = dev_rental_app.fld_landlord_id AND dev_rental_app.fld_room_id = dev_room.fld_room_id GROUP BY dev_room.fld_room_name ORDER BY visit DESC, status DESC LIMIT 3");
                $stmt->execute();
                $result = $stmt->fetchAll();
              }
              catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
              }
              $i=1;
              foreach($result as $readrow) {
              ?>
              <td align="center"><?php echo $i; ?></td>
              <td style="width: 60%;"><?php echo $readrow['fld_room_name']; ?></td>
              <td><?php echo $readrow['status']; ?></td>
              <td><?php echo $readrow['visit']; ?></td>
            </tr>
            <?php
            $i++;
            }
            $conn=null; 
            ?>
          </table>
          <style>
          table {
            border-collapse: collapse;
            width: 100%;
          }

          table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
          }
          </style>
        </div>

      </div>

      <div class="main-overview" style="margin-top: -20px;">
        <div class="overviewcard">
          <div class="overviewcard__icon">Most Popular Room:</div>
          <div class="overviewcard__info">
           <?php 
           $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $stmt = $conn->prepare("SELECT fld_room_name FROM dev_room 
             WHERE fld_visits IN (SELECT MAX(fld_visits) FROM dev_room WHERE fld_landlord LIKE $uid) AND fld_landlord = $uid");
           $stmt->execute();
           while ($room = $stmt->fetch(PDO::FETCH_ASSOC)){
             echo $room['fld_room_name'];
           }
           $conn = null;
           ?>
          </div>
        </div>
        <div class="overviewcard">
          <div class="overviewcard__icon">Popular Room Visitors:</div>
          <div class="overviewcard__info">
            <?php 
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT MAX(fld_visits) FROM dev_room WHERE fld_landlord LIKE $uid");
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_NUM);
              echo $result = $total[0];
            
            $conn = null;
            ?>
          </div>
        </div>
      </div>

      <div class="main-overview">
        <div class="overviewcard">
          <div class="overviewcard__icon">Total Visits</div>
          <div class="overviewcard__info">
            <?php 
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT SUM(fld_visits) FROM dev_room WHERE fld_landlord LIKE $uid");
            $stmt->execute();
            $visitor = $stmt->fetch(PDO::FETCH_NUM);

            echo $visit = $visitor[0];
            $conn = null;
            ?>
          </div>
        </div>
        <div class="overviewcard">
          <div class="overviewcard__icon">Registered Room</div>
          <div class="overviewcard__info">
            <?php 
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $conn->prepare("SELECT * FROM dev_room WHERE fld_landlord LIKE $uid");
              $stmt->execute();
              $result = $stmt->rowCount();

              echo $result;
              $conn = null;
            ?>
          </div>
        </div>
        <div class="overviewcard">
          <div class="overviewcard__icon">Rent Request</div>
          <div class="overviewcard__info">
            <?php 
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM dev_rental_app WHERE fld_status ='pending' AND fld_landlord_id LIKE $uid");
            $stmt->execute();
            $request = $stmt->rowCount();

            echo $request;
            $conn = null;
            ?>
          </div>
        </div>
        <div class="overviewcard">
          <div class="overviewcard__icon">Rented Room</div>
          <div class="overviewcard__info">
            <?php 
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM dev_rental_app WHERE fld_status ='paid' AND fld_landlord_id LIKE $uid");
            $stmt->execute();
            $request = $stmt->rowCount();

            echo $request;
            $conn = null;
            ?>
          </div>
        </div>
      </div>
      	
        <!-- <div id="chart-container">
          <canvas id="mycanvas"></canvas>
        </div> -->
      	</div>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/Chart.min.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
      	

    </main>
  <?php }elseif ($utype == "TENANT") {?>
    <main class="main">
          <div class="text" style="margin-top: 30px; font-size: 20px;">
            <center><strong>Rent Application Status</strong></center>
          </div>
          <style>
          table {
            border-spacing: 0;
            border-collapse: collapse;
            border-style: hidden;
            width:100%;
            max-width: 100%;
           /* border-collapse: collapse;
            width: 100%;
            border-radius: 20px;*/
          }

          table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
            /*border-radius: 20px;*/
          }

          table tr:nth-child(even){background-color: #f2f2f2;}

          table tr:hover {background-color: #ddd;}

          table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #ABD5FF;
            color: black;
          }

          .wrapper {
            overflow: auto;
            border-radius: 15px;
            border: 2px solid #ABD5FF;
          }

          .someselector {
            all: initial;
            * {
              all: unset;
            }
          }

          </style>
          <div class="wrapper" style="margin: 50px 75px 40px 75px; align-content: center;">
            <table>
              <tr align="center">
                <th>No.</th>
                <th>Application Date</th>
                <th>Room Name</th>
                <th>Status</th>
              </tr>
              <?php
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM dev_rental_app WHERE fld_tenant_id LIKE $uid");
                $stmt->execute();
                $result = $stmt->fetchAll();
              }
              catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
              }
              $i = 1;
              foreach($result as $readrow) {
              ?>

              <input type="hidden" name="amount" value="<?php echo $readrow['fld_room_id']?>">
              <tr>
                <td style="text-align: center;"><?php echo $i ?></td>
                <td style="text-align: center;"><?php echo $readrow['fld_application_date']; ?></td>
                <td><?php echo $readrow['fld_room_name']; ?></td>
                <td><?php if ($readrow['fld_status'] == "accepted"){
                  echo "<span style='border: 2px solid #509DEB; background-color: #509DEB; border-radius: 10px; padding: 3px; font-weight: bold; margin-bottom: 3px;'>" . $readrow['fld_status']," :"; 
                  $url = "payment.php?appid=".$readrow['fld_application_id']; ?>
                   
                  <input type="button" style="border-radius: 10px;" onclick="location.href='<?php echo $url ?>';" value="Pay Now" />
                    <?php  }
                    elseif ($readrow['fld_status'] == 'rejected') {
                      echo "<p style='border: 2px solid #FF5B5B; background-color: #FF5B5B; border-radius: 10px; width: 70px; padding: 3px; font-weight: bold;'>" . $readrow['fld_status'];?><br><?php
                      echo "<h5>" . "Reason: ".$readrow['fld_reason'];
                    }elseif ($readrow['fld_status'] == 'pending'){
                      echo "<span style='border: 2px solid #FFFF79; background-color: #FFFF79; border-radius: 10px; padding: 3px; font-weight: bold; margin-bottom: 3px;'>" . $readrow['fld_status'];
                    }elseif ($readrow['fld_status'] == 'paid'){
                      echo "<span style='border: 2px solid #61DF9C; background-color: #61DF9C; border-radius: 10px; padding: 3px; font-weight: bold; margin-bottom: 3px;'>" . $readrow['fld_status'];
                    }
                    ?>
                </td>
              </tr>
              <?php
              $i++;
              }
              $conn = null;
              ?> 
            </table>
          </div>
        </main>
      <?php } ?>

    <footer class="footer">
      <center>
      <div class="footer__copyright">&copy; 2020 Housemate Finder System</div>
      </center>
    </footer>
  </div>
</body>
</html>

<style>
  body {
    margin: 0;
    padding: 0;
    color: #2B2B2B;
    font-family: 'Open Sans', Helvetica, sans-serif;
    box-sizing: border-box;
  }

  /* Assign grid instructions to our parent grid container, mobile-first (hide the sidenav) */
  .grid-container {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 50px 1fr 50px;
    grid-template-areas:
      'header'
      'main'
      'footer';
    height: 100vh;
  }

  .menu-icon {
    position: fixed; /* Needs to stay visible for all mobile scrolling */
    display: flex;
    top: 5px;
    left: 10px;
    align-items: center;
    justify-content: center;
    background-color: #DADAE3;
    border-radius: 50%;
    z-index: 1;
    cursor: pointer;
    padding: 12px;
  }

  /* Give every child element its grid name */
  .header {
    grid-area: header;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 16px;
    background-color: rgba(255, 255, 255, 0.96);
    border-bottom: solid;
    border-color: #DCDCDC;
    border-width: 0.5px;
    font-size: 20px;
  }

  .header a{
    text-decoration: none;
    color: #888888;
  }

  /* Make room for the menu icon on mobile */
  .header__search {
    margin-left: 42px;
  }

  .sidenav {
    grid-area: sidenav;
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 240px;
    position: fixed;
    overflow-y: auto;
    transform: translateX(-245px);
    transition: all .6s ease-in-out;
    z-index: 2; /* Needs to sit above the hamburger menu icon */
/*    background-image: url('images/sidebar-5.jpg');*/
    background: #9BCEFF;
  }

  .sidenav a{
    text-decoration: none;
    color: black;
  }

  .sidenav.active {
    transform: translateX(0);
  }

  .sidenav__close-icon {
    position: absolute;
    visibility: visible;
    top: 8px;
    right: 12px;
    cursor: pointer;
    font-size: 20px;
    color: #ddd;
  }

  .sidenav__list {
    padding: 0;
    margin-top: 85px;
    list-style-type: none;
  }

  .sidenav__list-item {
    padding: 20px 20px 20px 40px;
    color: #ddd;
  }

  .sidenav__list-item:hover {
    background-color: rgba(255, 255, 255, 0.2);
    cursor: pointer;
  }

  .main {
    grid-area: main;
    background-color: #F5F5F5;
  }

  .main-header {
    display: flex;
    margin: 20px;
    padding: 20px;
    background-color: #e3e4e6;
    color: slategray;
    flex-wrap: wrap;
    border-radius: 10px;
    justify-content:space-between;
    width: auto;

  }

  .main-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
    grid-auto-rows: 94px;
    grid-gap: 20px;
    margin: 20px;
  }
  .main-overview1 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
    grid-auto-rows: 94px;
    grid-gap: 20px;
    margin: 20px;
    max-height: 50%;
  }
  .overviewcard {
    color: #303030;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    background-color: #fff;
    border-radius: 1px;
    border-style:  solid;
    border-color: #DCDCDC;
    border-width: 0.5px;
  }

  .main-cards {
    margin: 20px;
  }

  .footer {
    grid-area: footer;
    display: flex;
    align-items: center;
    padding: 0 16px;
    background-color: #fff;
    color: #303030;
    font-size: 10px;
  }

  /* Non-mobile styles, 750px breakpoint */
  @media only screen and (min-width: 46.875em) {
    /* Show the sidenav */
    .grid-container {
      grid-template-columns: 240px 1fr;
      grid-template-areas:
        "sidenav header"
        "sidenav main"
        "sidenav footer";
    }

    .header__search {
      margin-left: 0;
    }

    .sidenav {
      position: relative;
      transform: translateX(0);
    }

    .sidenav__close-icon {
      visibility: hidden;
    }
  }

  /* Medium screens breakpoint (1050px) */
  @media only screen and (min-width: 65.625em) {
    /* Break out main cards into two columns */
    .main-cards {
      column-count: 2;
    }
  }

  .dropdown {
    float: left;
    overflow: hidden;
  }

  .dropdown .dropbtn {
    cursor: pointer;
    font-size: 16px;  
    border: none;
    outline: none;
    color: #888888;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
  }

  .navbar a:hover, .dropdown:hover .dropbtn, .dropbtn:focus {
    color: #FFCC99;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }

  .dropdown-content a {
    float: none;
    color: #888888;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    font-size: 16px;
  }

  .dropdown-content a:hover {
    background-color: #ddd;
  }

  .show {
    display: block;
  }

  .main_tenant {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    background-color: #fff;
    border-radius: 5px;
    margin: 30px;
    padding: 10px;
    display: flex;
    flex-wrap: wrap;
  }

  .main_tenant:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }
  * Medium screens breakpoint (1050px) */
	@media only screen and (min-width: 65.625em) {
	  /* Break out main cards into two columns */
	  .main-cards {
	    column-count: 2;
	  }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  const menuIconEl = $('.menu-icon');
  const sidenavEl = $('.sidenav');
  const sidenavCloseEl = $('.sidenav__close-icon');

  // Add and remove provided class names
  function toggleClassName(el, className) {
    if (el.hasClass(className)) {
      el.removeClass(className);
    } else {
      el.addClass(className);
    }
  }

  // Open the side nav on click
  menuIconEl.on('click', function() {
    toggleClassName(sidenavEl, 'active');
  });

  // Close the side nav on click
  sidenavCloseEl.on('click', function() {
    toggleClassName(sidenavEl, 'active');
  });
</script>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}
</script>

<script type="text/javascript">
  google.visuagoogle.visualization.PieChart
</script>