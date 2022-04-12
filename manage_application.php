<?php
 include_once 'database.php';
 include_once 'session.php';
 include_once 'nav_bar.php';
 ?>
 <!DOCTYPE html>
 <html>
 <head>
  <title>Manage Application</title>
 <!--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="css/styles.css">
 -->  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</style>
 </head>
 <style>


  body{
    background:url(city.jpg);
    background-size: cover;
   }
 </style>
 <body style="font-family: 'Montserrat';" id="body">
  <div class="text-bg">
    <h1 style="margin-top: 50px; text-align: center;"><strong>Rent Application</strong></h1>
    <div class="container">
      <div class="container-fluid" style="text-align: justify; padding: 40px;">
        <table class="table" style="background-color: white; padding: 50px; border-radius: 15px;">
          <tr align="center">
            <th>No.</th>
            <th>Application Date</th>
            <th>Room</th>
            <th>Applicant Details</th>
            <th>Status</th>
            <th></th>
          </tr>

          <?php
          // Read
            $per_page = 5;
          if (isset($_GET["page"]))
            $page = $_GET["page"];
          else
            $page = 1;
          $start_from = ($page-1) * $per_page;
         
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $conn->prepare("SELECT * FROM  dev_rental_app, users WHERE dev_rental_app.fld_landlord_id = $uid AND dev_rental_app.fld_tenant_id = users.id ORDER BY fld_application_date, fld_room_name ASC LIMIT $start_from, $per_page ");
            $stmt->execute();
            $result = $stmt->fetchAll();
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $i = 1;
          foreach($result as $readrow) {
            if ($readrow['fld_status'] != 'paid'){

          ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $readrow['fld_application_date']; ?></td>
            <td style="width: 30%;"><?php echo $readrow['fld_room_name']; ?></td>
            <td style="width: 30%;">
                <strong>Name: </strong><?php echo $readrow['fld_tenant_name']; ?><br>
                <strong>Gender: </strong><?php echo $readrow['fld_gender']; ?><br>
                <strong>e-mail: </strong><?php echo $readrow['Email']; ?><br>
                <strong>Contact No: </strong><?php echo $readrow['fld_phone']; ?></td>
            <td><?php echo $readrow['fld_status']; ?></td>
            <td width="20%" align="center">
              <?php if ($readrow['fld_status']=='rejected'){ 
                if ($readrow['fld_reason']==''){?>
                <form method="post" action="manage_application_status.php">
                  <input name="applicationid" type="hidden" id="applicationid" value="<?php echo $readrow['fld_application_id']; ?>">
                  <strong>Reason: </strong><input type="placeholder" name="areason" id="areason" required focus>
                  <button class="main_bt reason" style="font-size: 12px; padding: 2px; width: 60px; background-color: transparent; color: black; margin: 2px;" name="Reason" id="Reason" type="submit" >save</button>
                </form><?php } else{ ?> <strong>Reason: </strong> <?php echo $readrow['fld_reason'];}?>
              <?php }elseif ($readrow['fld_status']=='accepted') {
                echo "";
              }
              else{ ?>
              <form method="post" action="manage_application_status.php">
              <input name="applicationid" type="hidden" id="applicationid" value="<?php echo $readrow['fld_application_id']; ?>">
              <button type="submit" class="main_bt" style="font-size: 12px; padding: 2px; width: 60px; background-color: #61DF9C; border-color: #61DF9C; margin: 2px;" name="AcceptApplication" onclick="">Accept</button>
              <button class="main_bt reject" style="font-size: 12px; padding: 2px; width: 60px; background-color: transparent; color: black; margin: 2px; border-color: red;" name="RejectApplication" id="RejectApplication" type="submit" >Reject</button>
            </form>
          <?php } ?>
            </td>
          </tr>
          <?php
          $i++;
          }
        }

          $conn = null;
          ?>
        </table>
        <nav>
        <ul class="pagination">
          <?php

          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM dev_rental_app WHERE fld_tenant_id = $uid");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>

          <?php if ($page==1) { ?>
            <li class="page-item disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li class="page-item"><a class="page-link" href="manage_application.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($y=1; $y<=$total_pages; $y++)
            if ($y == $page)
              echo "<li class=\"page-item active\"><a class=\"page-link\" href=\"manage_application.php?page=$y\">$y</a></li>";
            else
              echo "<li class=\"page-item\"><a class=\"page-link\" href=\"manage_application.php?page=$y\">$y</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="page-item disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li class="page-item"><a class="page-link" href="manage_application.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
 </body>
 </html>
<style>
  .pagination {
    color: #ee580f;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
  }

  .pagination a {
    color: #ee580f;
    float: left;
    text-decoration: none;
  }

  .pagination a:hover:not(.active) {
    color: black;
    background-color: #ee580f;
  }
</style>
