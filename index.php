<?php include('partials/top_bar.php'); ?>

<?php 
  if(isset($_POST['search'])){
    $search_text = $_POST['search'];
    header('location: guitar_search.php?search='.$search_text);
  }
 ?>

  <!-- nav var ends here -->

  <!-- guitar search starts here -->

<section class="search__wrapper">
  <div>
    <div class="search__img" style="background-image: url(./assets/search_2.jpeg); height: 15em; object-fit: fill; display: flex;
    justify-content: center; align-items: center;" >
       <form method="POST">
         <input type="search" name="search" placeholder="Search for guitar..." required style="height: 4em; width: 40em; padding-left: 1em;">
         <input type="submit" name="submit" value="Search" style="height: 4em; width: 7em; margin-left: 1em; color: white; background-color: black;">
       </form>
  </div>  
    </div>
   
</section>

  <!-- guitar search ends here -->

  <!-- most popular section start here -->
  <section class="popular__wrapper">
    <div class="container">
      <h2 class ="header text__center">Most Popular Item</h2>

	<?php 
      	$sql = "SELECT * FROM PRODUCT ORDER BY bought DESC LIMIT 4";

      	$res = mysqli_query($conn, $sql);

      	$count = mysqli_num_rows($res);

      	if($count > 0){
      		while($rows = mysqli_fetch_assoc($res)){
      			$img_src = $rows['image_src'];
      			$name = $rows['description'];
      			$price = $rows['price'];
      			$prd_id = $rows['product_id'];

      			?>

      	<div class="box popular__box">
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
    
  </section>
  <!-- most popular end here -->

  <!-- categories start here -->

  <section class="categories__wrapper">
    <div class="container">
      <h2 class ="header text__center">Categories</h2>

      <div class="category__container">
      <?php 
  	$sql = "SELECT * FROM CATEGORY LIMIT 6";

  	$res = mysqli_query($conn, $sql);

      	$count = mysqli_num_rows($res);

      	if($count > 0){
      		while($rows = mysqli_fetch_assoc($res)){
      			$name = $rows['cat_name'];
      			$cat_id = $rows['cat_id'];
      	?>
      <a href="category_search.php?category_id=<?php echo $cat_id; ?>">
      	<div class="category__box">
      		<img class="cat__responsive drop__shadow" src="assets/categories/<?php echo($name);?>.jpeg" alt="Category name">

      		<h1 class="text__center"><?php echo $name; ?></h1>
    	</div>
      </a>

      	<?php

      	}
  	}

  ?>
    <div class="stop__float"></div>
	</div>
    </div>
  </section>
  <!-- categories end here -->

<?php include('partials/footer.php'); ?>
