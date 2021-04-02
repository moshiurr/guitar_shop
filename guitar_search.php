<?php include('partials/top_bar.php'); ?>

<?php 
	if(isset($_GET['search'])){
		$search = $_GET['search'];
	}else{
		header('location: index.php');
	}
	$sql = "SELECT * FROM PRODUCT WHERE description LIKE '%$search%'";
?>

<div class="container">
	
	<h2 class="header text__center">Explore Guitars</h2>

      <?php

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count > 0){
          while($rows = mysqli_fetch_assoc($res)){
            $img_src = $rows['image_src'];
            $name = $rows['description'];
            $price = $rows['price'];

            ?>

        <div class="box__item">
          <img class="img__responsive drop__shadow" src="<?php echo $img_src; ?>" alt="product_img">

          <h1><?php echo $name; ?></h1>
          <h4>Price: $<?php echo $price; ?></h4>
          <div class="buy__wrapper text__center">
            <button class="buy__btn ">Buy Now</button>
          </div>
        </div>

            <?php
          }
        }
  ?>
	<div class="stop__float"></div>
</div>


<?php include('partials/footer.php'); ?>