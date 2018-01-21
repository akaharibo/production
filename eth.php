<?php session_start();
include('inc/header.php');
  $result_eth = json_decode($_SESSION['cryptocoin']['json_eth']);
   ?>




  <?php 
  include('inc/sidebar.php');
   ?>

              <!-- /menu footer buttons -->
            </div>
          </div>

        <?php include('inc/topnav.php'); ?>

          <!-- page content -->



          <div class="right_col" role="main">

            <!-- top tiles -->

            <div class="row tile_count">
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"> Active Workers</span>
                <div class="count"><?php if(!empty($result_eth->minerStats->activeWorkers)){echo $result_eth->minerStats->activeWorkers;}else{
                  echo "0" . " / " . "#";}?></div>

                <span class="count_bottom"><i class="green"></i></span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"> Shares (Last hour)</span>
                <div class="count">
                <?php 
                  foreach($result_eth->workers as $workers){
                    echo "<i data-toggle='tooltip' data-placement='top' title='Valid'>" . $workers->validShares . "</i> / " . "<i data-toggle='tooltip' data-placement='top' title='Stale'>" . $workers->staleShares . "</i> / " . "<i data-toggle='tooltip' data-placement='top' title='Invalid'>" . $workers->invalidShares . "</i>";
                  }
                  // <i data-toggle="tooltip" data-placement="top" title="This is the Rough hashrate">

                 ?>
                </div>
                <span class="count_bottom"><i class="green"><i class=""></i></i></span>
              </div>

              <div class="col-md-3 col-sm-4 col-xs-12 tile_stats_count">
                <span class="count_top"> Hashrates</span>
                <div class="count">
                <!-- Rough -->
                <i data-toggle="tooltip" data-placement="top" title="This is the Rough hashrate">
                <?php  if($result_eth->reportedHashRate == 0){echo substr($result_eth->reportedHashRate,0, 2);}else{echo substr($result_eth->reportedHashRate, 0, 2) . substr($result_eth->reportedHashRate, 2, 2) . " MH/s";} ?>
                </i>

                <!-- Average (3hrs) -->
                <i data-toggle="tooltip" data-placement="top" title="This is the accurate hashrate reported over 3 hours">
<?php if($result_eth->hashRate == 0){echo substr($result_eth->hashRate,0, 2);}else{echo substr($result_eth->hashRate, 0, 2) . substr($result_eth->hashRate, 2, 2) . " MH/s";} ?>
  </i>
</div>
                <span class="count_bottom"></span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top">  Unpaid Balance</span>
                <div class="count">
                <?php
                $variable = strlen($result_eth->unpaid);
                 // $value = "Value: " . substr($price_usd * $sum,0,5) . " $";
                 // echo "<i data-toggle='tooltip' data-placement='top' title='" . $value . "'>";
                  if($variable == 17){
                    echo "0.0" . substr($result_eth->unpaid,0,5);
                  }elseif($variable == 18){
                    echo "0." . substr($result_eth->unpaid,0,5);
                  }elseif($variable == 19){
                    echo substr($result_eth->unpaid,0,1) . "." . substr($result_eth->unpaid, 1,5);
                  }elseif($variable == 16){
                    echo "0.00" . substr($result_eth->unpaid,0,5);
                  }else{
                    echo "error";
                  }


                 ?>



                </div>
              
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"> Total Payout</span>
                <div class="count">
                  <?php 
                  $sum = 0;
                  if(empty($result_eth->payouts)){
                    echo "0";
                  }else{

                    foreach($result_eth->payouts as $payment){
                     $variable = $payment->amount;
                    $sum+= $variable;
                    }
                    if(strlen($payment->amount) == 18){
                      $value = "Value: " . substr($price_usd * $sum, 0, 5) . " $";
                      echo "<i data-toggle='tooltip' data-placement='top' title='" . $value . "'>";
                      echo "0.0" . substr($sum, 0,1) . substr($sum, 1,5);
                      echo "</i>";
                    }else{
                      echo "Error";
                    }
                    // echo $sum;

                  }
                   ?>
                </div>
                
              </div>



               <div class="col-md-1 col-sm-4 col-xs-12 tile_stats_count">
               <span class="count_top">ETH / USD</span>
                <div class="count">
                <?php
                echo round($price_usd, 1) . " $";
                if($price_usd > 0){
                  echo " <i data-toggle='tooltip' data-placement='top' title='1hr Change' class='green glyphicon glyphicon-arrow-up'></i>";
                }elseif($price_usd < 0){
                  echo " <i data-toggle='tooltip' data-placement='top' title='1hr Change' class='red glyphicon glyphicon-arrow-down'></i>";
                }

                 ?>
               
                </div>
                <span class="count_bottom"><i class="green"><i class=""></i></i></span>
              </div>
            </div>
            <!-- /top tiles -->

              <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                 

                  <?php 
                  // // Eth unpaid
                  //   $variable = $result_eth->unpaid;
                  //   $variable_exploded = explode("E", $variable);
                  //   $variable_remove_dot = explode(".", $variable);
                  //    if($variable_exploded[1] == "+14"){
                  //    $unpaid =  "0.000" . substr($variable_remove_dot[0].$variable_remove_dot[1], 0,4);
                  //   }elseif($variable_exploded[1] == "+15"){
                  //    $unpaid =  "0.00" . substr($variable_remove_dot[0].$variable_remove_dot[1], 0,4);
                  //   }elseif($variable_exploded[1] == "+16"){
                  //    $unpaid =  "0.0" . substr($variable_remove_dot[0].$variable_remove_dot[1], 0,4);
                  //   }elseif($variable_exploded[1] == "+17"){
                  //       $unpaid = "0." . substr($variable_remove_dot[0].$variable_remove_dot[1], 0,4);
                  //   }

                  //     // Eth per min = $variable_exploded;
                  //     $variable = $result_eth->ethPerMin;
                  //   $variable_exploded = explode("-", $variable);
                  //   $variable_remove_dot = explode(".", $variable);
                  //   if($variable_exploded[1] == "6"){
                  //     $eth_min = "0.00000" . substr($variable_remove_dot[0].$variable_remove_dot[1], 0,4);
                  //   }elseif($variable_exploded[1] == "7"){
                  //       $eth_min = "0.000000" . substr($variable_remove_dot[0].$variable_remove_dot[1], 0,4);
                  //   }

                  //  // echo $result_eth->settings->minPayout;

                  //    $variable = $result_eth->settings->minPayout;
                  //    if($variable !== 1){
                  //   $variable_exploded = explode("E", $variable);
                  //   $variable_remove_dot = explode(".", $variable_exploded[0]);
                  //   }
                  //   if($variable_exploded[1] == "+16"){
                  //     $minpayout =  "0.0" . substr($variable_remove_dot[0].$variable_remove_dot[1], 0,4);
                  //   }elseif($variable_exploded[1] == "+17"){
                  //       $minpayout = "0." . substr($variable_remove_dot[0].$variable_remove_dot[1], 0,4);
                  //   }elseif($variable == 1){
                  //     $minpayout = $variable;
                  //   }else{
                  //     echo "error";
                  //   }
?>
<div class="progress">
<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
  aria-valuemin="0" aria-valuemax="100" style="width:40%">
 <?php echo round(($minpayout - $unpaid) / $eth_min / 60)  . " Hours until next payout"?>
  </div>
</div>
<?php







                   ?>

              </div>
              </div>


  <!-- Payout -->
  <div class="row">
  <?php if(empty($result_eth->payouts)){
  echo "";
  }else{ ?>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel tile fixed_height_320 overflow_hidden">
                  <div class="x_title">
                    <h2> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class='pull-right'><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Paid on</th>
                            <th>From Block</th>
                            <th>To Block</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php foreach($result_eth->payouts as $payment){
                              $strlen = $payment->amount;
                              echo "<tr>";
                              echo "<td>" . substr($payment->paidOn, 0,10) . "</td>";
                              echo "<td>$payment->id</td>";
                              echo "<td>$payment->end</td>";
                              echo "<td>";
                              if(strlen($payment->amount) == 18){
                              echo "0." . substr($payment->amount,0,5);
                              }elseif(strlen($payment->amount) == 17){
                                 echo "0.0" . substr($payment->amount,0,6);
                              }elseif(strlen($payment->amount) == 19){
                                echo substr($payment->amount, 0,1) . "." . substr($payment->amount, 1,5); 
                              }
                              echo "</td>";
                              echo "</tr>";
                              } 
                              ?>
                          </tr>

                        </tbody>
                      </table>

                  </div>
                </div>
              </div>
              <?php } ?>

            <!-- Estimated -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel tile fixed_height_320 overflow_hidden">
                  <div class="x_title">
                    <h2>Estimated earnings</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class='pull-right'><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Period</th>
                            <th>Eth</th>
                            <th>USD</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">Minute</th>

                            <td><?php
                              $variable = $result_eth->ethPerMin;
                              $variable_exploded = explode("-", $variable);
                              $variable_remove_dot = explode(".", $variable);
                              if($variable_exploded[1] == "6"){
                                echo "Ξ 0.00000" . substr($variable_remove_dot[0].$variable_remove_dot[1], 0,7);
                              }elseif($variable_exploded[1] == "7"){
                                  echo "0.000000" . substr($variable_remove_dot[0].$variable_remove_dot[1], 0,7);
                              }
                             ?></td>
                            <td><?php echo "$ " .  $result_eth->usdPerMin; ?></td>

                          </tr>
                          <tr>
                            <th scope="row">Hour</th>
                            <td><?php echo "Ξ " .  $result_eth->ethPerMin * 60; ?></td>
                            <td><?php echo "$ " .  $result_eth->usdPerMin * 60; ?></td>
                          </tr>
                         
                          <tr>
                            <th scope="row">Day</th>
                           <td><?php echo "Ξ " . $result_eth->ethPerMin * 1440; ?></td>
                           <td><?php echo "$ " .  $result_eth->usdPerMin * 1440; ?></td>
                          </tr>
                          <tr>
                            <th scope="row">Week</th>
                            <td><?php echo "Ξ " .  $result_eth->ethPerMin * 10080; ?></td>
                            <td><?php echo "$ " .  $result_eth->usdPerMin * 10080; ?></td>
                          </tr>
                          <tr>
                            <th scope="row">Month</th>
                           <td><?php echo "Ξ " .  $result_eth->ethPerMin * 43200; ?></td>
                           <td><?php echo "$ " .  $result_eth->usdPerMin * 43200; ?></td>
                          </tr>

                        </tbody>
                      </table>

                  </div>
                </div>
              </div>
            </div>

                          <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel tile  overflow_hidden">
                 
                  <div class="x_content">
                  <table class="table table-hover">
                    <th>Worker</th>
                    <th>Reported Hashrate</th>
                    <th>Current Hashrate</th>
                    <th>Valid Shares (1h)</th>
                    <th>Stale Shares (1h)</th>
                    <th>Invalid Shares (1h)</th>
                    <th>Last seen</th>

                        <?php
                        echo "<tr>";
                        foreach($result_eth->workers as $workerinfo){
                          echo "<td>".$workerinfo->worker."</td>";
                          echo "<td>".$workerinfo->reportedHashRate."</td>";
                          echo "<td>".$workerinfo->hashrate."</td>";
                          echo "<td>".$workerinfo->validShares."</td>";
                          echo "<td>".$workerinfo->staleShares."</td>";
                          echo "<td>".$workerinfo->invalidShares."</td>";

              
                          $timestamp = $workerinfo->workerLastSubmitTime;
                          $currenttime = time();
              
                          echo "<td>";
                          if($timestamp - $currenttime > 60){
                          echo substr($timestamp - $currenttime, 1,100) . " Sec ago";
                        }elseif($timestamp - $currenttime < 60){
                          $total = $timestamp - $currenttime;
                           echo substr($total / 60, 1,2) . " Min ago";
                        }
                          echo "</td>";
                          echo "</tr>";
                        } ?>


                  </table>




                  </div>
                </div>
              </div>
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
