<?php

// add memeber
if(isset($_POST['addMember'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $getdata = fopen("./data.txt","a");

        fwrite( $getdata, "$id $role $username $email $password\n" );
        fclose( $getdata );
        header( "location: ./role_management.php" );

}