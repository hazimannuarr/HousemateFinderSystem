<!DOCTYPE html>  
<html>
<head>  

  <?php include_once 'nav_bar_login.php' ?>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Forgot Password</title>
  <!-- Bootstrap -->

  <!--  -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="boot.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <style type="text/css">
      
      body{ 
          font: 14px sans-serif; 
      }
      .wrapper{
          width: 450px; 
          padding: ; 
      }
      .container{
          margin-top: -150px;
          padding: 50px;
      }
      #login{
          margin-top: 20px;
      }


  </style>

</head>  

<body style="font-family: 'Montserrat';">
           <div id="login" style="">
           <h2 class="text-center text-white pt-5" style="text-shadow: 0px 1px 0px #000000">Housemate Finder System</h2>
            <div class="container">
              <div id="login-row" class="row justify-content-center align-items-center">
               
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12" style="padding-top: 20px">
                        <form id="login-form" class="formA" method="post" action="pwd_reset.inc.php">
                            <h3 style="color: #12A3EB;">Reset Password</h3>
                             <p class="text">An e-mail will be sent to you with the instructions on how to reset your password</p>

                            <div class="form-group">
                                <label for="us" class="text-info">Email:</label><br>
                                <input type="text" name="email" id="us" class="form-control" placeholder="Enter your e-mail" required>
                            </div>

                            <div class="form-group">
                                <button style="background-color: #019CE9;" class="btn btn-info btn-md" type="submit" name="resetreq" id="resetreq">Receive Email</button>
                            </div>

                        </form>
                        <?php 
                         if(isset($_GET["reset"])) {
                          if($_GET["reset"] == "success") {
                             echo '<p class="notification">Check your email!</p>';
                            }
                           }         
                         ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>

</html>