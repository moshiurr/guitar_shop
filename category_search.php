<?php include('partials/top_bar.php'); ?>

<?php 
	if(isset($_GET['category_id'])){
		$category_id = $_GET['category_id'];
	}else{
		header('location: index.php');
	}
	$sql = "SELECT cat_name FROM CATEGORY WHERE cat_id='$category_id'";
	$res = mysqli_query($conn, $sql);
	$rows = mysqli_fetch_assoc($res);
	$cat_name = $rows['cat_name'];
	
?>


<div class="container">
	<h2 class="header text__center">Showing Category: <?php echo $cat_name; ?></h2>
	<?php 

		$sql = "SELECT * FROM PRODUCT where cat_id='$category_id'";
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
            <form method="POST">
              <input type="hidden" name="pr_id" value="<?php echo $prd_id; ?>">
              <button class="buy__btn" name="cart">Add to cart</button>
            </form>
          </div>
        </div>

      			<?php
      		}
      	}

	?>
	<div class="stop__float"></div>
</div>


<?php include('partials/footer.php'); ?>