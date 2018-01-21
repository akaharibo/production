  <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

<script>
    function getData(prefix, url) {
      $.getJSON(url, function(data) {
        $.each(data, function(key, val) {
          $('.' + prefix + '-' + key.toLowerCase()).html(val);
        });
      });
    }

 setInterval(function(){
getData('btc', 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD')
    }, 1500);

   setInterval(function(){
getData('eth', 'https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=USD')
    }, 1500);

  setInterval(function(){
getData('ubq', 'https://min-api.cryptocompare.com/data/price?fsym=UBQ&tsyms=USD')
    }, 1500);

</script>
<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs topnav_crypto">
  
      <i>BTC: $</i>
      <i class="usd btc-usd">Loading...</i>
</div>
<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs topnav_crypto">
      <i>ETH: $</i>
      <i class="usd eth-usd">Loading...</i>
    </div>
      <div class="col-lg-1 col-md-2 col-sm-2 hidden-xs topnav_crypto">
      <i>UBQ: $</i>
      <i class="usd ubq-usd">Loading...</i>
    </div>

              <ul class="nav navbar-nav navbar-right">
                              <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="data:image/png;base64,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" alt=""><?php echo $_SESSION['user']['user_username']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                      <li><a href="settings.php"> Settings</a></li>
                      <li><a href="tempupdate.php"> Update</a></li>
                    </li>
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

<!--                 <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->