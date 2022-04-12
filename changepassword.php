<?php
      include 'database.php';
      include_once 'session.php';
      include_once 'nav_bar.php';

if (isset($_POST['submit'])){
try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select Password from users where id= $uid");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);


         if (password_verify($_POST['currentPassword'], $row['Password'])) {
        // mysqli_query($conn, "UPDATE tbl_staffs_a168209_pt2 set Password='" . $_POST["newPassword"] . "' WHERE Username='" . $_SESSION["userId"] . "'");
        // $message = "Password Changed";


         	$stmt = $conn->prepare("UPDATE users SET Password = :pswd where id = $uid");
         	$stmt->bindParam(':pswd', $password, PDO::PARAM_STR);
         	$password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
         	$stmt->execute();
         	echo $resultsuccess="<div class='alert alert-success alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong></strong>Password Changed Successfully</div>" ;
	    } else

	       echo $resulterrormatch="<div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong></strong> Current password entered is Incorrect</div>" ;

      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
} 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Change Password</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
	<script>
    function validatePassword() {
    var currentPassword,newPassword,confirmPassword,output = true;

    currentPassword = document.frmChange.currentPassword;
    newPassword = document.frmChange.newPassword;
    confirmPassword = document.frmChange.confirmPassword;

    if(!currentPassword.value) {
      currentPassword.focus();
      // document.getElementById("currentPassword").innerHTML = "Please enter current password";
      window.alert("Please enter current password");
      output = false;
    }
    else if(!newPassword.value) {
      newPassword.focus();
      // document.getElementById("newPassword").innerHTML = "Please enter new password";
      window.alert("Please enter new password");
      output = false;
    }
    else if(!confirmPassword.value) {
      confirmPassword.focus();
      // document.getElementById("confirmPassword").innerHTML = "Retype new password";
      window.alert("Retype new password");
      output = false;
    }
    if(newPassword.value != confirmPassword.value) {
      newPassword.value="";
      confirmPassword.value="";
      newPassword.focus();
      // document.getElementById("confirmPassword").innerHTML = "New password entered not match";
      window.alert("New password entered not match");
      output = false;
    } 	
    return output;
    }
</script>

<style type="text/css">
.controls.show-hide-wpd span.glyphicon-eye-open {
    position: absolute;
    right: 0px;
    top: 0px;
    height: 28px;
    padding-top: 14px;
    width: 55px;
    text-align: center;
    cursor: pointer;
}
.controls.show-hide-wpd {
    position: relative;
}
.controls.show-hide-wpd input {
    padding-right: 32px !important;
    width:100%;
}
span.glyphicon-eye-open.active:before, span.glyphicon-eye-open:hover {
    color: #2184f6;
}
</style>

<script type="text/javascript">
	jQuery(document).on("click",".glyphicon-eye-open",function(){
		jQuery(this).toggleClass("active");
		var input=jQuery(this).parent().find("input");
		if(input.attr("type")=="text")
			input.attr("type","password");
		else
			input.attr("type","text");
	});
</script>

</head>
<body style="background:url(city.jpg); background-size: cover; font-family: 'Montserrat';">

<div class="container-fluid"  >
<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
         <h1 style="text-align: center;">Change Password</h1>
      </div>
<br>
<form name="frmChange" method="post" action="" onSubmit="return validatePassword()" class="form-horizontal">
<div style="width:585px; margin-left: auto; margin-right: auto;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm" >
<tr class="tableheader">
<td colspan="2"></td>
</tr>

    <div class="form-group" >
        <label for="currentPassword" class="col-sm-3 control-label" >Current Password</label>
        <div class="col-sm-9 controls show-hide-wpd">
            <input class="form-control" type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required glyphicon glyphicon-eye-open"></span>
        </div>
    </div>

<div class="form-group">
    <label for="newPassword" class="col-sm-3 control-label" >New Password</label>
    <div class="col-sm-9 controls show-hide-wpd">
    <input class="form-control" type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required glyphicon glyphicon-eye-open"></span>
    </div>
</div>

<div class="form-group">
    <label for="confirmPassword" class="col-sm-3 control-label" >Confirm Password</label>
    <div class="col-sm-9 controls show-hide-wpd">
    <input class="form-control" type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required glyphicon glyphicon-eye-open"></span>
    </div>
</div>
<br><br>
<tr>
<td style="align-items: center; display: flex; justify-content: center;"><input style="border-radius: 15px; font-size: 15px; width: 150px; " class="btn btn-success form-control " type="submit" name="submit" value="SUBMIT" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</div>
</div>
</body>
</html>

