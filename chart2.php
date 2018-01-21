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
                  if(!isset($_GET['coin'])){
                  ?>
                      <form method='POST'>
                          <input type="submit" class='btn btn-default' name='1hr' value='1hr'>
                          <input type="submit" class='btn btn-default' name='24hr' value='24hr'>
                          <input type="submit" class='btn btn-default' name='7days' value='7days'>
                          <?php if(isset($_POST['1hr'])){
                              $percent_change = 'percent_change_1h';
                              $percent_change_text = 'Change 1 Hour';
                              $percent_change_text = 'Change 1 Hour';
                            }elseif(isset($_POST['24hr'])){
                              $percent_change = 'percent_change_24h';
                              $percent_change_text = 'Change 24 Hours';
                              }elseif(isset($_POST['7days'])){
                                $percent_change = 'percent_change_7d';
                                $percent_change_text = 'Change 7 Days';
                                }else{
                                    $percent_change = 'percent_change_24h';
                                    $percent_change_text = 'Change 24 Hours';
                                  } ?>
                      </form>
                  <?php
               $query = "SELECT * FROM coins
                  -- INNER JOIN users on users.user_id = my_chart.fk_user_id
                  -- INNER JOIN coins on coins.coin_id = my_chart.fk_coin_id
                 ORDER BY coin_id ASC";
                $result = mysqli_query($dbcon, $query) or die('SQL failed ' . mysqli_error($dbcon));
                 if(mysqli_num_rows($result) > 0){
                 while($row = mysqli_fetch_array($result))
                $rows[] = $row;
                foreach($rows as $row){
                  ?>



                  <?php
                  echo "<a href='chart.php?coin=eth'>";
                 echo "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 chartbox'>";
                  echo "<div class='x_panel tile overflow_hidden'>";

                  echo "<img src='$row[coin_image]'>";
                  echo "<div class='contentbox'>";
                  echo "<h3>" . $row['coin_name'] . " (" . strtoupper($row['coin_name_short']) .")" . "</h3>";

                   $dynamic = json_decode($_SESSION['cryptocoin'][$row['coin_name']]);
                  foreach($dynamic as $key){
                    echo "<h1>". "$" .  substr($key->price_usd,0,8) . "</h1>";
                    $percent = $key->$percent_change;
                    if(substr($percent,0,7) < 0){
                      echo "<h3 style='color:red'>". substr($percent,0,7)."%</h3>";
                    }elseif(substr($percent,0,7) > 0){
                      echo "<h3 style='color:green'>". substr($percent,0,7)."%</h3>";
                    }else{
                      echo "<h3>Something went wrong</h3>";
                    }
                            }

                  echo "</div>";




                  echo "</div>";
                 echo "</div>";
                 echo "</a>";
               }
                  echo "<a href='?action=add&coin='>";
                  echo "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 chartbox'>";
                  echo "<div class='x_panel tile overflow_hidden'>";
                  echo "<h3>Add Coin</h3>";
                  echo "</div>";
                  echo "</div>";
                  echo "</a>";
               ?>


               <?php
               }
             }else{
              ?>
                      <div class="col-md-9 col-sm-12 col-xs-12">
                      <div class="demo-container" style="height:280px">
                        <div id="chart_plot_02" class="demo-placeholder"></div>
                      </div>
                      <div class="tiles">

                      </div>

                    </div>
              <?php
             }

                  ?>
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
