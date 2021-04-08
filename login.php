<?php include('partials/top_bar.php'); ?>

<?php 

  if(isset($_SESSION['user'])){
    header('location: index.php');
  }
  
  $error = '';
  if(isset($_POST['submit'])){
    
    //get data from the form
    $user_name = $_POST['user'];
    $user_pass = $_POST['pass'];

    //sql query
    $sql = "SELECT * FROM USER WHERE email='$user_name' and password='$user_pass'";

    //executing the query and saving the result
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);
    if($count == 0){
      $error = "Incorrect Password.";    
    }else {
      $rows = mysqli_fetch_assoc($res);
      $f_name = $rows['first_name'];
      $l_name = $rows['last_name'];
      $id = $rows['user_id'];

      $user_name = $f_name .' '. $l_name;
      $_SESSION['user'] = $user_name;
      $_SESSION['user_id'] = $id;
      // echo $_SESSION['user'];
      header('location: index.php');
    }
  }
?>
   

  <div class="login__container">
    <div class="login__header">
      <h1>Sign in or create an account</h1>
    </div>
    <div class="login__div">
      <form class="login__form"  method="POST">
        <!-- <label for="username">Username</label> -->
        <input type="text" name="user" id="email_address" placeholder="Email address" required>
        <!-- <label for="password">Password</label> -->
        <input type="password" name="pass" id="password" placeholder="Password" required>
        <div class="submit__button">
          <button type="submit" name="submit">Login</button>
        </div>
        <span class="error"><?php echo $error; ?></span>
    </form>

      <div class="join__now">
        <h3>Don't have an account.</h3>
        <h2 class="hyper__link"><a href="./join.php">Join Now!</a> </h2>
      </div>
    </div>
  </div>  


<?php include('partials/footer.php'); ?>
