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
               $query = "SELECT * FROM my_chart
                  INNER JOIN users on users.user_id = my_chart.fk_user_id
                  INNER JOIN coins on coins.coin_id = my_chart.fk_coin_id
                  WHERE fk_user_id = $id ORDER BY coin_id ASC";
                $result = mysqli_query($dbcon, $query) or die('SQL failed ' . mysqli_error($dbcon));
                 if(mysqli_num_rows($result) > 0){
                 while($row = mysqli_fetch_array($result))
                $rows[] = $row;
                foreach($rows as $row){
                  echo "<a href='chart.php?coin=eth'>";
                 echo "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 cryptocoin_chart'>";
                 echo "<div class='x_panel tile overflow_hidden'>";
                 echo "<div style='width:10%;float:left;margin-right:10px;text-align:center;'>";
                  echo $row['coin_name_short'];
                  echo "<img src='$row[coin_image]' style='height:25px;'>";
                 echo "</div>";
                 echo "<div style='width:25%;float:left;margin-right:5px;text-align:center;'>";
                 echo "<div style='color:blue;font-weight: bold'>Coin</div>";
                 echo $row['coin_name'];
                 echo "</div>";
                 echo "<div style='width:25%;float:left;margin-right:5px;text-align:center;'>";
                 echo "<div style='color:blue;font-weight: bold'>Value</div>";

                  $dynamic = json_decode($_SESSION['cryptocoin'][$row['coin_name']]);
                  foreach($dynamic as $key){
                                $t = $key->price_usd;
                            }

                 echo substr($t, 0,8);
                 echo "</div>";
                 echo "<div style='width:25%;float:left;text-align:center;'>";
                 echo "<div style='color:blue;font-weight: bold'>" . $percent_change_text . "</div>";
                   foreach($dynamic as $key){
                                $t = $key->$percent_change;
                            }
                 if(substr($t,0,7) < 0){
                    echo "<b style='color:red;'>" . substr($t,0,7) . "%</b>";
                    }else{
                       echo "<b style='color:green;'>" . substr($t,0,7) . "%</b>";
                      }
                 echo "</div>";
                 echo "<div style='float:right;margin-top:10px;text-align:center;'>";
                 echo "<a href='?action=delete&id=$row[fk_coin_id]' onclick=\"return confirm('Are you sure you want to remove this from the list?')\"><i class='fa fa-trash'></i></a>";
                 echo "</div>";
                 echo "</div>";


                 echo "</div>";
                 echo "</a>";
               }
               ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="x_panel tile overflow_hidden" style='text-align: center;line-height: 60px;font-size:20px;'>
                      <a href="?action=add_coin"><i class='fa fa-plus-circle'> 
                        <?php
                        if(isset($_GET['action'])){
                          echo "hej";
                          // if($_GET['action'] == 'add_coin'){
                            // echo "<input type='text'>";
                          // }
                        }else{
                          echo "add coin";
                        }
                      ?>
                      </i></a>
                  </div>
                </div>

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
