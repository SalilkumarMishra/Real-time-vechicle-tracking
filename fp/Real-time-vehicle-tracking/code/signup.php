<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "signup";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required POST variables are set
    if (
        isset($_POST["full_name"]) && isset($_POST["email"]) && isset($_POST["phone_number"]) &&
        isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["gender"]) &&
        isset($_POST["country"])
    ) {
        // Retrieve and sanitize user input
        $full_name = $conn->real_escape_string($_POST["full_name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $phone_number = $conn->real_escape_string($_POST["phone_number"]);
        $username = $conn->real_escape_string($_POST["username"]);
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash the password
        $number_of_vehicles = isset($_POST["number_of_vehicles"]) ? $conn->real_escape_string($_POST["number_of_vehicles"]) : null;
        $type_of_vehicles = isset($_POST["type_of_vehicles"]) ? $conn->real_escape_string($_POST["type_of_vehicles"]) : null;
        $gender = $conn->real_escape_string($_POST["gender"]);
        $country = $conn->real_escape_string($_POST["country"]);

        // Insert user data into the database
        $query = "INSERT INTO users (full_name, email, phone_number, username, password_hash, number_of_vehicles, type_of_vehicles, gender, country) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "sssssssss",
            $full_name,
            $email,
            $phone_number,
            $username,
            $password,
            $number_of_vehicles,
            $type_of_vehicles,
            $gender,
            $country
        );

        if ($stmt->execute()) {
            // Redirect to login.php after successful registration
            header("Location: login.php");
            exit();
        } else {
            echo "<script>alert('Error: Could not register user. Please try again.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill all required fields!');</script>";
    }
}

$conn->close();
?>
