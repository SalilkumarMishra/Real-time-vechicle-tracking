<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database.php'; // Make sure you're including database.php to get connection setup.

    if (!$conn || $conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            header("Location: inde.php"); // Redirect to the dashboard or home page after successful login
            exit();
        } else {
            echo "<script>alert('Invalid password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('No user found with that email address.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FleetTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        /* Static gray background */
        .bg-overlay {
            background: #374151; /* Tailwind's gray-700 */
            position: relative;
        }

        /* Subtle overlay for better contrast */
        .bg-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }

        /* Glassmorphism effect for login box */
        .glass-box {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            animation: scaleIn 1.2s ease; /* Scale animation */
            z-index: 1;
        }

        /* Scale-in animation for login box */
        @keyframes scaleIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Button hover glow effect */
        button {
            transition: transform 0.2s ease, background-color 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.4);
        }

        /* Social button hover effect */
        .social-btn {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .social-btn:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        /* Divider animation */
        .divider {
            position: relative;
            overflow: hidden;
        }

        .divider::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, #f97316, #3b82f6);
            animation: slideDivider 3s linear infinite;
        }

        @keyframes slideDivider {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-overlay">
    <div class="flex flex-col lg:flex-row items-center lg:items-start glass-box bg-gray-100 text-gray-800 shadow-2xl w-full max-w-5xl p-6">
        <!-- Left Side: Image -->
        <div class="hidden lg:block w-full lg:w-3/5 rounded-l-lg overflow-hidden">
            <img src="/Real-time-vehicle-tracking/images/logint.jpg" alt="FleetTrack Illustration" class="h-full w-full object-cover rounded-lg"> <!-- Added rounded-lg -->
        </div>

        <!-- Right Side: Login Box -->
        <div class="w-full lg:w-2/5 p-8">
            <div class="text-center mb-6">
                <h1 class="text-4xl font-bold text-blue-950">Welcome Back!</h1>
                <p class="text-sm text-gray-700">Log in to your FleetTrack account</p>
            </div>
            <form action="#" method="POST" autocomplete="on">
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1 text-gray-700">
                        <i class="fas fa-envelope text-orange-500 mr-2"></i>Email Address
                    </label>
                    <input type="email" id="email" name="email" required
                        class="w-full p-3 border border-gray-300 rounded-md bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        autocomplete="username">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium mb-1 text-gray-700">
                        <i class="fas fa-lock text-orange-500 mr-2"></i>Password
                    </label>
                    <input type="password" id="password" name="password" required
                        class="w-full p-3 border border-gray-300 rounded-md bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        autocomplete="current-password">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center text-sm text-gray-700">
                        <input type="checkbox" class="mr-2">
                        Remember Me
                    </label>
                    <a href="#" class="text-sm text-orange-500 hover:underline">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white py-3 rounded-md shadow-md hover:from-green-500 hover:to-blue-600 transition">
                    Log In
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 divider"></div>

            <!-- Social Login -->
            <div class="text-center">
                <p class="text-sm text-gray-700 mb-4">Or log in with</p>
                <div class="flex justify-center space-x-4">
                    <a href="https://www.https://accounts.google.com/o/oauth2/v2/auth?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&response_type=token&scope=email%20profile" target="_blank" class="text-orange-500 hover:text-orange-400 transition">
                        <i class="fab fa-google text-2xl"></i>
                    </a>
                    <a href="https://www.facebook.com" target="_blank" class="text-orange-500 hover:text-orange-400 transition">
                        <i class="fab fa-facebook text-2xl"></i>
                    </a>
                    <a href="https://www.twitter.com" target="_blank" class="text-orange-500 hover:text-orange-400 transition">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                    </a>
                </div>
            </div>

            <!-- Sign Up Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-700">
                    Don't have an account?
                    <a href="sign.html" class="text-orange-500 hover:underline">Sign Up</a>
                </p>
            </div>
        </div>
    </div>

    <!-- JavaScript for Credential Management API -->
    <script>
        // Automatically fill saved credentials if available
        if ('credentials' in navigator) {
            navigator.credentials.get({ password: true }).then(credential => {
                if (credential) {
                    document.getElementById('email').value = credential.id;
                    document.getElementById('password').value = credential.password;
                }
            });
        }
    </script>
</body>
</html>