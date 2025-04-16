<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "127.0.0.1";
$username = "root";  // Change this if necessary
$password = "";      // Change this if necessary
$dbname = "signup_db";

// Create connection
$conn = new mysqli('127.0.0.1','root','','signup');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully!";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["full_name"]) && isset($_POST["email"]) && isset($_POST["phone_number"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["number_of_vehicles"]) && isset($_POST["type_of_vehicles"]) && isset($_POST["gender"]) && isset($_POST["country"])) {
        $full_name = $_POST["full_name"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $number_of_vehicles = $_POST["number_of_vehicles"];
        $type_of_vehicles = $_POST["type_of_vehicles"];
        $gender = $_POST["gender"];
        $country = $_POST["country"];

        $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone_number, username, password_hash, number_of_vehicles, type_of_vehicles, gender, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $full_name, $email, $phone_number, $username, $password, $number_of_vehicles, $type_of_vehicles, $gender, $country);

        if ($stmt->execute()) {
            echo "Sign up successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill all required fields.";
    }
}

?>
<!--
http://localhost/phpmyadmin/index.php?route=/table/sql&db=signup&table=users
http://localhost/Real-time-vehicle-tracking/code/database.php
http://localhost:3000/Real-time-vehicle-tracking/code/database.php
http://localhost/Real-time-vehicle-tracking/code/sign.html
-->