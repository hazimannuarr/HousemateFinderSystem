<?php 
  include_once 'database.php';

  if (isset($_POST["submit"])){
    if (!empty($_POST["search"])){
        $query = str_replace(" ","+",$_POST["search"]);
        header("location:catalogue.php?search=".$query);
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products: Catalogue</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    </style>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
   <!--  for modal popup -->
   <script>
    $(document).ready(function(){
        $(".btn").click(function(){
           var dataURL = $(this).attr( "data-href" )
            $('.modal-body').load(dataURL,function(){
        $('#myModal').modal({show:true});
        $('#myModal').on('hidden.bs.modal', function () {
          location.reload();
        })
    });
        });
    });
</script>
</head>
<body>
    <?php include_once 'nav_bar.php'; ?>
    <div class="container-fluid">
    <div class="col-md-12">
        <div class="jumbotron" style="background-color: #d2e8fe">
            <center>
                <h3> <font>Catalogue</font></h3>
            </center>
                    <form class="" action="catalogue.php" method="get">
                    <div class="row">

                    
                </form>
            </div>
            <div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
   
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Product Details</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
</div>
            <br><br>
         <div class="row">
            <?php
            $per_page = 6;
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            }else{
                $page = 1;
            }
            $start_from = ($page-1)*$per_page;

            try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM dev_room LIMIT $start_from,$per_page");
                 

                 if (isset($_GET["search"])) {
                    $sql_query = "SELECT * FROM dev_room WHERE CONCAT(`fld_room_name`, `fld_room_price`) LIKE '%".$_GET["search"]."%'";
                    
                    $stmt=$conn->prepare($sql_query);
                 } 
                 $stmt->execute();
                 $result = $stmt->fetchAll();

            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            foreach($result as $readrow) {
            ?>

            <div class>
                <div class="thumbnail" style="height:500px; position: relative;">
                	<h4><center> <?php echo $readrow['fld_room_name']; ?></center></h4>
                    <img style="float: center; width:  70%; height: 70%; object-fit: cover; "src="pictures/<?php echo $readrow['fld_room_image'] ?>" class="img-responsive" width="400px" height="400px">
                    <br>
                    <div class="caption">
                       
                        <h5 class="pull-right" style="vertical-align: bottom;"><td>RM<?php echo $readrow['fld_room_price']; ?></td></h5> 
                    </div>
                    <center>
                        <button data-href="products_details.php?pid=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-primary btn-block" role="button" style="vertical-align: bottom;position: absolute; bottom: 10px; right: 7px; width: 95%; background-color: #065eb7"> View Product </button>
                    </center>  
                </div>
            </div>
            <?php
                }
                $conn = null;
                ?>
         </div>
         <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a167556_pt2");
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
            <li><a href="catalogue.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"catalogue.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="catalogue.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
    </div>



    </html>