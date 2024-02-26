<?php

    session_start();
    include 'dbcon.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMPT;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'autoload.php';

    function send_password_reset($get_name, $get_email,$token){

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.example.com';                     
        $mail->SMTPAuth   = true;   

        $mail->Username   = 'khandarbhargav58@gmail.com';                    
        $mail->Password   = '*';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    

        $mail->setFrom('khandarbhargav58@gmail.com', $get_name);
        $mail->addAddress($get_name);

        $mail->isHTML(true);
        $mail->Subject = "Reset Password Notification";
        
        $email_template = "
        <h2>Hello</h2>
        <h3>You are receiving this email because a password reset request for your account.</h3>
        <br><br>
        <a href='/http://localhost/bhargav/crud/password-change.php?token=$token&email=$get_email'> Click Me </a>
        ";

        $mail->Body = $email_template;
        $mail->send();

    }

    if (isset($_POST['Password_reset_link'])) {
        
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $token = md5(rand());

        $check_email = "SELECT email FROM student WHERE email = '$email' LIMIT 1";
        $check_email_run = mysqli_query($con, $check_email);

        if (mysqli_num_rows($check_email_run) > 0) {

            $row = mysqli_fetch_array($check_email_run);
            $get_name = $row['name'];
            $get_email = $row['email'];

            $update_token = " UPDATE student SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
            $update_token_run = mysqli_query($con, $update_token);

            if ($update_token_run) {
                
                send_password_reset($get_name, $get_email, $token);
                $_SESSION['status'] = "We e-mailed you password reset link";
                header("Location: password-reset.php");
                exit();

            }else {

                $_SESSION['status'] = "Something went wrong. #1";
                header("Location: password-reset.php");
                exit();

            }

        }else {

            $_SESSION['status'] = "No Email Found";
            header("Location: password-reset.php");
            exit();

        }

    }

?>