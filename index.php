<?php
session_start();
if(isset($_SESSION['isUserLogedIn'])){
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    // echo "<h1>Welcome $username </h1> <p> You are $role</p>";
}else{
    header("location: ./login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <style>
        .wrapper{
            height: 100vh;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>Welcome <?php echo $username; ?> <span class="badge badge-primary"><?php echo $role; ?></span></div>
                            <div>
                                <a href="logout.php" class="btn btn-info">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>