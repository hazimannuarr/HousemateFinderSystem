<?php
 include_once 'database.php';
 include_once 'session.php'; 
 include_once 'nav_bar.php';  
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <title>Housemate Finder: Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>

    .bg-1 {
      background-color: #DCEDFF;
      color: #555555;
      padding-top: 55px;
    padding-bottom: 55px;
    padding-left: 30px;
    padding-right: 30px;
  	}
  	.bg-2 {
      background-color: #ABD5FF;
      color: #555555;
      padding-top: 55px;
    padding-bottom: 55px;
    padding-left: 30px;
    padding-right: 30px;
    }
    .bg-3 {
        background-color: #ffffff; /* White */
        color: #555555;
        padding-top: 55px;
    padding-bottom: 55px;
    padding-left: 30px;
    padding-right: 30px;
  	}
/*    .container-fluid {
    padding-top: 55px;
    padding-bottom: 55px;
    padding-left: 30px;
    padding-right: 30px;
 	}*/
/* 	.navbar {
    padding-top: 15px;
    padding-bottom: 15px;
    border: 0;
    border-radius: 0;
    margin-bottom: 0;
    font-size: 14px;
    letter-spacing: 3px;
  	}*/
  	/*.bg-4 {
    background-color: #2f2f2f; #F0FFF0  
    color: #ffffff;*/
	}
	footer .glyphicon {
	    font-size: 20px;
	    margin-bottom: 20px;
	    color: #f4511e;
	}
	body {
  		font: 14px "Montserrat", sans-serif;
  		line-height: 1.8;
	}
  </style>
</head>
<body id="myPage">
 
<div class="container-fluid bg-1 text-center" id="hello">
  <h2 style="font: px">Need a Great Home & People To Stay With?</h2>
  <img src="apartments.png"  width="250px">
  <h3>Housemate Finder Are Here To Help!</h3>
</div>

<div class="container-fluid bg-2 text-center" id="who">
  <div class="row">
    <div class="col-sm-4">
      <h4>Discover amazing people</h4>
      <img src="friend.png" width="130px" class="img-responsive" alt="Image" style="display:inline;">
    </div>
    <div class="col-sm-4">
      <h4>Find a home</h4>
      <img src="home.png" width="130px" class="img-responsive" alt="Image" style="display:inline;">
    </div>
    <div class="col-sm-4">
      <h4>Great services</h4>
      <img src="cleaning.png" width="130px" class="img-responsive" alt="Image" style="display:inline; ">
    </div>
    </div>
</div>
 
<div class="container-fluid bg-3 text-center" id="where">
  <h3>Find a home?</h3>
  <a href="list.php" class="btn btn-default btn-lg">
    <span class="glyphicon glyphicon-search"></span> Find Room
  </a>
</div>

<div class="container-fluid" style="background-color: #EEF7FF" id="contact">
  <h3 class="text-center">Contact Us</h3>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and I'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> UKM, Bangi</p>
      <p><span class="glyphicon glyphicon-phone"></span> Instagram: @housematefinder</p>
      <p><span class="glyphicon glyphicon-envelope"></span> housematefinder@gmail.com</p>
    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>
 
</body>
</html>