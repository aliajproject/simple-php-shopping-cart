<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_description = $_POST['product_description'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Sorğu uğursuz oldu');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'Məhsul artıq səbətə əlavə edilib!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, price, name, image, quantity) VALUES('$user_id', '$product_price', '$product_name', '$product_image', '$product_quantity')") or die('Sorğu uğursuz oldu');
      $message[] = 'Məhsul səbətə əlavə edildi!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('Sorğu uğursuz oldu');
   $message[] = 'Səbətin miqdarı uğurla yeniləndi!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('Sorğu uğursuz oldu');
   header('location:index.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Sorğu uğursuz oldu');
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Alış səbəti</title>

   <!-- xüsusi css fayl bağlantısı  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

<div class="container">

<div class="user-profile">

   <?php

      $sql = "SELECT * FROM `user_info` WHERE id = '$user_id'";
      $select_user = mysqli_query($conn, $sql) or die('Sorğu uğursuz oldu');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

   <p> İstifadəçi adı : <span><?php echo $fetch_user['name']; ?></span> </p>
   <p> E-poçt : <span><?php echo $fetch_user['email']; ?></span> </p>
   <div class="flex">
      <a href="login.php" class="btn">Daxil olun</a>
      <a href="register.php" class="option-btn">Qeydiyyatdan keçin</a>
      <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Çıxış etmək istədiyinizə əminsiniz?');" class="delete-btn">Çıxın</a>
   </div>

</div>

<div class="products">

   <h1 class="heading">Ən son məhsullar</h1>

   <div class="box-container">

   <?php
      $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('Sorğu uğursuz oldu');
      if(mysqli_num_rows($select_product) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
   ?>
      <form method="post" class="box" action="">
         <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_product['name']; ?></div>
         <div class="price"><?php echo $fetch_product['price'].'₼'; ?>/-</div>
         <div class="description"><?php echo $fetch_product['description'].'₼'; ?>/-</div>
         <input type="number" name="product_quantity" value="1">
         <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
         <input type="hidden" name="product_description" value="<?php echo $fetch_product['description']; ?>">
         <input type="submit" value="Səbətə əlavə et" name="add_to_cart" class="btn">
      </form>
   <?php
      };
   };
   ?>

   </div>

</div>

<div class="shopping-cart">

   <h1 class="heading">Alış səbəti</h1>

   <table>
      <thead>
         <th>Şəkil</th>
         <th>Ad</th>
         <th>qiymət</th>
         <th>Kəmiyyət</th>
         <th>Ümumi qiymət</th>
         <th>Fəaliyyət</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Sorğu uğursuz oldu');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         <tr>
            <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td><?php echo $fetch_cart['price']."\t\t₼"; ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="update" class="option-btn">
               </form>
            </td>
            <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity'])."\t\t₼"; ?>/-</td>
            <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('Səbətdən element silinsin?');">Sil</a></td>
         </tr>
      <?php
         $grand_total = $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">Heç bir maddə əlavə edilməyib</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">Ümumi cəmi :</td>
         <td><?php echo $grand_total."\t\t₼"; ?>/-</td>
         <td><a href="index.php?delete_all" onclick="return confirm('Hamısı səbətdən silinsin?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Hamısını silin</a></td>
      </tr>
   </tbody>
   </table>

   <div class="cart-btn">  
      <a href="#" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Yoxlamaya davam edin</a>
   </div>

</div>

</div>

</body>
</html>