<?php
// databases info keys 
$db_localhost_name = "localhost";
$db_user_name = "root";
$db_passwor_key =  "root";
$db_databases_name = "shop_db";

$conn = mysqli_connect($db_localhost_name, $db_user_name, $db_passwor_key, $db_databases_name) or die('Əlaqə uğursuz oldu !');
?>
<?php
// session_start();
// if (isset($_SESSION["user"])) {
//    header("Location: login.php");
// }
?>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>İstifadəçi İdarə Paneli</title>
</head>
<body>
    <div class="container">
        <h1>İdarə Panelinə xoş gəlmisiniz</h1>
        <a href="login.php" class="btn btn-warning">Daxil ol</a>
    </div>
</body>
</html> -->