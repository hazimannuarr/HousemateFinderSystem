<?php

if (isset($_POST['reset_pwd'])) {

	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
	$password = $_POST["pwd"];
	$repeatPassword = $_POST["repeat"];

	if(empty($password) || empty($repeatPassword)) {
    	header("location:pwd_new.php?selector=".$selector."&validator=".$validator."&newpwd=empty");
    	exit();
    } elseif ($password != $repeatPassword) {
    	header("location:pwd_new.php?selector=".$selector."&validator=".$validator."&newpwd=notsame");
    	exit();
    }

    $currentdate = date("U");

    require 'db_mysqli.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires>=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      // ehco "There was an error!";
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "ss", $selector, $currentdate);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if (!$row = mysqli_fetch_assoc($result)) {
      	echo "You need to re-submit your reset request";
      	exit();
      } else {

		$tokenBin = hex2bin($validator);
		$tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);
		
		// echo $tokenCheck ? 'true' : 'false';
		// echo "<br>".$row['pwdResetToken']."<br>".$validator."<br>".$tokenBin."<br>";
		if ($tokenBin !== $row['pwdResetToken']) {
		  // echo $tokenBin;
		  echo "You need to re-submit your reset request.";
      	  exit();
		}
		elseif ($tokenBin === $row['pwdResetToken']) {

		  $tokenEmail = $row["pwdResetEmail"];

		  $sql = "SELECT * FROM users WHERE email=?;";
		  $stmt = mysqli_stmt_init($conn);
    	  if(!mysqli_stmt_prepare($stmt, $sql)) {
      	    // ehco "There was an error!";
      	    exit();
    	  } else {
    	  	mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
    	  	mysqli_stmt_execute($stmt);
    	  	$result = mysqli_stmt_get_result($stmt);
      		if (!$row = mysqli_fetch_assoc($result)) {
      		  echo "There was an error";
      		  exit();
      		} else {

      		  $sql = "UPDATE users SET password=? WHERE email=?";
      		  $stmt = mysqli_stmt_init($conn);
    	  	  if(!mysqli_stmt_prepare($stmt, $sql)) {
      	    	// ehco "There was an error!";
      	    	exit();
    	  	  } else {
    	  	  	$newpwdhash = password_hash($password, PASSWORD_DEFAULT);
    	  		mysqli_stmt_bind_param($stmt, "ss", $newpwdhash, $tokenEmail);
    	  		mysqli_stmt_execute($stmt);

    	  		$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    			$stmt = mysqli_stmt_init($conn);
    			if(!mysqli_stmt_prepare($stmt, $sql)) {
      			  // ehco "There was an error!";
      			  exit();
    			} else {
      			  mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
      			  mysqli_stmt_execute($stmt);
      			  header("location:login.php?newpwd=updated");
    			}

    	  	  }
      		}
    	  }
		}
      }
    }

} else {
	header("location:homepage.php");
}
?>