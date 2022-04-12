<?php 
	include_once 'database.php';
	include_once 'nav_bar_login.php';


	if (isset($_POST["submit"])){
  			  if (!empty($_POST["search"])){
    		    $query = str_replace(" ","+",$_POST["search"]);
     		   header("location:list_room.php?search=".$query);
   			  }	
  			};
  ?>

<!DOCTYPE html>

<html>
<body>
<section>
	<div class="banner-main">
		<img src="images/banner.jpg">
		<div class="text-bg">
			<h1>Housemate<br><strong class="black">Finder</strong></h1>
			<h2 style="font-family: poppins; color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Fine home with Fine mate</h2>
			<div class="container">
				<form action="" method="post" class="main-form">
					<div class="row">
						<input class="form-control" type="text" name="search" value="<?php if (isset($_GET["search"])) echo $_GET["search"]; ?>" required placeholder="Search Room">
					</div>
					<div class="button_section"><button type="submit" name="submit" class="main_bt" value="search">Search</button></div>  
				</form>
			</div>
		</div>
	</div>
</section>
</div>
</body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/styles.css">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
</html>