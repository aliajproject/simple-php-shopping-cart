<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $sql = "SELECT * FROM `user_info` WHERE email = '$email' AND password = '$pass'";

   $select = mysqli_query($conn, $sql) or die('Sorğu uğursuz oldu');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = 'Səhv parol və ya e-poçt!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
   <title>login</title>

   <!-- custom css file link  -->
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
   
<div class="form-container">

   <form class="container" action="" method="post">
      <h3>İndi daxil olun</h3>
      <input type="email" name="email" required placeholder="E-poçtu daxil edin" class="box">
      <input type="password" name="password" required placeholder="Parol daxil edin" class="box">
      <input type="submit" name="submit" class="btn" value="İndi daxil olun">
      <!-- <a href="config.php" class="btn btn-warning">Admins</a> -->
      <p>Hesabınız yoxdur? <a target="_blank" href="register.php">İndi qeydiyyatdan keçin</a></p>
   </form>

</div>

</body>
</html>