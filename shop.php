<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['submit_rating'])) {
    $name = $_POST['name'];
    $rating = (int)$_POST['rating'];

    // Check if user already rated this product
    $check_rating = mysqli_query($conn, "SELECT * FROM ratings WHERE user_id = '$user_id' AND name = '$name'");

    if(mysqli_num_rows($check_rating) > 0){
        mysqli_query($conn, "UPDATE ratings SET rating = '$rating' WHERE user_id = '$user_id' AND name = '$name'") or die('Update failed');
        $message[] = 'Rating updated!';
    } else {
        mysqli_query($conn, "INSERT INTO ratings(user_id, name, rating) VALUES('$user_id', '$name', '$rating')") or die('Insert failed');
        $message[] = 'Rating submitted!';
    }
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>our shop</h3>
   <p> <a href="home.php">home</a> / shop </p>
</div>
<br>

<section class="item-list">
   <div class="box-container">
<div class ="box">
<img src ="images/mobiles.png" alt="">
<div class ="share">
   <a href="mobiles.php" class="_1ch8e_" aria-label="mobiles">
   <h1 >Mobiles</h1>
   </a>
</div>
</div>

<div class ="box" >
<img src ="images/laptopbags.jpg" alt="">
<div class ="share">
   <a href="laptopbags.php" class="_1ch8e_" aria-label="laptopbags">
   <h1>Bags</h1>
   </a>
</div>
</div>

<div class ="box" >
<img src ="images/groceryproduct.jpg" alt="">
<div class ="share">
   <a href="grocery_product.php" class="_1ch8e_" aria-label="grocery_product">
   <h1 >Grocery Product</h1>
   </a>
</div>
</div>

<div class ="box" >
<img src ="images/footwear.jpg" alt="">
<div class ="share">
   <a href="footwear.php" class="_1ch8e_" aria-label="footwear">
   <h1 >Footwear</h1>
   </a>
</div>
</div>

<div class ="box" >
<img src ="images/electric_appliance.jpg" alt="">
<div class ="share">
   <a href="electric_appliances.php" class="_1ch8e_" aria-label="electric_appliances">
   <h1 >Electric Appliances</h1>
   </a>
</div>
</div>

<div class ="box" >
<img src ="images/beauty_product.jpg" alt="">
<div class ="share">
   <a href="beauty_products.php" class="_1ch8e_" aria-label="beauty_products">
   <h1 >Beauty Product</h1>
   </a>
</div>
</div>

</div>
</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `mobiles` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <?php
   $name = $fetch_products['name'];
   $rating_query = mysqli_query($conn, "SELECT AVG(rating) as avg_rating, COUNT(*) AS total_ratings FROM ratings WHERE name = '$name'");
   $rating_data = mysqli_fetch_assoc($rating_query);
   $avg_rating = round($rating_data['avg_rating'], 1);
?>
<div class="avg-rating">Average Rating: 
    <?php
        for ($i = 1; $i <= 5; $i++) {
            echo $i <= round($avg_rating) ? '★' : '☆';
        }
        echo " ($avg_rating)";
    ?>
</div>
      <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
       <input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>">
      <label>Rate this product:</label>
      <select name="rating">
         <option value="">Select</option>
         <option value="1">★</option>
         <option value="2">★★</option>
         <option value="3">★★★</option>
         <option value="4">★★★★</option>
         <option value="5">★★★★★</option>
      </select>
      <input type="submit" name="submit_rating" value="Submit Rating" class="white-btn">

      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
    </div>
    <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="mobiles.php" class="option-btn">load more</a>
   </div>  
</section>

<section class="products">
<h1 class="title">latest Bags</h1>
<div class="box-container">
<?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `laptopbags` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name" ><?php echo $fetch_products['name']; ?></div>
      <?php
   $name = $fetch_products['name'];
   $rating_query = mysqli_query($conn, "SELECT AVG(rating) as avg_rating, COUNT(*) AS total_ratings FROM ratings WHERE name = '$name'");
   $rating_data = mysqli_fetch_assoc($rating_query);
   $avg_rating = round($rating_data['avg_rating'], 1);
?>
<div class="avg-rating">Average Rating: 
    <?php
        for ($i = 1; $i <= 5; $i++) {
            echo $i <= round($avg_rating) ? '★' : '☆';
        }
        echo " ($avg_rating)";
    ?>
</div>

      <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
       <input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>">
      <label>Rate this product:</label>
      <select name="rating">
         <option value="">Select</option>
         <option value="1">★</option>
         <option value="2">★★</option>
         <option value="3">★★★</option>
         <option value="4">★★★★</option>
         <option value="5">★★★★★</option>
      </select>
      <input type="submit" name="submit_rating" value="Submit Rating" class="white-btn">

      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="laptopbags.php" class="option-btn">load more</a>
   </div>
   </section>

   <section class="products">
   <h1 class="title">latest Grocery Product</h1>
<div class="box-container">
<?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `grocery_products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name" ><?php echo $fetch_products['name']; ?></div>
      <?php
   $name = $fetch_products['name'];
   $rating_query = mysqli_query($conn, "SELECT AVG(rating) as avg_rating, COUNT(*) AS total_ratings FROM ratings WHERE name = '$name'");
   $rating_data = mysqli_fetch_assoc($rating_query);
   $avg_rating = round($rating_data['avg_rating'], 1);
?>
<div class="avg-rating">Average Rating: 
    <?php
        for ($i = 1; $i <= 5; $i++) {
            echo $i <= round($avg_rating) ? '★' : '☆';
        }
        echo " ($avg_rating)";
    ?>
</div>

      <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
       <input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>">
      <label>Rate this product:</label>
      <select name="rating">
         <option value="">Select</option>
         <option value="1">★</option>
         <option value="2">★★</option>
         <option value="3">★★★</option>
         <option value="4">★★★★</option>
         <option value="5">★★★★★</option>
      </select>
      <input type="submit" name="submit_rating" value="Submit Rating" class="white-btn">

      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="grocery_product.php" class="option-btn">load more</a>
   </div>
   </section>

   <section class="products">
   <h1 class="title">latest Footwear Product</h1>
<div class="box-container">
<?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `footwear` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name" ><?php echo $fetch_products['name']; ?></div>
      <?php
   $name = $fetch_products['name'];
   $rating_query = mysqli_query($conn, "SELECT AVG(rating) as avg_rating, COUNT(*) AS total_ratings FROM ratings WHERE name = '$name'");
   $rating_data = mysqli_fetch_assoc($rating_query);
   $avg_rating = round($rating_data['avg_rating'], 1);
?>
<div class="avg-rating">Average Rating: 
    <?php
        for ($i = 1; $i <= 5; $i++) {
            echo $i <= round($avg_rating) ? '★' : '☆';
        }
        echo " ($avg_rating)";
    ?>
</div>

      <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
       <input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>">
      <label>Rate this product:</label>
      <select name="rating">
         <option value="">Select</option>
         <option value="1">★</option>
         <option value="2">★★</option>
         <option value="3">★★★</option>
         <option value="4">★★★★</option>
         <option value="5">★★★★★</option>
      </select>
      <input type="submit" name="submit_rating" value="Submit Rating" class="white-btn">

      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="footwear.php" class="option-btn">load more</a>
   </div>
   </section>

   <section class="products">
   <h1 class="title">latest Electric Appliances Product</h1>
<div class="box-container">
<?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `ea` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name" ><?php echo $fetch_products['name']; ?></div>
      <?php
   $name = $fetch_products['name'];
   $rating_query = mysqli_query($conn, "SELECT AVG(rating) as avg_rating, COUNT(*) AS total_ratings FROM ratings WHERE name = '$name'");
   $rating_data = mysqli_fetch_assoc($rating_query);
   $avg_rating = round($rating_data['avg_rating'], 1);
?>
<div class="avg-rating">Average Rating: 
    <?php
        for ($i = 1; $i <= 5; $i++) {
            echo $i <= round($avg_rating) ? '★' : '☆';
        }
        echo " ($avg_rating)";
    ?>
</div>

      <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
    <input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>">
      <label>Rate this product:</label>
      <select name="rating">
         <option value="">Select</option>
         <option value="1">★</option>
         <option value="2">★★</option>
         <option value="3">★★★</option>
         <option value="4">★★★★</option>
         <option value="5">★★★★★</option>
      </select>
      <input type="submit" name="submit_rating" value="Submit Rating" class="white-btn">
   
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="electric_appliances.php" class="option-btn">load more</a>
   </div>
   </section>
   
   <section class="products">
   <h1 class="title">latest Beauty Product</h1>
<div class="box-container">
<?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `beauty_product` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name" ><?php echo $fetch_products['name']; ?></div>
      <?php
   $name = $fetch_products['name'];
   $rating_query = mysqli_query($conn, "SELECT AVG(rating) as avg_rating, COUNT(*) AS total_ratings FROM ratings WHERE name = '$name'");
   $rating_data = mysqli_fetch_assoc($rating_query);
   $avg_rating = round($rating_data['avg_rating'], 1);
?>
<div class="avg-rating">Average Rating: 
    <?php
        for ($i = 1; $i <= 5; $i++) {
            echo $i <= round($avg_rating) ? '★' : '☆';
        }
        echo " ($avg_rating)";
    ?>
</div>

      <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
       <input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>">
      <label>Rate this product:</label>
      <select name="rating" >
         <option value="">Select</option>
         <option value="1">★</option>
         <option value="2">★★</option>
         <option value="3">★★★</option>
         <option value="4">★★★★</option>
         <option value="5">★★★★★</option>
      </select>
      <input type="submit" name="submit_rating" value="Submit Rating" class="white-btn">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="beauty_products.php" class="option-btn">load more</a>
   </div>
   </section>
<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>