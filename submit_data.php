<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "easy_blood";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind for bbdb table
$stmt_bbdb = $conn->prepare("INSERT INTO bbdb (name, lat, `long`, plus_code, last_updated_at) VALUES (?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE lat=?, `long`=?, plus_code=?, last_updated_at=NOW()");
$stmt_bbdb->bind_param("sdddsdd", $bbname, $lat, $long, $plus_code, $lat, $long, $plus_code);

// Set parameters for bbdb
$bbname = $_POST['bbname'];
$lat = $_POST['lat'];
$long = $_POST['long'];
$plus_code = $_POST['plus_code'];

// Execute statement for bbdb
if ($stmt_bbdb->execute()) {
    echo "Blood bank record created or updated successfully.";
} else {
    echo "Error inserting/updating bbdb: " . $stmt_bbdb->error;
}

// Prepare and bind for state table
$stmt_state = $conn->prepare("INSERT INTO state (bbname, aPOS, bPOS, abPOS, oPOS, aNEG, bNEG, abNEG, oNEG, last_updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE aPOS=?, bPOS=?, abPOS=?, oPOS=?, aNEG=?, bNEG=?, abNEG=?, oNEG=?, last_updated_at=NOW()");
$stmt_state->bind_param("siiiiiiiiiiiiiiii", $bbname, $aPOS, $bPOS, $abPOS, $oPOS, $aNEG, $bNEG, $abNEG, $oNEG, $aPOS, $bPOS, $abPOS, $oPOS, $aNEG, $bNEG, $abNEG, $oNEG);

// Set parameters for state
$aPOS = $_POST['aPOS'];
$bPOS = $_POST['bPOS'];
$abPOS = $_POST['abPOS'];
$oPOS = $_POST['oPOS'];
$aNEG = $_POST['aNEG'];
$bNEG = $_POST['bNEG'];
$abNEG = $_POST['abNEG'];
$oNEG = $_POST['oNEG'];

// Execute statement for state
if ($stmt_state->execute()) {
    echo "State record created or updated successfully.";
} else {
    echo "Error inserting/updating state: " . $stmt_state->error;
}

// Prepare and bind for price table
$stmt_price = $conn->prepare("INSERT INTO price (bbname, aPOS, bPOS, abPOS, oPOS, aNEG, bNEG, abNEG, oNEG, last_updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE aPOS=?, bPOS=?, abPOS=?, oPOS=?, aNEG=?, bNEG=?, abNEG=?, oNEG=?, last_updated_at=NOW()");
$stmt_price->bind_param("siiiiiiiiiiiiiiii", $bbname, $price_aPOS, $price_bPOS, $price_abPOS, $price_oPOS, $price_aNEG, $price_bNEG, $price_abNEG, $price_oNEG, $price_aPOS, $price_bPOS, $price_abPOS, $price_oPOS, $price_aNEG, $price_bNEG, $price_abNEG, $price_oNEG);

// Set parameters for price
$price_aPOS = $_POST['price_aPOS'];
$price_bPOS = $_POST['price_bPOS'];
$price_abPOS = $_POST['price_abPOS'];
$price_oPOS = $_POST['price_oPOS'];
$price_aNEG = $_POST['price_aNEG'];
$price_bNEG = $_POST['price_bNEG'];
$price_abNEG = $_POST['price_abNEG'];
$price_oNEG = $_POST['price_oNEG'];

// Execute statement for price
if ($stmt_price->execute()) {
    echo "Price record created or updated successfully.";
} else {
    echo "Error inserting/updating price: " . $stmt_price->error;
}

// Close all statements and connection
$stmt_bbdb->close();
$stmt_state->close();
$stmt_price->close();
$conn->close();

// Redirect to base URL
header("Location: /easy_blood/");
exit();  // Ensure no further code is executed after the redirect
?>
