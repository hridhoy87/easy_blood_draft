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

// Array of real blood bank data
$bloodBanks = [
    ['name' => 'Dhaka Medical College Blood Bank', 'lat' => 23.7372, 'long' => 90.3870, 'plus_code' => 'R9F9+3F Dhaka'],
    ['name' => 'Bangabandhu Sheikh Mujib Medical University', 'lat' => 23.7405, 'long' => 90.3895, 'plus_code' => 'R9F9+8G Dhaka'],
    ['name' => 'Shandhani Blood Bank', 'lat' => 23.7823, 'long' => 90.4019, 'plus_code' => 'Q9JX+2J Dhaka'],
    // Add more entries as needed
];

// Prepare and bind for bbdb table
$stmt_bbdb = $conn->prepare("INSERT INTO bbdb (name, lat, `long`, plus_code, last_updated_at) VALUES (?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE lat=?, `long`=?, plus_code=?, last_updated_at=NOW()");
$stmt_bbdb->bind_param("sddssss", $name, $lat, $long, $plus_code, $lat, $long, $plus_code);

// Insert blood bank data
foreach ($bloodBanks as $bank) {
    $name = $bank['name'];
    $lat = $bank['lat'];
    $long = $bank['long'];
    $plus_code = $bank['plus_code'];
    
    // Execute statement for bbdb
    if ($stmt_bbdb->execute()) {
        echo "Blood bank record for $name created or updated successfully.<br>";
    } else {
        echo "Error inserting/updating bbdb for $name: " . $stmt_bbdb->error . "<br>";
    }
}

// Prepare and bind for state table
$stmt_state = $conn->prepare("INSERT INTO state (bbname, aPOS, bPOS, abPOS, oPOS, aNEG, bNEG, abNEG, oNEG, last_updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE aPOS=?, bPOS=?, abPOS=?, oPOS=?, aNEG=?, bNEG=?, abNEG=?, oNEG=?, last_updated_at=NOW()");
$stmt_state->bind_param("siiiiiiiiiiiiiiii", $bbname, $aPOS, $bPOS, $abPOS, $oPOS, $aNEG, $bNEG, $abNEG, $oNEG, $aPOS, $bPOS, $abPOS, $oPOS, $aNEG, $bNEG, $abNEG, $oNEG);

// Prepare and bind for price table
$stmt_price = $conn->prepare("INSERT INTO price (bbname, aPOS, bPOS, abPOS, oPOS, aNEG, bNEG, abNEG, oNEG, last_updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE aPOS=?, bPOS=?, abPOS=?, oPOS=?, aNEG=?, bNEG=?, abNEG=?, oNEG=?, last_updated_at=NOW()");
$stmt_price->bind_param("siiiiiiiiiiiiiiii", $bbname, $price_aPOS, $price_bPOS, $price_abPOS, $price_oPOS, $price_aNEG, $price_bNEG, $price_abNEG, $price_oNEG, $price_aPOS, $price_bPOS, $price_abPOS, $price_oPOS, $price_aNEG, $price_bNEG, $price_abNEG, $price_oNEG);

// Insert fictitious data for state and price
foreach ($bloodBanks as $bank) {
    $bbname = $bank['name'];

    // Generate fictitious data for state
    $aPOS = rand(50, 200);
    $bPOS = rand(50, 200);
    $abPOS = rand(50, 200);
    $oPOS = rand(50, 200);
    $aNEG = rand(10, 50);
    $bNEG = rand(10, 50);
    $abNEG = rand(10, 50);
    $oNEG = rand(10, 50);

    // Execute statement for state
    if ($stmt_state->execute()) {
        echo "State record for $bbname created or updated successfully.<br>";
    } else {
        echo "Error inserting/updating state for $bbname: " . $stmt_state->error . "<br>";
    }

    // Generate fictitious data for price
    $price_aPOS = rand(100, 500);
    $price_bPOS = rand(100, 500);
    $price_abPOS = rand(100, 500);
    $price_oPOS = rand(100, 500);
    $price_aNEG = rand(200, 800);
    $price_bNEG = rand(200, 800);
    $price_abNEG = rand(200, 800);
    $price_oNEG = rand(200, 800);

    // Execute statement for price
    if ($stmt_price->execute()) {
        echo "Price record for $bbname created or updated successfully.<br>";
    } else {
        echo "Error inserting/updating price for $bbname: " . $stmt_price->error . "<br>";
    }
}

// Close statements and connection
$stmt_bbdb->close();
$stmt_state->close();
$stmt_price->close();
$conn->close();
?>
