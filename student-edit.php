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

    <title>Edit Students</title>
  </head>
  <body>

    <div class="container mt-5">

        <?php if (isset($_GET['message'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">  
                <strong>Hey!</strong> <?= $_GET['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">  
                <strong>Hey!</strong> <?= $_GET['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Edit
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
                                    
                                    <form action="code.php" method="post">

                                        <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                                        <div class="mb-3">
                                            <label>Student Name</label>
                                            <input type="text" name="name" value="<?= $student['name']; ?>" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>User Name</label>
                                            <input type="text" name="uname" value="<?= $student['uname']; ?>" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Student Email</label>
                                            <input type="text" name="email" value="<?= $student['email']; ?>" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Student Phone</label>
                                            <input type="text" name="phone" value="<?= $student['phone']; ?>" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" name="update_student" class="btn btn-primary">
                                                Update Student
                                            </button>
                                        </div>

                                    </form>

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