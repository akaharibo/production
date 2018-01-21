<?php session_start();
include('inc/header.php');
         $id = $_SESSION['user']['user_id'];


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
 $query = "SELECT * FROM watchlist
              INNER JOIN users on users.user_id = watchlist.fk_user_id
              INNER JOIN coins2 on coins2.coin_id = watchlist.fk_coin_id
              WHERE user_id = $id";
                $result = mysqli_query($dbcon, $query) or die('SQL failed ' . mysqli_error($dbcon));

                 if(mysqli_num_rows($result) > 0){
                 while($row = mysqli_fetch_array($result))
                $rows[] = $row;
                foreach($rows as $row){

                    echo $row['coin_symbol'] . "<br>";
                    // echo "1 Hour " . $row['percent_change_1h'] . "<br>";
                    // echo "24 Hours " . $row['percent_change_24h'] .  "<br>";
                    // echo "7 Days " . $row['percent_change_7d'] . "<br>";
                    // echo "Price BTC " .$row['coin_price_btc'] . "<br>";
                    // echo "litecoin?";
                    // echo "bitbean?";
                    // echo "omiseGo";

                }
}

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
