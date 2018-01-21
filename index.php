<?php
session_start();
include('inc/header.php');

// $result_eth = json_decode($_SESSION['cryptocoin']['json_eth']);
// $result_ubq = json_decode($_SESSION['cryptocoin']['json_ubq']);

// if(isset($_SESSION['cryptocoin'])){
// $result_eth = json_decode($_SESSION['cryptocoin']['json_eth']);
// }
 ?>


<?php 
include('inc/sidebar.php');
 ?>

          </div>
        </div>

      <?php include('inc/topnav.php'); ?>

        <!-- page content -->



        <div class="right_col" role="main">
        <div class="col-lg-12">
          <div class="col-lg-3" style='background-color: white;'>
            <h3>Portfolio</h3>
            ETH <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
</div>
UBQ
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 5%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">5%</div>
</div>
TIT
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">70%</div>
</div>
<br>
Estimate profit Last 7 days
<h1 style='color:green'>30$</h1>

          </div>
          <div class="col-lg-5" style='background-color: ;'>
            <?php if(!empty($_SESSION['user']['json_eth'])){ ?>
            <div class="cryptocoin_wrap">
              <div class="x_panel tile" style='height:auto'>
                <div class="x_title">
                  <h2>Ethermine.org</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li class='pull-right'><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                  <a href="eth.php"><img src="https://www.shareicon.net/download/2016/07/08/117397_eth.ico" class='img img-responsive' alt=""></a>
                  <h5 class='text-center'>Pool: <a href='http://ethermine.org' target='_blank'>Ethermine.org</a></h5>
                  <h5 class='text-center'>Mining Status <i class='<?php if(empty($result_eth->minerStats->activeWorkers)){echo "red";}else{echo "green";} ?>'><?php if(empty($result_eth->minerStats->activeWorkers)){echo "Offline";}else{echo "Online";} ?></i></h5>
                
                  <h5 class='text-center'>Active Workers: <?php if(empty($result_eth->minerStats->activeWorkers)){echo "0";}else{echo $result_eth->minerStats->activeWorkers;} ?></h5>
                  <h5 class='text-center'>Average Hash: 
                  <?php
                    floatingpoint_hashrate($result_eth->reportedHashRate);
                    ?>
                  </h5>
              </div>
            </div>
          </a>

  <?php }else{echo "No Address provided";} ?>

            

<?php if(!empty($_SESSION['user']['json_ubq'])){ ?>
           <div class="cryptocoin_wrap">
              <div class="x_panel tile" style='height:auto;'>
                <div class="x_title">
                  <h2>Ubiqpool.io</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li class='pull-right'><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                  <a href="ubiq.php"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQylgMi8ZIchbcBiyWqPoKnZJQ-T_KwN2Awhn6IakEqPDw29cNWew" class='img img-responsive' alt=""></a>
                  <h5 class='text-center'>Pool: <a href='http://ubiqpool.io' target='_blank'>Ubiqpool.io</a></h5>
                  <h5 class='text-center'>Mining Status <i class='<?php if(empty($result_ubq->workersOnline)){echo "red";}else{echo "green";} ?>'><?php if(empty($result_ubq->workersOnline)){echo "Offline";}else{echo "Online";} ?></i></h5>
                  <h5 class='text-center'>Active Workers: <?php echo $result_ubq->workersOnline; ?></h5>



                 <h5 class='text-center'>Average hash:
                   <?php
                   floatingpoint_hashrate($result_ubq->currentHashrate);
                    ?>
                 </h5>
              </div>
            </div>

          <?php }else{echo "No Address provided";} ?>
          </div>

<?php
$query = "SELECT * FROM coins2 order by RAND() LIMIT 6";
 $result = mysqli_query($dbcon, $query) or die('SQL failed ' . mysqli_error($dbcon));

                 if(mysqli_num_rows($result) > 0){
                 while($row = mysqli_fetch_array($result))
                $rows[] = $row;
                    echo "<div class='col-lg-4'>";
                foreach($rows as $row){
                      echo "<div class='card_wrapper'>";
                      echo "<div class='card col-lg-5'>";
                        echo "<div class='card_desc'>";
                            echo "<img src='https://www.cryptopia.co.nz/Content/Images/Coins/".$row['coin_symbol']."-medium.png'>";
                            echo "<div class='card_desc_text'>$row[coin_symbol]</div>";
                            echo "</div>";
                            echo "<div class='card_price'>";
                            if($row['percent_change_24h'] > 0){
                               echo "<p> $" . $row['coin_price_usd'] . "<small style='color:green;'>" . $row['percent_change_24h'] . " %</small>" . " </p>";
                            }elseif($row['percent_change_24h'] < 0){
                               echo "<p> $" . $row['coin_price_usd'] . "<small style='color:red;'>" . $row['percent_change_24h'] . " %</small>" . " </p>";
                            }else{
                               echo "<p> $" . $row['coin_price_usd'] . "<small style='color:blue;'>" . "#" . "</small>" . " </p>";
                            }
                           
                        echo "</div>";
                      echo "</div>";
                  }
                    echo "</div>";
                }
 ?>


        </div>

          <br />

          <div class="row">

          <!-- <pre> -->
            <?php 
            // var_dump($_SESSION); 
            ?>
          <!-- </pre> -->









          </div>


        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
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
