<?php 
      include_once 'room_crud.php';
       include_once 'session.php';
      include_once 'database.php';
 ?>

 <!DOCTYPE html>
<html>
<head>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <title>Manage Asset</title>
  <style>
    .rounded-circle{
        display: none !important;
    }
   /* html {
  height: 100%;
}
body {
  min-height: 100%;
}*/
  </style>
</head>
<body style="font-family: 'Montserrat'; background-color: #ABD5FF;">
<?php include_once 'nav_bar.php'; 
      // Read
      $per_page = 4;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;

      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM dev_room WHERE fld_landlord LIKE $uid LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt2 = $conn->prepare("SELECT * FROM dev_room WHERE fld_landlord LIKE $uid");
        $stmt2->execute();
        $result2 = $stmt2->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
?>

    <div class="row">
    <div class="col-md-10 col-md-offset-1"  >
      <div class="page-header">
          <h1 style="text-align: center;">Manage Your Asset</h1>
          <h3 style="text-align: center;">Total number of asset: <?php echo count($result2); ?></h3>
      </div>
      <table class="table table-striped table-bordered">
         <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.0.1/tailwind.min.css'><body translate="no" >

<?php      
 foreach($result as $readrow) { 
                        $gambar = $readrow['fld_room_image'];
                        $extracted = explode(",", $gambar);
                        $imageresult = $extracted[0];

  ?>
        <div class="col-sm-6 col-lg-5 col-md-5  py-6" style="">
            <div class="bg-white shadow-xl overflow-hidden md:flex" style="height: 300px; width: 500px; border-radius: 15px;">
                <div class="bg-cover bg-bottom h-56 md:h-auto md:w-56" style="background-image: url(pictures/<?php echo $imageresult; ?>)">
                </div>

                <div >
                  <br>
                    <div class="p-4 md:p-5" style="height: 200px;">
                        <div class="font-bold " style="font-size: 20px;"><?php echo $readrow['fld_room_name']; ?></div>
                        <div class="text-gray-700 " style="margin-top: 8px; margin-bottom: 5px; font-size: 15px;"><?php echo $readrow['fld_address']; ?></div>
                        <div class="text-gray-700 " style="font-size: 15px;">RM <?php echo $readrow['fld_room_price']; ?>/Month</div>
                        <div class="text-lg text-gray-700" style="font-size: 15px;">Status: <span class="text-gray-900 font-bold"><?php if($readrow['fld_status'] == 1){echo "Listed";} else{echo "Not listed";} ?></span></div>
                    </div>

                    <div class=" bg-gray-300" style="width: 380px; height: 300px;">
                        <div class="flex justify-between" style="padding:10px;">
                              <a href="manage_asset_details.php?roomid=<?php echo $readrow['fld_room_id']; ?>"><button class=" py-2 px-5 bg-orange-500 hover:bg-orange-400 font-bold text-white  rounded-lg shadow-md" style="margin-top: 10px;">Live View</button></a>

                              <a href="update_room.php?edit=<?php echo $readrow['fld_room_id']; ?>"><button class=" py-2 px-5 bg-green-600 hover:bg-green-500 font-bold text-white  rounded-lg shadow-md" style="margin-top: 10px;">Edit</button></a>
                              <a href="manage_asset.php?delete=<?php echo $readrow['fld_room_id']; ?>" ><button class=" py-2 px-5 bg-red-600 hover:bg-red-500 font-bold text-white  rounded-lg shadow-md" style="margin-top: 10px;">Delete</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      <?php
      }
      $conn = null;
      ?>

      </table>
    </div>
  </div>

<div style="text-align: center;">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM dev_room WHERE fld_landlord LIKE $uid");
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
            <li><a href="manage_asset.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"manage_asset.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"manage_asset.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="manage_asset.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>

  </div>



<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('[id*="btnModal"]').on('click',function(){
           var dataURL = $(this).attr('data-href');
         $('.modal-body').load(dataURL,function(){
            $('#myModal').modal({show:true});
         });
        });
      });
  </script>
    <!-- ------------------------------ bootstrap + css-------------------------------------------   -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css"> -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">

</body>
</html>



