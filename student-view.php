<?php

    session_start();
    require 'dbcon.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Students View Details</title>
  </head>
  <body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student View Details
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php

                            if (isset($_GET['id'])) {

                                $student_id = mysqli_real_escape_string($con, $_GET['id']);
                                $query = "SELECT * FROM student WHERE id = '$student_id' ";
                                $result = mysqli_query($con, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    
                                    $student = mysqli_fetch_array($result);
                        ?>
                                    
                                        <div class="mb-3">
                                            <label>Student Name</label>
                                            <p class="form-control">
                                                <?= $student['name']; ?>
                                            </p>
                                        </div>

                                        <div class="mb-3">
                                            <label>User Name</label>
                                            <p class="form-control">
                                                <?= $student['uname']; ?>
                                            </p>
                                        </div>

                                        <div class="mb-3">
                                            <label>Student Email</label>
                                            <p class="form-control">
                                                <?= $student['email']; ?>
                                            </p>
                                        </div>

                                        <div class="mb-3">
                                            <label>Student Phone</label>
                                            <p class="form-control">
                                                <?= $student['phone']; ?>
                                            </p>
                                            
                                        </div>

                            <?php
                                    
                                }else {
                                    echo "<h4> No Such Id Found </h4>";
                                }

                            }

                            ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>

  </body>
</html>