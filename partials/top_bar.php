<?php
  include('connect_db.php');

  if(isset($_POST['logout'])){
      if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        unset($_SESSION['user_id']);
        header('location: index.php');
      }
  }

  if(isset($_POST['cart'])){
    if(isset($_SESSION['user'])){
      $product_id = $_POST['pr_id'];
      $u_id = $_SESSION['user_id'];

      $sql = "INSERT INTO CART_TABLE (user_id, product_id) values ('$u_id', '$product_id')";
      $res = mysqli_query($conn, $sql);

    }else{
      header('location: login.php');
    }
  }

  if(isset($_POST['delete'])){
    $product_id = $_POST['pr_id'];
    $u_id = $_SESSION['user_id'];

    $sql = "DELETE FROM CART_TABLE WHERE user_id= '$u_id' AND product_id='$product_id' LIMIT 1";

    $res = mysqli_query($conn, $sql);

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- css link -->
  <link rel="stylesheet" href="./css/style.css">

  <title>Guitar Shop</title>
</head>
<body>
  <!-- Nav var starts here -->
  <section class="nav__wrapper drop__shadow">
    <div class="container">
      <div class="nav__list">
        <ul class="nav__item">
          <li>
            <a href="./index.php"><img class="logo__pic" src="./assets/logo.png" alt="logo"></a>
          </li>
          <li>
            <a href="./guitar.php" class="menu">G U I T A R</a>
          </li>
          <li>
            <a href="./category.php" class="menu">C A T E G O R Y</a>
          </li>
        </ul>
  
        <ul class="nav__item join__us">
          <li>
            <a href="./login.php"><button class="btn__void btn__hover">Sign in</button></a>
          </li>
          <li>
            <a href="./join.php"><button class="btn__filled btn__hover">Join now</button></a>
          </li>
        </ul>

        <?php
            
        ?>

        <ul class="nav__item customer__info display__none">
          <li class="user_logout">

            <?php 
              if(isset($_SESSION['user'])){
                $user_name = $_SESSION['user'];
                $u_id = $_SESSION['user_id'];

                $sql = "SELECT * FROM CART_TABLE WHERE user_id='$u_id'";
                $res = mysqli_query($conn, $sql);
                $total_item = mysqli_num_rows($res);
              } 
            ?>

            <h3>Hi, <?php echo $user_name; ?></h3>
            <a href="buy.php"><h3 style="padding-left: 1em;">Cart Item(s): <?php echo $total_item; ?></h3></a>
            <form method="POST">
              <button type="submit" name="logout" class="out__btn">Log out</button>
            </form>
            
          </li>
        </ul>
      </div>

           <?php 
              if(isset($_SESSION['user'])){
              
              echo "<script> 
                document.querySelector('.join__us').classList.add('display__none');
                document.querySelector('.customer__info').classList.toggle('display__none');
                </script>";
            }else 
          ?>
      
    </div>
  </section>