<?php include('partials/top_bar.php'); ?>
   
<?php 
  if(isset($_SESSION['user'])){
    header('location: index.php');
  }

  $error = '';
  if(isset($_POST['register'])){

    //get data from the form
    $f_name = $_POST['firstname'];
    $l_name = $_POST['lastname'];
    $user = $_POST['email'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];

    if($pass == $pass2){
      $sql = "INSERT INTO USER (first_name, last_name, email, password) values ('$f_name', '$l_name', '$user', '$pass')";
      $res = mysqli_query($conn, $sql);

      if($res){
        $_SESSION['user'] = $f_name.' '.$l_name;

        $sql = "SELECT user_id FROM USER WHERE email='$user'";
        $res = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($res);
        $_SESSION['user_id'] = $rows['user_id'];

        header('location: index.php');
      }else {
        $error = "Account already exist with the same email.";
      }
    }else {
      $error = "Passwords do not match. Try Again!";
    }
  }
?>

  <div class="login__container">
    <div class="login__header">
      <h1>Create an account</h1>
    </div>
    <div class="login__div">
      <form class="login__form" action="" method="POST">
        <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <!-- <label for="password">Password</label> -->
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password2" placeholder="Confirm your password" required>
        <div class="submit__button">
          <button type="reset">Reset</button>
          <button type="submit" name="register">Register</button>
        </div>
        <span class="error"><?php echo $error; ?></span>
    </form>
    </div>
  </div>  


<?php include('partials/footer.php'); ?>

