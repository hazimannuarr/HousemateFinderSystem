
 <?php

session_start();

include("database.php");

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['login_submit'])) {
  
   
  try {
    $login = FALSE;
    $stmt = $conn->prepare("SELECT id, Username, Email, Password, User_type FROM users where Email = :email_login ");
   
    $stmt->bindParam(':email_login', $emailbind, PDO::PARAM_STR);

    $emailbind=$_POST['email'];
    $password= $_POST['pass'];
     
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
    if (is_array($row))
    {
      if (password_verify($password, $row['Password']))
      {
        /* The password is correct. */
        $login = TRUE;
        $_SESSION['userId'] = $row['id'];
        $_SESSION['level'] = $row['User_type']; 
        if ($row['User_type'] == "TENANT"){
          header("Location:search.php");
        }
        else
          header("Location:index.php");
        
      }

      else{
                 $_SESSION['userId'] = null; 
                $resulterrorlevel="<div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong></strong>Email and password wrong.</div>" ;
                echo $resulterrorlevel; 
      }

    }

      
      

  }

    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }

}



$conn = null; 
?>

 <!DOCTYPE html>
  <?php include_once 'nav_bar_login.php'; ?>
        <html>

        <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Housemate Finder System</title>
          <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
           <!-- Bootstrap -->
          <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
          <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
          <link rel="stylesheet" type="text/css" href="boot.css">
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
            <div class="container" >
              <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12" style="padding-top: 20px">
                        <form id="login-form" class="formA" method="post" action="">
                            <h3 style="color: #12A3EB;">Login</h3>

                            <div class="form-group">
                                <label for="us" >Email:</label><br>
                                <input type="email" name="email" id="us" class="form-control" placeholder="example@example.com" required>
                            </div>

                            <div class="form-group">
                                <label for="pwd" >Password:</label><br>
                                <input type="password" name="pass" id="pwd" class="form-control" placeholder="Enter Password" required>
                            </div>

                            <div class="form-group">
                                <a href="pwd_reset.php" style="color: #12A3EB;">Forgot your password</a><br>
                                <input style="margin-top: 10px; background-color: #019CE9;" type="submit" name="login_submit" class="btn btn-info btn-md" value="Login">
                            </div>

                            <div id="register-link" class="text-right">
                                <a href="register.php" style="color: #12A3EB;">Register here</a>
                                
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
          