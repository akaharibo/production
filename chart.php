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



  <?php 
  include('inc/sidebar.php');
   ?>

              <!-- /menu footer buttons -->
            </div>
          </div>

        <?php include('inc/topnav.php'); ?>

          <!-- page content -->

<div class='right_col' role='main'>
 <form method='POST'>
                          <input type="submit" class='btn btn-default' name='1hr' value='1hr'>
                          <input type="submit" class='btn btn-default' name='24hr' value='24hr'>
                          <input type="submit" class='btn btn-default' name='7days' value='7days'>
                          <?php if(isset($_POST['1hr'])){
                              $percent_change = 'percent_change_1h';
                              $percent_change_text = 'Change 1h: ';
                            }elseif(isset($_POST['24hr'])){
                              $percent_change = 'percent_change_24h';
                              $percent_change_text = 'Change 24h: ';
                              }elseif(isset($_POST['7days'])){
                                $percent_change = 'percent_change_7d';
                                $percent_change_text = 'Change 7d: ';
                                }else{
                                    $percent_change = 'percent_change_24h';
                                    $percent_change_text = 'Change 24h: ';
                                  } ?>
                      </form>
<?php

$query = "SELECT * FROM coins2
                 ORDER BY coin_rank ASC LIMIT 1500";
              $result = mysqli_query($dbcon, $query) or die('SQL failed ' . mysqli_error($dbcon));

          if(mysqli_num_rows($result) > 0){
           while($row = mysqli_fetch_array($result))
            $rows[] = $row;
        }

 if(isset($_GET['action'])){
         if($_GET['action'] == 'sold'){
    echo "sold";
    $id = $_GET['id'];
      $query = "UPDATE `mycoins` SET
                  `myCoins_active`='0',
                  `myCoins_sold_price`='$row[coins_price_usd]'
                  WHERE myCoins_id = '$id'";
                    $result = mysqli_query($dbcon, $query) or die('SQL failed ' . mysqli_error($dbcon));
                  header('location: ' . $_SERVER['HTTP_REFERER'] . '');
          exit();
  }
   }
         



          echo "<table class='table'>";
          echo "<thead>";
          echo "<tr style='background-color:#C9c9c9;'>";
          echo "<th>#</th>";
            echo "<th>Coin</th>";
            echo "<th>Price</th>";
            echo "<th>Market Cap</th>";
            echo "<th>Change(24h)</th>";
   
          echo "</tr>";
          echo "</thead>";
          echo "<tbody style='background-color:white;'>";
          foreach($rows as $row){
            echo "<td>$row[coin_rank]</td>";
          // echo "<td><img src='https://www.cryptopia.co.nz/Content/Images/Coins/".$row['coin_symbol']."-medium.png' style='width:25px;height:25px;'>" . $row['coin_name'] . "<br>" . $row['coin_symbol'] . "</td>";
            echo "<td><img src='images/icons/placeholder.png'></td>";


          echo "<td>$row[coin_price_usd]</td>";
          echo "<td>" . "$" . $row['coin_marketcap_usd'] . "</td>";
         




            if($row['percent_change_24h'] > 0){
              echo "<td style='color:green;font-weight:bold;'>$row[percent_change_24h]%</td>";
            }else{
              echo "<td style='color:red;font-weight:bold;'>$row[percent_change_24h]%</td>";
            }
// +/-










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
