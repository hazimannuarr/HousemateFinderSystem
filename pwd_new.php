<!DOCTYPE html>  
<html>
<head>  

  <?php include_once 'nav_bar_login.php' ?>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Reset Password</title>
  <!-- Bootstrap -->
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="boot.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <style type="text/css">
      body{ 
      font: 14px sans-serif; 
    }

  </style>

</head>  

<body style="font-family: 'Montserrat';">
  <br>  
  <div class="container" style="width: 500px; background-color: transparent;">  
    <?php  
      if(isset($message)){  
        echo '<label class="text-danger">'.$message.'</label>';  
      }  
    ?>

    <div class="container-fluid" >
      <div class="col-md-12"><div class="jumbotron" style="background-color: rgb(255,255,255,0.8); border-radius: 20px;">
        <h3 style="color: #12A3EB;">Reset Password</h3>
        <p class="text">Please enter your new password</p>
        <center>
          <?php 
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];
            
            if (isset($_GET['newpwd'])) {
              $newpwd = $_GET['newpwd'];
            }

            if(empty($selector) || empty($validator)) {
              echo "Could not validate your request!";
            } else {
              if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>
                <form action="pwd_new.inc.php" method="post">
                  <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                  <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                  <input class="form-control" style="margin-top: 10px" type="password" name="pwd" placeholder="Enter new password">
                  <input class="form-control" style="margin-top: 10px" type="password" name="repeat" placeholder="Confirm new password"><br>
                  <button style="margin-top: 10px; background-color: #019CE9;" class="btn btn-info btn-md" type="submit" name="reset_pwd">Reset Password</button>
                </form>
                <?php
              }
            }
          ?>
        </center>
      </div></div>
    </div>
  </div>
  <script type="text/javascript">
    if ($newpwd == 'empty') {
      alert("Password cannot be empty");
    } 
    else if ($newpwd == 'notsame') {
      alert("Passwords are not the same");
    }
  </script>
</body>
</html>