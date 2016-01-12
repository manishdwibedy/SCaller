<?php

    $name=$_GET['name'];
    $email=$_GET['email'];
    $message=$_GET['message'];

    if($name == '' || $email == '' || $message == '')
    {
      echo 'Error';
    }
    else {
          $from="From: $name<$email>\r\nReturn-path: $email";
          $subject="Message sent from p";
          mail("manish.dwibedy@gmail.com", $subject, $message, $from);
          echo "Email sent!";

    }

?>
