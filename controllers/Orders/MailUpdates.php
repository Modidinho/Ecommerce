<?php

require_once('../setup/EmailSettings.php');
require_once('../setup/connect.php');

if(isset($_POST['email_update_on_order_update']))
{
   $id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));
   $status = mysqli_real_escape_string($dbc,strip_tags($_POST['status']));

   $sql_user = mysqli_fetch_array(mysqli_query($dbc,"SELECT email FROM users WHERE user_id IN 
                                                                                           (SELECT user_id FROM orders WHERE id='$id')
                                              ")
                                  );
   $email = $sql_user['email'];

    
   $mail->addAddress($email);
    
    $mail->Subject = 'Taitan Farm Order Update';
    $mail->Body    = 'Your order number <b>'.$id.' </b> has been updated to: <br/> <b>'.$status.' </b>';
    $mail->AltBody = 'Your order number <b>'.$id.' </b> has been updated to: <br/> <b>'.$status.' </b>';
    $sendmail =   $mail->send();
    if($sendmail)
    {
        exit("success");
    }
    else 
    {
        echo  $mail->ErrorInfo;
    }
}



?>