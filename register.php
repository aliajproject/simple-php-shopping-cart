<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $sql = "SELECT *FROM `user_info` WHERE email = '$email' AND password = '$pass'";

   $select = mysqli_query($conn, $sql) or die('sorğu uğursuz oldu');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'İstifadəçi artıq mövcuddur!';
   }else{
      mysqli_query($conn, "INSERT INTO `user_info`(name, email, password) VALUES('$name', '$email', '$pass')") or die('sorğu uğursuz oldu');
      $message[] = 'Uğurla qeydiyyatdan keçdi!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Qeydiyyatdan keçin</title>

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

   <form action="" method="post">
      <h3>Qeydiyyat nömrəsiw</h3>
      <input type="text" name="name" required placeholder="İstifadəçi adını daxil edin" class="box">
      <input type="email" name="email" required placeholder="E-poçtu daxil edin" class="box">
      <input type="password" name="password" required placeholder="Parol daxil edin" class="box">
      <input type="password" name="cpassword" required placeholder="Parolu təsdiqləyin" class="box">
      <input type="submit" name="submit" class="btn" value="İndi qeydiyyatdan keçin">
      <p>Artıq hesabınız var? <a href="login.php">İndi daxil olun</a></p>
   </form>

</div>

</body>
</html>