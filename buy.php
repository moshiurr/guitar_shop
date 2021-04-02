<?php include('partials/top_bar.php'); ?>



<div class="product__wrapper">
	<div class="container">
		<h2 style="padding: 2em;">Hey <?php echo $user_name; ?>, Your cart is given below :-</h2>

		<div class="cart_container">

			<?php
				$sql = "SELECT * FROM CART_TABLE WHERE user_id='$u_id'";
      			$res = mysqli_query($conn, $sql);
      			$count = mysqli_num_rows($res);
      			$total_price = 0;
      			if($count > 0){
      				while ($rows = mysqli_fetch_assoc($res)) {
      					$p_id = $rows['product_id'];
      					$qry = "SELECT * FROM PRODUCT WHERE product_id='$p_id'";
      					$out = mysqli_query($conn, $qry);
      					$out_res = mysqli_fetch_assoc($out);
      					$img_src = $out_res['image_src'];
      					$name = $out_res['description'];
      					$price = $out_res['price'];
      					$total_price = $total_price + $price;
      				?>

			<div class="cart_item drop__shadow">
				<img class="cart__responsive " src="<?php echo $img_src; ?>">
				<div style="display: flex; justify-content: space-around; width: 100%">
					<div>
						<h1><?php echo $name; ?></h1>
					<h3 style="padding-top: 1em;">Price: $<?php echo $price; ?></h2>
					</div>
					<div style="display: flex; align-items: center;">
						<form method="POST">
							<input type="hidden" name="pr_id" value="<?php echo $p_id; ?>">
							<button class="delete__btn" name="delete">remove</button>
						</form>
					</div>
				</div>
			</div>

			<?php  
			      	}
			      	echo '<div style="display: flex; padding-left: 10em; align-items: center;">
			<h2 style="padding-right: 2em;">Total Price: $' . $total_price . '</h2>
			<form method="POST">
				<button name="confirm" class="confirm__btn">confirm purchase</button>
			</form>
		</div>';
      		}else{
      			echo '<div><h2 class="text__center" style="margin-bottom: 1.5em;">You have no item in the cart!</h2></div>';
      		}
		?>
		
		</div>
	</div>
</div>

<?php 
	 if(isset($_POST['confirm'])){
    	$sql = "SELECT * FROM CART_TABLE WHERE user_id= '$u_id'";
    	$res = mysqli_query($conn, $sql);

    	$count = mysqli_num_rows($res);

    	if($count>0){
    		while ($rows = mysqli_fetch_assoc($res)) {
    			$product_id = $rows['product_id'];
    			$qry = "UPDATE PRODUCT SET bought = bought + 1 WHERE product_id = '$product_id'";

    			$out_put = mysqli_query($conn, $qry);
    		}
    	}


    	$sql = "DELETE FROM CART_TABLE WHERE user_id= '$u_id'";
    	$res = mysqli_query($conn, $sql);

    	header('location: complete.php');
  	}
 ?>

<?php include('partials/footer.php'); ?>