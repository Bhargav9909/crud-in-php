<?php

    session_start();
    include "dbcon.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>welcome <?php echo $_SESSION["uname"]; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <script src="script.js"></script>
</head>
<body>
    
    <div class="welcome">
        <form action="code.php" method="post">
            <h1>Welcome</h1>
            <h4><?php echo $_SESSION['uname']; ?></h4>
            <button type="submit"  name="logout_student" class="btn btn-primary">Logout</button>
        </form>     
    </div>

</body>
</html>