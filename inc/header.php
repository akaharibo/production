<?php
ob_start();
require_once('inc/db_config.php');
require_once('inc/functions.php');
 ?>

<?php
if(basename($_SERVER['PHP_SELF']) == 'signup.php'){
}elseif(!isset($_SESSION['user']['user_id'])){
  if(basename($_SERVER['PHP_SELF']) !== 'login.php'){
    header('location: login.php');
    exit();
  }
}

if(isset($_SESSION['user'])){
  if(empty($_SESSION['user']['json_eth'])){
     if(basename($_SERVER['PHP_SELF']) !== 'settings.php'){
      header('location: settings.php');
      exit();
    }
  }
}

   ?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Cutom css -->
     <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
<!-- JS LIST -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>



<script>
  console.log('hej');
  $(window).load(function() {
    $(".se-pre-con").fadeOut("slow");;
  });
</script>

  </head>

  <?php 
  if(isset($_SESSION['user'])){
  $result_eth = json_decode($_SESSION['cryptocoin']['json_eth']);
$result_ubq = json_decode($_SESSION['cryptocoin']['json_ubq']);

if(isset($_SESSION['cryptocoin'])){
$result_eth = json_decode($_SESSION['cryptocoin']['json_eth']);
}
} ?>