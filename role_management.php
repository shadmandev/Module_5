<?php
session_start();
if(isset($_SESSION['isUserLogedIn'])){
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    
    // data File data
    $ids = [];
    $usernames = [];
    $emails = [];
    $roles = [];
    $passwords = [];

    // DATA FILE
    $getdata = fopen("./data.txt","r");

    // all data store
    while ($line = fgets($getdata)) {
        $value = explode(' ', $line);
        $ids []= trim($value[0]);
        $usernames []= trim($value[2]);
        $emails []= trim($value[3]);
        $roles []= trim($value[1]);
        $passwords []= trim($value[4]);
    }
    fclose($getdata);


}


if(isset($_POST['changeRole'])) {
    $id = $_POST['id'];
    $newRole = $_POST['nowRole'];
    $email = $_POST['email'];
    $changeUsername = $_POST['username'];

    $index = array_search($id, $ids);

    $roles[$index] = $newRole;
    $emails[$index] = $email;
    $usernames[$index] = $changeUsername;

    $file = fopen("./data.txt", "w");
    for ($i = 0; $i < count($usernames); $i++) {
        fwrite($file,$ids[$i]. ' '. $roles[$i] . ' ' . $usernames[$i] . ' ' . $emails[$i] . ' '. $passwords[$i] . ' ' . "\n");
    }
    fclose($file);
}

// delete section
if(isset($_GET['delete'])){

$id_to_delete = $_GET['deleteID']; 

$file_path = "data.txt";
$temp_file_path = "temp_data.txt";

$handle = fopen($file_path, "r");
$temp_handle = fopen($temp_file_path, "w");

if ($handle && $temp_handle) {
    while (($line = fgets($handle)) !== false) {
        $parts = explode(' ', $line);
        $record_id = trim($parts[0]); 

        if ($record_id != $id_to_delete) {
            fwrite($temp_handle, $line);
        }
    }

    fclose($handle);
    fclose($temp_handle);

    rename($temp_file_path, $file_path);

    echo "Record with ID $id_to_delete deleted successfully.";
    header("location: ./role_management.php");
} else {
    echo "Error opening the file.";
}
   
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Table Example</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="mb-5">

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
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-1">ID</th>
                                    <th class="col-2">Role</th>
                                    <th class="col-2">User Name</th>
                                    <th class="col-3">Email</th>
                                    <th class="col-4">Role</th>
                                    <th class="col-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($roles as $key => $role) {
                                        $username = $usernames[$key];
                                        $email = $emails[$key];
                                        $id = $ids[$key];
                                ?>
                                <tr>
                                <form method="POST" >
                                    <td><?= $id ?></td>
                                    <td><?= $role ?></td>
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <td><input type="text" name="username" value="<?= $username ?>"></td>
                                    <td><input type="email" name="email" value="<?= $email ?>"></td>
                                    <td>
                                        <select class="form-select" name="nowRole" id="">
                                            <option value="admin">admin</option>
                                            <option value="manager">Manager</option>
                                            <option value="User">User</option>
                                        </select>
                                        <input class="bg-warning btn" type="submit" name="changeRole" value="Update">
                                    </td>
                                </form>
                                <td>
                                    <form method="GET">
                                        <input type="hidden" name="deleteID" value="<?= $id ?>">
                                        <input name="delete" type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Add New User</div>
                    <div class="card-body">
                        <form method="post" action="addMember.php" class="col-12">
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
                            <select class="form-control col-12 mb-4" name="role">
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="User">User</option>
                            </select>
                            <input type="submit" name="addMember" class="col-12 btn btn-primary" value="Add Member">
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
