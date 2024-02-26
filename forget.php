<?php

    session_start();
    require 'dbcon.php';

    if (isset($_REQUEST['pwdrst'])) {
        
        $email = $_REQUEST['email'];
        $check_email = mysqli_query($con, "SELECT email FROM student WHERE email = '$email' ");
        $res = mysqli_num_rows($check_email);
        if ($res > 0) {
            
            $message = '<div><b>Hello!</b><p>You are receving this email because we recived a password reset request for your accoun.</p>
            <p><button class="btn btn-primary"><a href="http://http://localhost/bhargav/crud/passwordreset.php?secret='.base64_encode($email).'">
            Reset Password</a></button></p><br>
            <p>If you did not request a password reset, no further action ie required.</p></div>';

            $email = $email;
            $mail = new PHPMailer;
            $mail -> IsSMTP;
            $mail -> SMTPAuth = true;
            $mail -> SMTPSecure = "tls";
            $mail -> Host = 'smtp.gmail.com';
            $mail -> Port = 587;
            $mail -> Username = "khandarbhargav58@gmail.com";
            $mail -> Password = "bhargav69460572";
            $mail -> Addaddress($email);
            $mail -> Subject = "Reset Password";
            $mail -> isHTML ( TRUE );
            $mail -> Body = $message;
            if ($mail -> send()) {
                $msg = "We have e-mailed your password reset Link!";
            }else {
                $msg = "We can't find a user with that email address";
            }

        }

    }

?>

<?php include('header.php'); ?>

<div class="py-5">
    <div class="container">
        <div class="row justify-conternt-center">
            <div class="col-mb-6">

                <div class="card">
                    <div class="card-header">
                        <h5>Reset Password</h5>
                    </div>
                    <div class="card-body p-4">

                    <form method="post">

                        <div class="form-group mb-4">
                            <label>Email Address</label>
                            <input type="text" name="email" class="form-control" placeholder="Enater Email Address">
                        </div>
                        <div class="form-group mb-3">
                        <button type="submit" name="pwdsrt" class="btn btn-success">Send Password Reset Link</button>
                        </div>
                        <p><?php if (!empty($msg)) { echo $msg; } ?></p>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>