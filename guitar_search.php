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
	
	<h2 class="header text__center">Search results for '<?php echo $search ; ?>'</h2>

      <?php

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count > 0){
          while($rows = mysqli_fetch_assoc($res)){
            $img_src = $rows['image_src'];
            $name = $rows['description'];
            $price = $rows['price'];
            $prd_id = $rows['product_id'];

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
        }else {
            ?>
            <div style="height: 30em; display: flex; justify-content: center; align-items: center;">
              <h2 class="text__center">No matching result found..!</h2>
            </div>
            <?php
          }
  ?>
	<div class="stop__float"></div>
</div>


<?php include('partials/footer.php'); ?>