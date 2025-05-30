<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-products">
   <h1 class="title">Shop Products</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Item List</h3>
      <select name="user_type" class="box" id="productSelect" onchange="navigateToPage(this)">
         <option value="" disabled selected>Select a product</option>
         <option value="mobiles_form.php">Mobiles</option>
         <option value="Laptopbags_form.php">Bags</option>
         <option value="grocery_product_form.php">Grocery Product</option>
         <option value="footwear_form.php">Footwear</option>
         <option value="electric_appliances_form.php">Electric Appliances</option>
         <option value="beauty_products_form.php">Beauty Product</option>
      </select>
   </form>
</section>

<script>
function navigateToPage(select) {
    let selectedValue = select.value;
    if (selectedValue) {
        window.location.href = selectedValue; // Redirects to the selected URL
    }
}
</script>


</body>
</html>