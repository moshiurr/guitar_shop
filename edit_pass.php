<?php include('./partials/top_bar.php'); ?>

<?php 

  // if no user logged in, redirect to index page
  if(!isset($_SESSION['user'])){
    header('location: index.php');
  }

  $u_id = $_SESSION['user_id'];

  $error = '';

  // this saves the new password in the database
  if(isset($_POST['save_pass'])){

    // get data from the form
    $new_pass = $_POST['newpass'];
    $new_pass2 = $_POST['newpass2'];
    $pass = $_POST['password'];

    $sql = "SELECT password FROM USER WHERE user_id='$u_id'";

    $res = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($res);
    $data_pass = $rows['password'];

    if($data_pass == $pass){
      if($new_pass == $new_pass2){
        $sql = "UPDATE USER SET password='$new_pass' WHERE user_id='$u_id'";
        $res = mysqli_query($conn, $sql);
        if($res == false){
          $error = 'Something went wrong. Check your input.';
        }else{
          header('location: profile.php');
        }
      }else{
        $error = 'Passwords do not match';
      }
    }else {
      $error = 'Incorrect Password.';
    }
  }

?>

<section class="edit__section profile">

<h1 class="text__center">Edit Your Profile</h1>

<form class="login__form" action="" method="POST">
  <input type="password" name="newpass" placeholder="Enter new password" required>
  <input type="password" name="newpass2" placeholder="Confirm new password" required>
  <input type="password" name="password" placeholder="Enter Current Password" required>
  <div class="submit__button">
    <button type="submit" name="save_pass">Confirm Changes</button>
  </div>
  <span class="error"><?php echo $error; ?></span>
</form>

</section>

<?php include('./partials/footer.php'); ?>