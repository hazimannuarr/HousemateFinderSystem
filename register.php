<?php  
session_start();

include("database.php");

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['register_submit'])) {

    try{
             $stmt = $conn->prepare("INSERT INTO users(Username, Email, Password, User_type) VALUES(:username, :email, :pswd, :utype)");


                            
            $stmt->bindParam(':username', $uname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':pswd', $hash_pass, PDO::PARAM_STR);
            $stmt->bindParam(':utype', $utype, PDO::PARAM_STR);

            

            $uname=strtoupper($_POST['username']);
            $email=$_POST['email'];
            $hash_pass= password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $passvalidate = $_POST['pass'];
            $confirm_pass = $_POST['conpass'];
            $utype = $_POST['usrlvl'];
             
            $uppercase = preg_match('@[A-Z]@', $passvalidate);
            $lowercase = preg_match('@[a-z]@', $passvalidate);
            $number    = preg_match('@[0-9]@', $passvalidate);

            $emailcheck = $conn->prepare( "SELECT 1 FROM `users` WHERE `Email` = ?");
            $emailcheck->execute([$email]);
            $found = $emailcheck->fetchColumn();

            if( !$found ) {


            {
                if($passvalidate == $confirm_pass){

                        $stmt->execute();
                        echo "<script>
                                  alert('Account created!');
                                  window.location.href='login.php';
                              </script>";
                              
                     }

                 else{
                    $resulterrorlevel="<div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning!</strong> The password entered not same.</div>" ;
                    echo $resulterrorlevel; 
                 }

            }
            }

            else{
                $resulterrorlevel="<div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning!</strong> Email already exist.</div>" ;
                echo $resulterrorlevel;
            }


    }//try end


    catch(PDOException $e)
      {
          echo "Error: " . $e->getMessage();
      }

} //isset end



$conn = null; 
?>



<!DOCTYPE html>
<html>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
  <link rel="stylesheet" type="text/css" href="boot.css">
  <style type="text/css">
    body{ 
      font: 14px sans-serif; 
    }
    .wrapper{
     width: 350px; padding: 20px; 
    }
    .container{
      margin-top: -150px;
      padding: 50px;
    }
    #login{
      margin-top: -20px;
    }
  </style>

<head>
   <?php include_once 'nav_bar_login.php'?>
   <title>Register New Account</title>
</head>


<body style="font-family: 'Montserrat';">
        <div id="login" style="">
        <h2 class="text-center text-white pt-5" style="text-shadow: 0px 1px 0px #000000">Housemate Finder System</h2>
        <div class="container" >
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6" >
                    <div id="login-box" class="col-md-12" style="height: min-content;">
                        <div class="wrapper" style=" width: 100%;">
                            <h2 style="color: #12A3EB;">Create New Account</h2>
                            <p>Please fill this form to create an account.</p>

                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" placeholder="example@example.com" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email entered is not valid">
                                </div>

                                <div class="form-group">
                                    <label for="us">Name</label>
                                    <input type="text" name="username" class="form-control" id="us" placeholder="Enter your name" required>
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Password</label>
                                    <input type="password" name="pass" class="form-control" id="pwd" placeholder="Enter Password" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Password should be at least 8 characters in length and should include at least one upper case letter and one number." >
                                </div>

                                <div class="form-group">
                                    <label for="conpass">Confirm Password</label>
                                    <input type="password" name="conpass" id="conpass" class="form-control" placeholder="Confirm Password">
                                </div>

                                <div class="form-group">
                                    <label for="acc_type">Account Type</label>
                                        <select id="acc-type" name="usrlvl" class="form-control" required>
                                            <option value="LANDLORD">Landlord</option>
                                            <option value="TENANT">Tenant</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <input style="background-color: #019CE9;" type="submit" class="btn btn-info btn-md" name="register_submit">
                                    <input type="reset" class="btn btn-default" value="Reset">
                                </div>
                                <p>Already have an account? <a href="login.php">Login here</a>.</p>
                            </form>

                        </div>  
                    </div>
                </div>
            </div>

        </div>
<!--div class="footer-copyright text-center py-3" id="foot-bottom">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
    </div-->
    
  </div>
</body>
<!-- Footer -->
<!--footer class="page-footer font-small blue"-->

  <!-- Copyright -->
  
  <!-- Copyright -->

<!--/footer-->
<!-- Footer -->
</html>