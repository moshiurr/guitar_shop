<?php include('./partials/top_bar.php'); ?>


<!-- gets the required user data from the database -->
<?php
  if(isset($_SESSION['user_id'])){
    $u_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM USER WHERE user_id = '$u_id'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);
    if($count > 0){
      $rows = mysqli_fetch_assoc($res);
      $f_name = $rows['first_name'];
      $l_name = $rows['last_name'];
      $email = $rows['email'];
    }

  }else{
    header('location: login.php');
  }
?>

<section class="profile">
  <img class="profile__pic" src="./assets/user.png" alt="user_photo">

  <h3>First Name: <?php echo $f_name; ?></h3>
  <h3>Last Name: <?php echo $l_name; ?></h3>
  <h3>Email: <?php echo $email; ?></h3>
  <div class="submit__button">
    <a href="./edit_profile.php"><button>Edit Profile</button></a>
    <a href="./edit_pass.php"><button>Change Password</button></a>
  </div>
</section>

<?php include('./partials/footer.php'); ?>