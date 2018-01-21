<?php session_start();
include('inc/header.php');
         $id = $_SESSION['user']['user_id'];


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
<div class="col-lg-12">


  <div class="col-lg-3">
    <div class="col-lg-12">
      <div class="x_panel tile" style="height:auto">
        <h4>Total Investment</h4>
        <h3 style='color:green'>$0</h3>
      </div>
     </div>
   </div>

  <div class="col-lg-3">
    <div class="col-lg-12">
      <div class="x_panel tile" style="height:auto">
        <h4>Net Worth</h4>
        <h3 style='color:green'>$0</h3>
      </div>
     </div>
   </div>

     <div class="col-lg-3">
    <div class="col-lg-12">
      <div class="x_panel tile" style="height:auto">
       <h4>Profit</h4>
       <h3 style='color:green'>$0</h3>

      </div>
     </div>
   </div>

     <div class="col-lg-3">
    <div class="col-lg-12">
      <div class="x_panel tile" style="height:auto">
         <h4>Active Profit</h4>
         <h3 style='color:green'>$0</h3>
      </div>
     </div>
   </div>

</div>
<div class="col-lg-12">
<div class="col-lg-4">
      <div class="x_panel tile" style="height:auto">
      </div>
      </div>

      <div class="col-lg-4">
      <div class="x_panel tile" style="height:auto">
      </div>
      </div>

      <div class="col-lg-4">
      <div class="x_panel tile" style="height:auto">
      </div>
      </div>

      <div class="col-lg-4">
      <div class="x_panel tile" style="height:auto">
      </div>
      </div>
      </div>
<?php



      if(isset($_GET['action'])){
  if($_GET['action'] == 'add'){
        ?>
<form id="" method='POST' data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rate <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='rate' id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='amount' id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fee <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='fee' id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Coin <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="heard" class="form-control" required>
                            <option value="">Choose..</option>
                            <option value="press">Press</option>
                            <option value="net">Internet</option>
                            <option value="mouth">Word of mouth</option>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                        <a href="?" class='btn btn-primary'>Cancel</a>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                        </div>
                      </div>
                    </form>
        <?php
  }
}

 $query = "SELECT * FROM myCoins
              INNER JOIN users on users.user_id = myCoins.fk_users
              INNER JOIN coins2 on coins2.coin_id = myCoins.fk_coins
              INNER JOIN btcHistory on btcHistory.btcHistory_id = myCoins.fk_btcHistory
              WHERE user_id = $id AND myCoins_active = '1' ORDER BY coin_name DESC";
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
          echo "<tr>";
          echo "<th><a href='?action=add'><i class='fa fa-plus-circle'></i></a></th>";
          if(isset($_GET['sortby']) && $_GET['sortby'] == 'asc'){
            echo "<th>Change 24h <a href='?action=sort&orderby=change&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          }else{
            echo "<th>Change 24h <a href='?action=sort&orderby=change&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          }
          if(isset($_GET['sortby']) && $_GET['sortby'] == 'asc'){
            echo "<th>Coin <a href='?action=sort&orderby=coin&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          }else{
            echo "<th>Coin <a href='?action=sort&orderby=coin&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          }
          if(isset($_GET['sortby']) && $_GET['sortby'] == 'asc'){
            echo "<th class='hidden-xs hidden-sm'>Amount <a href='?action=sort&orderby=amount&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          }else{
            echo "<th class='hidden-xs hidden-sm'>Amount <a href='?action=sort&orderby=amount&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          }
           if(isset($_GET['sortby']) && $_GET['sortby'] == 'asc'){
            echo "<th class='hidden-xs hidden-sm'>Rate <a href='?action=sort&orderby=rate&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          }else{
            echo "<th class='hidden-xs hidden-sm'>Rate <a href='?action=sort&orderby=rate&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          }
         if(isset($_GET['sortby']) && $_GET['sortby'] == 'asc'){
            echo "<th>Buy <a href='?action=sort&orderby=buy&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          }else{
            echo "<th>Buy <a href='?action=sort&orderby=buy&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          }
          if(isset($_GET['sortby']) && $_GET['sortby'] == 'asc'){
            echo "<th>Sell <a href='?action=sort&orderby=sell&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          }else{
            echo "<th>Sell <a href='?action=sort&orderby=sell&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          }
          if(isset($_GET['sortby']) && $_GET['sortby'] == 'asc'){
            echo "<th>+/- <a href='?action=sort&orderby=plusminus&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          }else{
            echo "<th>+/- <a href='?action=sort&orderby=plusminus&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          }


          // if(isset($_GET['sortby']) && $_GET['sortby'] == 'asc'){
          //   if(isset($_GET['orderby']) == 'change'){
          //      echo "<th>Change 24h <a href='?action=sort&orderby=change&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'coin'){
          //      echo "<th>Change 24h <a href='?action=sort&orderby=coin&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'amount'){
          //      echo "<th class='hidden-xs hidden-sm'>Change 24h <a href='?action=sort&orderby=amount&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'rate'){
          //      echo "<th class='hidden-xs hidden-sm'>Change 24h <a href='?action=sort&orderby=rate&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'buy'){
          //      echo "<th>Change 24h <a href='?action=sort&orderby=buy&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'sell'){
          //      echo "<th>Change 24h <a href='?action=sort&orderby=sell&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'plusminus'){
          //      echo "<th>Change 24h <a href='?action=sort&orderby=plusminus&sortby=asc'><i class='fa fa-sort-asc'></i></a></th>";
          //   }
          // }

          // if(isset($_GET['sortby']) && $_GET['sortby'] == 'desc'){
          // if(isset($_GET['orderby']) == 'change'){
          //   echo "<th>Change 24h <a href='?action=sort&orderby=change&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'coin'){
          //    echo "<th>Change 24h <a href='?action=sort&orderby=coin&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'amount'){
          //    echo "<th class='hidden-xs hidden-sm'>Change 24h <a href='?action=sort&orderby=amount&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'rate'){
          //    echo "<th class='hidden-xs hidden-sm'>Change 24h <a href='?action=sort&orderby=rate&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'buy'){
          //    echo "<th>Change 24h <a href='?action=sort&orderby=buy&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'sell'){
          //    echo "<th>Change 24h <a href='?action=sort&orderby=sell&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          //   }elseif(isset($_GET['orderby']) == 'plusminus'){
          //    echo "<th>Change 24h <a href='?action=sort&orderby=plusminus&sortby=desc'><i class='fa fa-sort-desc'></i></a></th>";
          //   }
          // }











          echo "<th class='hidden-xs hidden-sm'>Mark as sold</th>";
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
            

            if($row['percent_change_24h'] > 0){
              echo "<td style='color:green;font-weight:bold;'>$row[percent_change_24h]%</td>";
            }else{
              echo "<td style='color:red;font-weight:bold;'>$row[percent_change_24h]%</td>";
            }

          echo "<td>$row[coin_symbol]</td>";
          echo "<td class='hidden-xs hidden-sm'>$row[myCoins_amount]</td>";
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
        }elseif(strlen($row['coin_price_btc'] * $row['myCoins_amount']) == 7){
            echo "<td>" .substr($row['coin_price_btc'] * $row['myCoins_amount'],0,9) . "00" . "</td>";
        }else{
          echo "<td>" .substr($row['coin_price_btc'] * $row['myCoins_amount'],0,9) . "</td>";
        }



// +/-



        $v1 = $row['coin_price_btc'] * $row['myCoins_amount'];
        $v2 = $row['myCoins_rate'] * $row['myCoins_amount'];
        $v3 = $v1 - $v2;
              $test = explode('E-', $v3); //REMOVES E- AND GIVES THE NUMBER NEEDED
              // print_r($test);
          $test2 = explode('.', $test[0]); //REMOVES THE DECIMAL



if(isset($test[1]) && $test[1] == '5'){
     if($test2[0] < 0){
    $v3 = "-" . substr("0.0000" . substr($test2[0],1,5) . $test2[1],0,9);
    }elseif($test2[0] > 0){
      $v3 = "+" .substr("0.0000" . substr($test2[0],1,5) . $test2[1],0,9);
    }
}elseif(isset($test[1]) && $test[1] == '6'){
    if($test2[0] < 0){
    $v3 = "-" . substr("0.00000" . substr($test2[0],1,5) . $test2[1],0,9);
    }elseif($test2[0] > 0){
      $v3 = "+" .substr("0.00000" . substr($test2[0],1,5) . $test2[1],0,9);
    }
}elseif(isset($test[1]) && $test[1] == '7'){
    $v3 = "-" . substr("0.000000" . substr($test2[0],1,5) . $test2[1],0,9);
    }else{
      $v3 = '' . $v3;
    }
        echo "<td>" . substr($v3,0,10) ."</td>";










         echo "<td class='hidden-xs hidden-sm'><a href='?action=sold&id=$row[myCoins_id]' onclick=\"return confirm('Are you sure you want to mark this as sold?')\"><i class='fa fa-check-square'></i></a></td>";
         echo "</tr>";
       }
 





       echo "</tbody>";
       echo "</table>";
foreach($rows as $row){
       // echo "Total paid:" . substr($row['myCoins_rate'] * $row['myCoins_amount'],0,9) . "<br>";
       
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
