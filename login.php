<?php 
session_start();
include('inc/header.php'); ?>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method='POST'>
              <h1>Login</h1>
              <div>
                <input type="text" name='username' class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name='password' class="form-control" placeholder="Password" required="" />
              </div>
              <div>
              <input type='submit' class="btn btn-default submit" value='Log In' name='submit'>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="signup.php" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©2017 Akaharry</p>
                </div>
              </div>
            </form>

            <?php 
            if(isset($_POST['submit'])){
              if(!empty($_POST['username']) && !empty($_POST['password'])){
                $username = mysqli_real_escape_string($dbcon, $_POST['username']);
                $password = mysqli_real_escape_string($dbcon, $_POST['password']);

              

                 $query = "SELECT * FROM `users` WHERE `user_username` = '{$username}' AND `user_password` = '{$password}'";
                 echo $query;
                $result = mysqli_query($dbcon, $query) or die('SQL failed ' . mysqli_error($dbcon));

                 if(mysqli_num_rows($result) > 0){
                 $row = mysqli_fetch_assoc($result);



                $_SESSION['user']['user_id'] = $row['user_id'];
                $_SESSION['user']['user_username'] = $row['user_username'];
                $_SESSION['user']['json_eth'] = $row['user_eth_address'];
                $_SESSION['user']['json_ubq'] = $row['user_ubq_address'];


             include('session_api.php');

        header('location: index.php');
        exit();
        }
        }




                header('location: index.php');
                exit();
            } else {
                echo "";
        }





             ?>


          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" autocomplete="on" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" autocomplete="on" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.php">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1> Ss Alela!</h1>
                  <p>©2017 Akaharry</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
