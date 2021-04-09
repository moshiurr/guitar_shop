<?php include('./partials/top_bar.php'); ?>

<?php 

  if(!isset($_SESSION['user'])){
    header('location: index.php');
  }

  $u_id = $_SESSION['user_id'];

  $error = '';

  // this saves the updated user information into the database
  if(isset($_POST['save'])){

    // get data from the form
    $f_name = $_POST['firstname'];
    $l_name = $_POST['lastname'];
    $pass = $_POST['password'];

    $sql = "SELECT password FROM USER WHERE user_id='$u_id'";

    $res = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($res);
    $data_pass = $rows['password'];

    if($data_pass == $pass){
      $sql = "UPDATE USER SET first_name='$f_name', last_name='$l_name' WHERE user_id='$u_id'";
      $res = mysqli_query($conn, $sql);
      if($res == false){
        $error = 'Something went wrong. Check your input.';
      }else{
        $_SESSION['user'] = $f_name .' '. $l_name;
        header('location: profile.php');
      }
    }else {
      $error = 'Incorrect Password.';
    }
  }

?>

<section class="edit__section profile">

<h1 class="text__center">Edit Your Profile</h1>

<?php 
  $sql = "SELECT * FROM USER WHERE user_id='$u_id'";

  //executing the query and saving the result
  $res = mysqli_query($conn, $sql);

  $count = mysqli_num_rows($res);
  if($count > 0){
    $rows = mysqli_fetch_assoc($res);
    $f_name = $rows['first_name'];
    $l_name = $rows['last_name'];
  }

?>

<form class="login__form" action="" method="POST">
  <label for="firstname">First Name:</label>
  <input type="text" name="firstname" id="firstname" value="<?php echo $f_name ;?>" required>
  <label for="lastname">Last Name:</label>
  <input type="text" name="lastname" id="lastname" value="<?php echo $l_name ;?>" required>
  <label for="password">Enter Password:</label>
  <input type="password" name="password" placeholder="Password" required>
  <div class="submit__button">
    <button type="submit" name="save">Save Changes</button>
  </div>
  <span class="error"><?php echo $error; ?></span>
</form>

</section>

<?php include('./partials/footer.php'); ?>