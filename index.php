<?php

    session_start();
    include 'dbcon.php';

?>

<?php include('header.php'); ?>

    <div class="container mt-4">

        <?php if (isset($_GET['message'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">  
                <strong>Hey!</strong> <?= $_GET['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Student Details
                            <a href="student-create.php" class="btn btn-primary float-end ms-3">Add Students</a>
                            <a href="student-login.php" class="btn btn-warning float-end">login</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        
                        <table class="table table-striped text-center">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                    $query = "SELECT * FROM student";
                                    $result = mysqli_query($con, $query);

                                    if (mysqli_num_rows($result) > 0) {

                                        foreach ($result as $student) {
                                            
                                ?>

                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><?= $student['name']; ?></td>
                                                <td><?= $student['uname']; ?></td>
                                                <td><?= $student['email']; ?></td>
                                                <td><?= $student['phone']; ?></td>
                                                <td class="d-flex flex-row justify-content-center">
                                                    <a href="student-view.php?id=<?= $student['id']; ?>" class="btn btn-info btn-sm me-2">View</a>
                                                    <a href="student-edit.php?id=<?= $student['id']; ?>" class="btn btn-success btn-sm ms-3">Edit</a>
                                                    <form action="code.php" method="post">
                                                        
                                                            <!-- Delete model box open -------------->                                                        
                                                            <div class="container"> 
                                                                <button type="button" name="delete_student" value="<?= $student['id']; ?>"
                                                                    class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
                                                                    Delete
                                                                </button>
                                                                    
                                                                <div class="modal" id="myModal">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="d-flex justify-content-end pt-3 pe-3">
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p class="text-center fs-3 ">Are sure you want to delete <br>this user.</p>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end pb-3 pe-3">
                                                                                <button type="button" class="btn btn-primary me-2" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" name="delete_student" value="<?= $student['id']; ?>" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Delete model box close -------------->

                                                    </form>
                                                </td>
                                            </tr>

                                <?php
                                        }
                                    }else {
                                        echo "<h5> No Record Found </h5>";
                                    }

                                ?>

                                
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?>