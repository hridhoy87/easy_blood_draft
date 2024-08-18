<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set the content type to JSON
header('Content-Type: application/json');

// Allow cross-origin requests (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Check if the POST request has the required parameter
if (!empty($_POST['bloodGP'])) {
    // Database connection details
    $SERVER = '127.0.0.1';
    $DB_USER = 'root';
    $DB_PASSWORD = '';
    $DB_NAME = 'easy_blood';

    // Create connection
    $conn = new mysqli($SERVER, $DB_USER, $DB_PASSWORD, $DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
        exit();
    }

    // Sanitize and retrieve the blood group from POST data
    $bdGP = $conn->real_escape_string($_POST['bloodGP']);
    $output_stream = array();

    // SQL query to fetch data
    $query = "SELECT 
                bbdb.id AS id,
                bbdb.name, 
                state.{$bdGP} AS qty, 
                price.{$bdGP} AS ppb, 
                bbdb.lat,
                bbdb.long,
                bbdb.plus_code AS loc,
                state.last_updated_at 
            FROM `easy_blood`.`bbdb` 
            INNER JOIN `easy_blood`.`state` ON bbdb.name = state.bbname 
            INNER JOIN price ON state.bbname = price.bbname";
    
    // Execute the query
    $result = $conn->query($query);
    
    // Check if the query execution was successful
    if ($result === FALSE) {
        echo json_encode(["error" => "Query failed: " . $conn->error]);
        exit();
    }

    // Fetch data from the result set
    while ($row = $result->fetch_assoc()) {
        $output_stream[] = $row;
    }

    // Return the data as a JSON response
    echo json_encode($output_stream);
} else {
    // If the required POST variable is not found, return an error
    echo json_encode(["error" => "Post variable 'bloodGP' not found!"]);
}
?>
