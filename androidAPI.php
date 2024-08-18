<?php
// header('Content-Type: application/json');

// $a_val = $_POST['val'];
$a_val = 5;

// Database credentials
$host = '127.0.0.1:8080'; // or 'localhost'
$db = 'easy_blood';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Data Source Name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Your SQL query here
    $stmt = $pdo->query('SELECT * FROM test WHERE blood_gp > '.$a_val);

    $data = $stmt->fetchAll();

    // Encode the data as JSON and print it
    echo json_encode($data);

} catch (\PDOException $e) {
    // If there is an error, return a JSON error message
    echo json_encode(['error' => $e->getMessage()]);
}
?>
