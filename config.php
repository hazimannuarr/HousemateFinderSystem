<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51I2I2oLcJAnDOeJ4udE1yxtNLA0jwHZwtGBxQDUu5xjvNQorwb4WkY9hTcFOIlp6CGbFDxul1SJwSIoXUSFc6FF4000Vru5hrz",
        "publishableKey" => "pk_test_51I2I2oLcJAnDOeJ4K2PDAxx3f3m3qaGZHOfkmGrovgm290SwlOCRrXUw8m1NSIPYM57PMFY9qetBHl60erjTidJC00d5oR8rS3"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>