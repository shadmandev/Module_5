<?php
session_start();
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $_SESSION['isUserLogedIn'] = true;
    $_SESSION['role'] = "user";
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    // data File data
    $usernames = [];
    $emails = [];
    $roles = [];

    //$file = fopen( "./data.txt", "a" );
    // all data store
    $getdata = fopen("./data.txt","r");
    $getdataA = fopen("./data.txt","a");

    // all data store
    while ($line = fgets($getdata)) {
        $value = explode(' ', $line);
        $ids []= trim($value[0]);
        $usernames []= trim($value[2]);
        $emails []= trim($value[3]);
        $roles []= trim($value[1]);
        $passwords []= trim($value[4]);
    }

    for ( $i = 0; $i < count( $roles ); $i++ ) {
        if ($emails[$i] == "$email" || $usernames[$i] == "$username"  ) {
            echo "Username or Email Already Registered";
            fclose($getdata);
        } else {
            fwrite( $getdataA, "$id user $username $email $password\n" );
            fclose( $getdataA );
            header( "location: index.php" );
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Registration</div>
                    <div class="card-body">
                        <form action="registration.php" method="post">
                            <div class="form-group">
                                <?php
                                    $random_number = rand( 1, 100 );
                                ?>
                                <input type="hidden" name="id" value="<?=$random_number;?>">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>
