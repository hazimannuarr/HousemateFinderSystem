<?php

  use PHPMailer\PHPMailer\PHPMailer; 

  if (isset($_POST["resetreq"])) {

    $selector = bin2hex(mt_rand(10000000, 99999999));
    $token = mt_rand(10000000, 99999999);

    $url = "http://lrgs.ftsm.ukm.my/users/a167582/housematefinder4/pwd_new.php?selector=".$selector."&validator=".bin2hex($token);

    $expires = date("U") + 900;

    require 'db_mysqli.php';

    $userEmail = $_POST['email'];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      // ehco "There was an error!";
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $userEmail);
      mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      // ehco "There was an error!";
      exit();
    } else {
      $hashedToken = password_hash($token, PASSWORD_DEFAULT);
      mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $token, $expires);
      mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;

    $subject = 'Reset your Housemate Finder account password';

    $message = '<p>Here is the password reset link: </br>';
    $message .= '<a href ="'.$url.'">'.$url.'</a></p>';

    // $headers = 'From: e-Masjid <emasjid.help@gmail.com>\r\n';
    // $headers .= 'Reply-to: emasjid.help@gmail.com\r\n';
    // $headers .= 'Content-type: text/html\r\n';

    // mail();

    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $subject = $_POST['subject'];
    // $body = $_POST['body'];

    require_once 'PHPMailer/Exception.php';
    require_once 'PHPMailer/PHPMailer.php';
    require_once 'PHPMailer/SMTP.php';
    require_once "PHPMailer/OAuth.php";

    $mail = new PHPMailer();
    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'nebula.helps@gmail.com';
      $mail->Password = '#qwerty123';
      $mail->Port = 465;
      $mail->SMTPSecure = 'ssl';

      $mail->isHTML(true);
      $mail->setFrom('nebula.helps@gmail.com', 'Housemate Finder System');
      $mail->addAddress($to);
      $mail->Subject = $subject;
      $mail->Body = $message;
      $mail->addCustomHeader('Content-type: text/html; charset=ISO-8859-1');

      if(!$mail->send()) {
        echo "Message could not be sent.<p>";
        echo "Mailer error: ".$mail->ErrorInfo;
        exit();
      }
    } catch(Exception $e) {
      echo $e;
    }
    header("location:pwd_reset.php?reset=success");
  } else {
    header("location:login.php");
  }

?>