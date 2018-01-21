<?php
session_start();


include('inc/header.php');


	$un = $_SESSION['user']['user_username'];

 $query = "SELECT * FROM `users` WHERE `user_username` = '{$un}'";
                $result = mysqli_query($dbcon, $query) or die('SQL failed ' . mysqli_error($dbcon));

                 if(mysqli_num_rows($result) > 0){
                 $row = mysqli_fetch_assoc($result);


           include('session_api.php');


    header('location: ' . $_SERVER['HTTP_REFERER'] . '');
        exit();
        }else{
            echo "Login has failed";
        }
?>

