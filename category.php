<?php include('partials/top_bar.php'); ?>

  <!-- Guitar section starts -->
  <div class="categories__wrapper">
    <div class="container">
      <h2 class="header text__center">Explore Categories</h2>
      <div class="category__container">
        <?php 
    $sql = "SELECT * FROM CATEGORY";

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

    
  </div>
  <!-- Guitar section ends here -->

<?php include('partials/footer.php'); ?>