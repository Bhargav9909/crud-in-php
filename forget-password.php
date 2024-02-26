<?php

    session_start();

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

                    <form action="send-password-reset.php" method="post">

                        <div class="form-group mb-4">
                            <label>Email Address</label>
                            <input type="text" name="email" class="form-control" placeholder="Enater Email Address">
                        </div>
                        <div class="form-group mb-3">
                        <button type="submit" name="password-reset" class="btn btn-primary">Send Password Reset Link</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>