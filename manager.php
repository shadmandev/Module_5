<?php
session_start();
if(isset($_SESSION['isUserLogedIn'])){
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    echo "<h1>Wlcome $username </h1> <p> You are $role</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="container">

        <a href="logout.php" class="btn btn-info">Logout</a>

</body>
</html>