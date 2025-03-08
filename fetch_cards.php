<?php
// fetch_cards.php

// Database connection (Get actual credentials from Chris!)
$host = "localhost";
$dbname = "your_database";
$username = "your_username";
$password = "your_password";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

// Get JSON POST body
$data = json_decode(file_get_contents('php://input'), true);

$deckId = $data['deckId'] ?? null;
$cardType = $data['cardType'] ?? [];
$cardColor = $data['cardColor'] ?? [];
$cardRarity = $data['cardRarity'] ?? [];

// Build the SQL query dynamically
$query = "SELECT * FROM cards WHERE 1=1";
$params = [];
$types = "";

// Add filters based on user input
if (!empty($deckId)) {
    $query .= " AND deck_id = ?";
    $params[] = $deckId;
    $types .= "i"; // Integer type for deck ID
}

if (!empty($cardType)) {
    $query .= " AND card_type IN (" . str_repeat('?,', count($cardType) - 1) . "?)";
    $params = array_merge($params, $cardType);
    $types .= str_repeat("s", count($cardType)); // String type for card types
}

if (!empty($cardColor)) {
    $query .= " AND card_color IN (" . str_repeat('?,', count($cardColor) - 1) . "?)";
    $params = array_merge($params, $cardColor);
    $types .= str_repeat("s", count($cardColor)); // String type for colors
}

if (!empty($cardRarity)) {
    $query .= " AND card_rarity IN (" . str_repeat('?,', count($cardRarity) - 1) . "?)";
    $params = array_merge($params, $cardRarity);
    $types .= str_repeat("s", count($cardRarity)); // String type for rarities
}

// Prepare and execute the statement
$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Fetch results as an associative array
$cards = [];
while ($row = $result->fetch_assoc()) {
    $cards[] = $row;
}

$stmt->close();
$conn->close();

// Return the filtered results as JSON
header('Content-Type: application/json');
echo json_encode(["cards" => $cards]);
?>
