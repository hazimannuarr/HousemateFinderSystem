<?php 
  include_once 'database.php';
  include 'nav_bar_login.php';
 ?>

<!DOCTYPE html>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<html>
<head>
<link rel="stylesheet" href="css/styles.css">
</head>
<body style="background: linear-gradient(to bottom, white 0%, #ee580f 100%) fixed;">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-3">
            <?php
              $per_page = 5;
            if (isset($_GET["page"]))
              $page = $_GET["page"];
            else
              $page = 1;
            $start_from = ($page-1) * $per_page;
            try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // $stmt = $conn->prepare("SELECT * FROM dev_room");

                 

                 if (isset($_GET["search"])) {
                    $sql_query = "SELECT * FROM dev_room WHERE fld_room_name LIKE '%".$_GET["search"]."%'";
                    
                    $stmt=$conn->prepare($sql_query);
                    $stmt->execute();
                     $result = $stmt->fetchAll();

                 }

                 else{
                  $stmt = $conn->prepare("SELECT * FROM (SELECT * FROM dev_room ORDER BY fld_room_date DESC) AS list_room LIMIT $start_from, $per_page");
                 $stmt->execute();
                 $result = $stmt->fetchAll();

                 }



            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            foreach($result as $readrow) {
            ?>
            <div class="card" url="room_details1.php?roomid=<?php echo $readrow['fld_room_id']; ?>" style="max-height: 350px;">
                <div class="card-horizontal" style=" padding: 10px;">
                    <img src="pictures/<?php
                    $gambar = $readrow['fld_room_image'];
                    $extracted = explode(",", $gambar);
                     echo $extracted[0];
                  ?>" style="width: 500px; height:250px;" >
                    <div class="card-body" style="padding: 10px;">
                        <h1 class="card-title"> <?php echo $readrow['fld_room_name']; ?></h1>
                        <h5><?php echo $readrow['fld_address'];?></h5>
                        <h5>RM<?php echo $readrow['fld_room_price'];?>/month</h5>
                    </div>
                </div>
            </div>
             <?php
                }
                $conn = null;
                ?>
        </div>
    </div>
</div>
<div class="pagination">
  <?php

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM dev_room");
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
    <li class="disabled"><span aria-hidden="true">«</span></li>
  <?php } else { ?>
    <li><a href="list_room.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
  <?php
  }
  for ($i=1; $i<=$total_pages; $i++)
    if ($i == $page)
      echo "<li class=\"active\"><a href=\"list_room.php?page=$i\">$i</a></li>";
    else
      echo "<li><a href=\"list_room.php?page=$i\">$i</a></li>";
  ?>
  <?php if ($page==$total_pages) { ?>
    <li class="disabled"><span aria-hidden="true">»</span></li>
  <?php } else { ?>
    <li><a href="list_room.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
  <?php } ?>
</div>
<style type="text/css">
    
.card-horizontal {
    display: flex;
    flex: 1 1 auto;
}
.pagination {
  display: inline-block;
  color: #ee580f;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.pagination a {
  color: #ee580f;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.pagination a.active {
  background-color: #ee580f;
  color: white;
}

.pagination a:hover:not(.active) {
  color: black;
  background-color: #ee580f;
}
</style>
<script type="text/javascript">
    $(".card").click(function() {
        window.location=$(this).attr("url");
    });
</script>
</body>
</html>