


<?php
$host = '127.0.0.1';  // Host name
$db = 'jobguru'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
