<?php session_start();
include('inc/header.php'); ?>
<?php
$result_ubq = json_decode($_SESSION['cryptocoin']['json_ubq']);
 ?>




<?php 
include('inc/sidebar.php');
 ?>


          </div>
        </div>

       <?php include('inc/topnav.php'); ?>

        <!-- page content -->



        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"> Active Workers</span>
              <div class="count"><?php echo $result_ubq->workersOnline; ?></div>

            
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"> Hashrates</span>
              <div class="count">
                 <?php
                    $variable = strlen($result_ubq->currentHashrate);
                    if($variable == 7){
                     echo substr($result_ubq->currentHashrate, 0, 1) . "." . substr($result_ubq->currentHashrate, 0, 2) . " MH/s";
                    }elseif($variable == 8){
                      echo substr($result_ubq->currentHashrate, 0, 2) . "." . substr($result_ubq->currentHashrate, 2, 2) . " MH/s";
                    }elseif($variable == 9){
                      echo substr($result_ubq->currentHashrate, 0, 3) . "." . substr($result_ubq->currentHashrate, 2, 3) . " MH/s";
                    }else{
                      echo "0";
                    }

                    echo " ";

                    $variable = strlen($result_ubq->hashrate);
                    if($variable == 7){
                     echo substr($result_ubq->hashrate, 0, 1) . "." . substr($result_ubq->hashrate, 0, 2) . " MH/s";
                    }elseif($variable == 8){
                      echo substr($result_ubq->hashrate, 0, 2) . "." . substr($result_ubq->hashrate, 2, 2) . " MH/s";
                    }elseif($variable == 9){
                      echo substr($result_ubq->hashrate, 0, 3) . "." . substr($result_ubq->hashrate, 2, 3) . " MH/s";
                    }else{
                      echo "0";
                    }
                    ?>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"> Unpaid Balance</span>
             
              <div class="count">
                 <?php 
                 $variable = $result_ubq->stats->balance;
                    if(strlen($variable) == 1){
                      echo "0.00000000" . substr($variable,0,4);
                    }elseif(strlen($variable) == 2){
                      echo "0.0000000" . substr($variable,0,4);
                    }elseif(strlen($variable) == 3){
                      echo "0.000000" . substr($variable,0,4);
                    }elseif(strlen($variable) == 4){
                      echo "0.00000" . substr($variable,0,4);
                    }elseif(strlen($variable) == 5){
                      echo "0.0000" . substr($variable,0,4);
                    }elseif(strlen($variable) == 6){
                      echo "0.000" . substr($variable,0,4);
                    }elseif(strlen($variable) == 7){
                      echo "0.00" . substr($variable,0,4);
                    }elseif(strlen($variable) == 8){
                      echo "0.0" . substr($variable,0,4);
                    }elseif(strlen($variable) == 9){
                      echo "0." . substr($variable,0,5);
                    }elseif(strlen($variable) == 10){
                      echo substr($variable, 0,1) . "." . substr($variable, 1,100);
                    }else{
                      echo "error";
                    }
               ?>
              </div>

            </div>
            <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"> Total payout</span>
              <div class="count"><?php

              $sum = 0;
              foreach($result_ubq->payments as $amount){
              $total = $amount->amount;
                $sum+= $total;
              }
                $strlen = strlen($sum);
              if($strlen == 10){
                echo substr($sum, 0,1) . "." . substr($sum, 1,5);
              }elseif($strlen == 9){
                echo "0." . substr($sum, 0,6);
              }elseif($strlen == 11){
                 echo substr($sum, 0,2) . "." . substr($sum, 2,4);
              }else{
                echo "error";
              }


               ?></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top">Last Share</span>
              <div class="count">
               <?php
                $currenttime = time();
                $timestamp = $result_ubq->stats->lastShare;
                $variable = $currenttime - $timestamp;

                if($variable < 60){
                  echo $variable . " sec ago";
                }elseif($variable > 60 && $variable < 600){
                  echo substr($variable / 60, 0,1) . " min ago";
                }elseif($variable > 600 && $variable < 3200){
                  echo substr($variable / 60, 0,2). " mins ago";
                }elseif($variable > 3200){
                  echo substr($variable / 60  / 60,0,2) . " Hour ago";
                }else{
                  echo "Error";
                }
                ?>
              </div>
            </div>

            <div class="col-md-1 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top">UBQ / USD</span>
              <div class="count">
             <?php
             echo round($price_usd, 3) . " $";
             if($price_change > 0){
              echo " <i data-toggle='tooltip' data-placement='top' title='1hr Change' class='green glyphicon glyphicon-arrow-up'></i>";
             }elseif($price_change < 0){
              echo " <i data-toggle='tooltip' data-placement='top' title='1hr Change' class='red glyphicon glyphicon-arrow-down'></i>";
             }
                ?>
              </div>
            </div>

          </div>
          <!-- /top tiles -->

            <!-- Payout -->
  <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel tile fixed_height_320 overflow_hidden">
                  <div class="x_title">
                    <h2>Payouts</h2>
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
                            <th>Amount</th>
                            <th>Tx</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php foreach($result_ubq->payments as $payment){
                              echo "<tr>";
                              echo "<td>";
                                $timestamp = $payment->timestamp;
                                echo date('Y-m-d',$timestamp);
                              echo "</td>";

                              // echo "<td>" . substr($payment->timestamp, 0,10) . "</td>";
                               echo "<td>";
                                $variable = strlen($payment->amount);
                                if($variable == 9){
                                  echo "0." . $payment->amount;
                                }elseif($variable == 10){
                                  echo substr($payment->amount, 0, 1) . "." . substr($payment->amount, 1, 100);
                                }elseif($variable == 11){
                                  echo "11";
                                }else{
                                  echo "Error";
                                }

                               echo "</td>";
                              echo "<td>" . substr($payment->tx, 0,20) . "..." . "</td>";
                              echo "</tr>";
                              } ?>
                          </tr>

                        </tbody>
                      </table>

                  </div>
                </div>
              </div>

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
                            <th>UBQ</th>
                            <th>USD</th>
                            <th>BTC</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">Minute</th>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">Hour</th>
                          <td></td>
                          <td></td>
                          <td></td>
                          </tr>
                          <tr>
                            <th scope="row">Day</th>
                          <td></td>
                          <td></td>
                          <td></td>
                          </tr>
                          <tr>
                            <th scope="row">Week</th>
                           <td></td>
                           <td></td>
                           <td></td>
                          </tr>
                          <tr>
                            <th scope="row">Month</th>
                           <td></td>
                           <td></td>
                           <td></td>
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

                     


                  </table>




                  </div>
                </div>
              </div>
              </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="chart_plot_01" class="demo-placeholder"></div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Top Campaign Performance</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Facebook Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Twitter Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Conventional Media</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Bill boards</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>App Versions</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>App Usage across versions</h4>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.2</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>123k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.3</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>53k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.4</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>23k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.5</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>3k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.6</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>1k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Device Usage</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Device</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p class="">Progress</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>IOS </p>
                            </td>
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Android </p>
                            </td>
                            <td>10%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Blackberry </p>
                            </td>
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Symbian </p>
                            </td>
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Others </p>
                            </td>
                            <td>1%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Quick Settings</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                      </li>
                    </ul>

                    <div class="sidebar-widget">
                        <h4>Profile Completion</h4>
                        <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                        <div class="goal-wrapper">
                          <span id="gauge-text" class="gauge-value pull-left">0</span>
                          <span class="gauge-value pull-left">%</span>
                          <span id="goal-text" class="goal-value pull-right">1%</span>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

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
