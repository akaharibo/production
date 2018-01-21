<?php session_start();
include('inc/header.php');
         $id = $_SESSION['user']['user_id'];

if(isset($_GET['action'])){
  if(isset($_GET['action']) == 'delete'){
    $uid = $_SESSION['user']['user_id'];
    $id = $_GET['id'];
  $query = "DELETE FROM my_chart WHERE fk_user_id = $uid AND fk_coin_id = $id";
  $result = mysqli_query($dbcon, $query) or die('SQL failed' . mysqli_error($dbcon));
  header('location: ' . $_SERVER['HTTP_REFERER'] . '');
        exit();
  }
}
   ?>

    <body class="nav-md">
      <div class="container body">
        <div class="main_container">
          <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
              <div class="navbar nav_title" style="border: 0;">
                <a href="index.php" class="site_title" style='text-align:center;'> <span>Ethereum</span></a>
              </div>


  <?php 
  include('inc/sidebar.php');
   ?>

              <!-- /menu footer buttons -->
            </div>
          </div>

        <?php include('inc/topnav.php'); ?>

          <!-- page content -->

<div class='right_col' role='main'>

<?php 
 $query = "SELECT * FROM myCoins
              INNER JOIN users on users.user_id = myCoins.fk_users
              INNER JOIN coins2 on coins2.coin_id = myCoins.fk_coins
              INNER JOIN btcHistory on btcHistory.btcHistory_id = myCoins.fk_btcHistory
              WHERE user_id = $id ORDER BY coin_name DESC";
              $result = mysqli_query($dbcon, $query) or die('SQL failed ' . mysqli_error($dbcon));

          if(mysqli_num_rows($result) > 0){
           while($row = mysqli_fetch_array($result))
            $rows[] = $row;
        }

          echo "<table class='table'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th><a href='?action=add'><i class='fa fa-plus-circle'></i></a></th>";
          if(isset($_GET['sortby']) && $_GET['sortby'] == 'asc'){
            echo "<th>Coin <a href='?action=sort&orderby=coin&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          }else{
            echo "<th>Coin <a href='?action=sort&orderby=coin&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          }
          echo "<th>Amount</th>";
          echo "<th class='hidden-xs hidden-sm'>Rate</th>";
          echo "<th>Buy</th>";
          echo "<th>Sell</th>";
          echo "<th>+/-</th>";
          echo "<th class='hidden-xs hidden-sm'>Edit</th>";
          echo "<th class='hidden-xs hidden-sm'>Delete</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          foreach($rows as $row){



if($row['myCoins_rate'] * $row['myCoins_amount'] > $row['coin_price_btc'] * $row['myCoins_amount']){
         echo "<tr class='danger'>";
}elseif($row['myCoins_rate'] * $row['myCoins_amount'] < $row['coin_price_btc'] * $row['myCoins_amount']){
echo "<tr class='success'>";
}
          echo "<td><img src='https://www.cryptopia.co.nz/Content/Images/Coins/".$row['coin_symbol']."-medium.png' style='width:25px;height:25px;'></td>";
          echo "<td>$row[coin_symbol]</td>";
          echo "<td>$row[myCoins_amount]</td>";
          echo "<td class='hidden-xs hidden-sm'>$row[myCoins_rate]</td>";
          echo "<td>" . substr($row['myCoins_rate'] * $row['myCoins_amount'],0,9) ."</td>";
        if(strlen($row['coin_price_btc'] * $row['myCoins_amount']) == 8){
          echo "<td>" .substr($row['coin_price_btc'] * $row['myCoins_amount'],0,9) . "0" . "</td>";
        }elseif(strlen($row['coin_price_btc'] * $row['myCoins_amount']) == 9){
          echo "<td>" .substr($row['coin_price_btc'] * $row['myCoins_amount'],0,9) . "</td>";
        }elseif(strlen($row['coin_price_btc'] * $row['myCoins_amount']) == 10){
          echo "<td>" .substr($row['coin_price_btc'] * $row['myCoins_amount'],0,9) . "</td>";
        }elseif(strlen($row['coin_price_btc'] * $row['myCoins_amount']) == 11){
          echo "<td>" .substr($row['coin_price_btc'] * $row['myCoins_amount'],0,9) . "</td>";
        }elseif(strlen($row['coin_price_btc'] * $row['myCoins_amount']) == 12){
            echo "<td>" .substr($row['coin_price_btc'] * $row['myCoins_amount'],0,9) . "</td>";
        }
// substr($row['coin_price_btc'] * $row['myCoins_amount'],0,9)

        $v1 = $row['coin_price_btc'] * $row['myCoins_amount'];
        $v2 = $row['myCoins_rate'] * $row['myCoins_amount'];
        $v3 = $v1 - $v2;
        echo "<td>" . $v3 ."</td>";
         echo "<td class='hidden-xs hidden-sm'><a href='?action=edit&id=$row[myCoins_id]'><i class='fa fa-pencil'></i></a></td>";
         echo "<td class='hidden-xs hidden-sm'><a href='?action=delete&id=$row[myCoins_id]'><i class='fa fa-trash'></i></a></td>";
         echo "</tr>";
       }
       echo "</tbody>";
       echo "</table>";
     ?>




  </div>

  </div>
          <!-- /page content -->

          <!-- footer content -->
          <footer>
            <div class="pull-right">
              2017 - Akaharry
            </div>
            <div class="clearfix"></div>
          </footer>
          <!-- /footer content -->
        </div>
      </div>

      <!-- jQuery -->
      <script src="../vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="../vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="../vendors/nprogress/nprogress.js"></script>
      <!-- Chart.js -->
      <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
      <!-- gauge.js -->
      <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- iCheck -->
      <script src="../vendors/iCheck/icheck.min.js"></script>
      <!-- Skycons -->
      <script src="../vendors/skycons/skycons.js"></script>
      <!-- Flot -->
      <script src="../vendors/Flot/jquery.flot.js"></script>
      <script src="../vendors/Flot/jquery.flot.pie.js"></script>
      <script src="../vendors/Flot/jquery.flot.time.js"></script>
      <script src="../vendors/Flot/jquery.flot.stack.js"></script>
      <script src="../vendors/Flot/jquery.flot.resize.js"></script>
      <!-- Flot plugins -->
      <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
      <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
      <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
      <!-- DateJS -->
      <script src="../vendors/DateJS/build/date.js"></script>
      <!-- JQVMap -->
      <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
      <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
      <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="../vendors/moment/min/moment.min.js"></script>
      <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

      <!-- Custom Theme Scripts -->
      <script src="../build/js/custom.min.js"></script>
    </body>
  </html>
