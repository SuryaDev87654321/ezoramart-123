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
   <title>Mobiles</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>
<div class="heading">
   <h3>Latest Mobiles</h3>
</div>

<section class="products">
<div class="box-container">
<?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `mobiles` ") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name" ><?php echo $fetch_products['name']; ?></div>
      <h2>Specification </h2><br>
     <div class="Battery" ><label for="battery">Battery : </label><?php echo $fetch_products['Battery']; ?></div>
     <div class="RAM" ><label for="ram">RAM : </label><?php echo $fetch_products['RAM']; ?></div>
     <div class="ROM" > <label for="rom">ROM : </label><?php echo $fetch_products['ROM']; ?></div>
     <div class="Screen"> <label for="screen">Screen Size : </label><?php echo $fetch_products['Screen']; ?></div>
     <div class="Camera"><label for="camera">Camera : </label> <?php echo $fetch_products['Camera']; ?></div>
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
      <a href="shop.php" class="option-btn">load more</a>
   </div>
   </section>
   <!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>