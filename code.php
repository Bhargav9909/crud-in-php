<?php

    session_start();
    require 'dbcon.php';

    // Delete Data Query

    if (isset($_POST['delete_student'])) {

        $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

        $query = "DELETE FROM student WHERE id = '$student_id' ";
        $result = mysqli_query($con, $query);

        if ($result) {

            header("Location: index.php?message= Student Deleted Successfully");
            exit();

        }else {

            header("Location: index.php?message= Student Not Deleted");
            exit();

        }

    }

    // Upadate Data Query

    if (isset($_POST['update_student'])) {
        
        $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $uname = mysqli_real_escape_string($con, $_POST['uname']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);

        $query = "UPDATE student SET name = '$name', uname = '$uname' , email = '$email', phone = '$phone' WHERE id = '$student_id' ";
        $result = mysqli_query($con, $query);

        if ($result) {

            header("Location: student-create.php?message= Student Updated Successfully");
            exit();

        }else {

            header("Location: student-create.php?error= Student Not Updated");
            exit();

        }

    }

    // Insert Data Query

    if (isset($_POST['save_student'])) {

        $name = mysqli_real_escape_string($con, $_POST['name']);
        $uname = mysqli_real_escape_string($con, $_POST['uname']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

        if(empty($name)) {
            header("Location: student-create.php?error= Student Name is required");
            exit();
        }else if(empty($uname)) {
            header("Location: student-create.php?error= User Name is required");
            exit();
        }else if(empty($email)) {
            header("Location: student-create.php?error= Email is required");
            exit();
        }else if(empty($phone)) {
            header("Location: student-create.php?error= Phone is required");
            exit();
        }else if(empty($password)) {
            header("Location: student-create.php?error= Password is required");
            exit();
        }else if(empty($cpassword)) {
            header("Location: student-create.php?error= Confirm Password is required");
            exit();
        }

        $existSql = "SELECT * FROM student WHERE uname = '$uname' OR email = '$email'";
        $result = mysqli_query($con, $existSql);
        $numExistRows = mysqli_num_rows($result);

        if ($numExistRows > 0) {

            header("Location: student-create.php?error= Username or Email Already Exists");
            exit();

        }else {

            if ($password == $cpassword) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO student(id, name, uname, email, phone, password, reset_token_hash, reset_token_expires_at) 
                            VALUES ('','$name','$uname','$email','$phone','$hash','','')";
                $result = mysqli_query($con, $query);
                
                if ($result) {
                    
                    header("Location: student-create.php?message= Student Created Successfully");
                    exit();

                }else {
                    header("Location: student-create.php?error= Password does not match");
                    exit();
                }
            }else {
                
                header("Location: student-create.php?error= Student Not Created");
                exit();

            }
        }

    }

    // Login Data Query

    $login = false;

    if (isset($_POST['login_student'])) {

        $unameemail = $_POST["unameemail"];
        $password = $_POST["password"];
    
        if(empty($unameemail)) {
            header("Location: student-login.php?error= Username or Email is required");
            exit();
        }else if(empty($password)) {
            header("Location: student-login.php?error= Password is required");
            exit();
        }
        
        $sql = "SELECT * FROM student WHERE uname = '$unameemail' OR email = '$unameemail' ";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        $data = mysqli_fetch_assoc($result);
        $array = mysqli_fetch_array($result);

        
        if (is_array($array)) {
            $_SESSION["unameemail"] = $array['unameemail'];
            $_SESSION["password"] = $array['password'];
        }

        if ($num == 1) {
            if (password_verify($password, $data['password'])) {
                $login = true;
                $_SESSION['loggedin'] = true;
                $_SESSION['uname'] = $unameemail;
                header("Location: student-welcome.php");
                exit();
            }else {
                header("Location: student-login.php?Invalid Username , Email or Password");
                exit();
            }
        }else {
            header("Location: student-login.php?Invalid Credentials");
            exit();
        }
        if (isset($_SESSION['unameemail'])) {
            header("Location: student-welcome.php");
            exit();
        }
    }

    // Logout Data Query

    session_start();

    if (session_destroy()) {
        header ("Location: index.php");
    }

?>