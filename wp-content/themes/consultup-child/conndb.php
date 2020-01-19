<?php  
    $host = 'localhost:8889';  
    $user = 'root';
    $pass = 'root';  
    $dbname = 'aamtdb';  
    $conn = mysqli_connect($host, $user, $pass,$dbname);  
    if(!$conn){  
        die('Could not connect: '.mysqli_connect_error());  
    }  
//    echo 'Connected successfully<br/>';
?>
