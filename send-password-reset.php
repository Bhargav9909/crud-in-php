<?php

    $mysqli = new mysqli("localhost","root","","phpdata");
    
    if (!$mysqli) {
        die('Connection Failed'.mysqli_connect_error());
    }

    $token = bin2hex(random_bytes(16));

    $token_hash = hash("sha256", $token);

    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

if (isset($_POST['reset_token_hash'], $_POST['reset_token_expires_at'])) {

    // $stmt = $mysqli->prepare("UPDATE student SET reset_token_hash = ? , reset_token_expires_at = ? WHERE email = ?");
    // $stmt->bind_param("sss", $token_hash, $expiry, $email);

    // $stmt->execute();

    // echo "New records created successfully";

    // $stmt->close();
    // $mysqli->close();

    // var_dump($_POST['token_hash']);

    $stmt = $mysqli->prepare("UPDATE student SET reset_token_hash = ? , reset_token_expires_at = ? WHERE email = ?");
    $stmt->bind_param("si", $token_hash, $expiry, $email);
    
    $token_hash = $_POST['token_hash'];
    $expiry = $_POST['expiry'];
    $email = $_POST['email'];
    echo $expiry;
    $stmt->execute();
    $stmt->close();
}

// if ($mysqli -> affected_rows) {

//     $mail = require __DIR__ . '/mailer.php';

//     $mail -> setForm("noreply@example.com");
//     $mail -> addAddress($email);
//     $mail -> Subject = "Password Reset";
//     $mail -> Body = <<<END

//     Click <a href="http://example.com//reset-password.php?token=$token">here</a>
//     to reset your password.

//     END;

//     try {
//         $mail -> send();
//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer error: {$mail -> Errorinfo}";
//     }
    
// }

// $mysqli -> close();

// echo "Message sent, please check your inbox.";

?>
