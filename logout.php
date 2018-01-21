<?php 
session_start();

// unset($_SESSION['user']);

session_destroy();
// unset($_SESSION['cryptocoin']);
// unset($_SESSION['cryptocoin']['json_eth']);
// unset($_SESSION['cryptocoin']['json_ubq']);
// unset($_SESSION['cryptocoin']['eth_price']);
// unset($_SESSION['cryptocoin']['ubq_price']);
header('location: index.php');
exit();

 ?>