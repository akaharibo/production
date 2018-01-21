               <body class="nav-md">
               <div class="se-pre-con"></div>
      <div class="container body">
        <div class="main_container">
          <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
              <div class="navbar nav_title" style="border: 0;">
                <a href="index.php" class="site_title" style='text-align:center;'> <span>CryptoSite</span></a>
              </div>


    

              <br />

            <!-- sidebar menu -->
            <!-- menu profile quick info -->

            <!-- /menu profile quick info -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
            <br />
                <h3>General</h3>

                <ul class="nav side-menu">
                  <li><a href='index.php'><i class="fa fa-dashboard"></i> Dashboard </a></li>
                  <li><a href='chart.php'><i class="fa fa-btc"></i> Chart </a></li>
                  <!-- <li><a href='chart.php'><i class="fa fa-connection"></i> Api Connections </a></li> -->



                <li><a href='my_coins.php'><i class="fa fa-line-chart"></i> My investments </a></li>


                <h3>Other</h3>
                  <li><a><i class="fa fa-dollar"></i> Miners <span class="fa fa-plus"></span></a>
                    <ul class="nav child_menu">
                    <?php if(!empty($_SESSION['user']['json_eth'])){ ?>
                    <li><a href="eth.php">Ethereum <b style='color:yellow';>[<?php floatingpoint_hashrate($result_eth->reportedHashRate) ?>]</b></a></li>
                    <?php } ?>
                    <?php if(!empty($_SESSION['user']['json_ubq'])){ ?>
                    <li><a href="ubiq.php">Ubiq <b style='color:yellow;'>[<?php floatingpoint_hashrate($result_ubq->currentHashrate); ?>]</b></a></li>
                      <?php } ?>
                    </ul>
                  </li>
                 <li><a href='settings.php'><i class="fa fa-user"></i> My Profile </a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->



