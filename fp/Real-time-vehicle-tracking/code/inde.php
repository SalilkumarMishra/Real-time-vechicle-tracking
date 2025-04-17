<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in.
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
    project
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body {
            background-color: #1a1a1a;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }
        .hidden {
            display: none;
        }
  </style>
  <style>
    /* Sliding animation */
    @keyframes slide {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-100%);
        }
    }

    .animate-slide {
        display: flex;
        width: calc(10 * 16rem); /* Adjust width based on the number of boxes (10 boxes * 16rem width) */
        animation: slide 20s linear infinite; /* Adjust duration for speed */
    }

    .animate-slide:hover {
        animation-play-state: paused; /* Pause animation on hover */
    }

    /* Testimonial box styling */
    .bg-white {
        min-width: 16rem; /* Ensure consistent width for each box */
    }
</style>
  <style>
    @keyframes slideInFromLeft {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .slide-in {
        animation: slideInFromLeft 1s ease-out;
    }
  </style>
  <style>
    .lazy-hidden {
        opacity: 0;
        transform: translateX(-100%); /* Start off-screen to the left */
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .lazy-visible {
        opacity: 1;
        transform: translateX(0); /* Move to original position */
    }
  </style>
  <style>
    button {
        transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition for hover effect */
    }

    button:hover {
        background-color: #ff7f50; /* Coral color for hover */
        color: #ffffff; /* White text on hover */
    }

    /* Specific styles for "Log in" and "Get started today" buttons */
    .login-button:hover {
        background-color: #ff7f50; /* Coral color for hover */
        color: #ffffff;
    }

    .get-started-button:hover {
        background-color: #ff7f50; /* Coral color for hover */
        color: #ffffff;
    }
  </style>
  <style>
    /* Slide in from the left */
    .slide-in-left {
        opacity: 0;
        transform: translateX(-100%);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    /* Slide in from the right */
    .slide-in-right {
        opacity: 0;
        transform: translateX(100%);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    /* Scale up effect */
    .scale-up {
        opacity: 0;
        transform: scale(0.8);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    /* Visible state */
    .visible {
        opacity: 1;
        transform: translateX(0) translateY(0) scale(1);
    }
</style>
  <style>
    .flip-card {
        perspective: 1000px; /* Enables 3D effect */
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s;
        transform-style: preserve-3d;
    }

    .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg); /* Flips the card */
    }

    .flip-card-front,
    .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden; /* Hides the back when facing front */
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .flip-card-front {
        background-color: #1a1a1a;
        color: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
    }

    .flip-card-back {
        background-color: #333333;
        color: #ffffff;
        transform: rotateY(180deg); /* Back side is rotated */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
    }
</style>
  <style>
    input[type="text"] {
        color: black; /* Ensures the text appears in black */
    }
</style>
  <style>
    /* Popup Box Styling */
    #chatgpt-popup {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 350px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transform: translateY(100%);
        transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
        z-index: 1000;
    }

    #chatgpt-popup.visible {
        transform: translateY(0);
        opacity: 1;
    }

    #chatgpt-popup h2 {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333333;
    }

    #chatgpt-popup button {
        font-size: 1rem;
        font-weight: bold;
        background-color: #ff7f50;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #chatgpt-popup button:hover {
        background-color: #ff5722;
    }

    #chatgpt-answer {
        font-size: 0.875rem;
        line-height: 1.5;
        color: #555555;
        max-height: 200px;
        overflow-y: auto;
    }

    /* Add a subtle animation for the popup */
    #chatgpt-popup.visible {
        animation: slideInUp 0.5s ease-out;
    }

    @keyframes slideInUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>
  <style>
    /* Prevent horizontal scrolling for the entire page */
    body {
        overflow-x: hidden; /* Disable horizontal scrolling */
    }

    /* Allow the testimonial section to overflow horizontally */
    .testimonial-section {
        overflow-x: visible; /* Allow sliding testimonials to overflow */
    }

    /* Ensure all other sections are constrained within the viewport */
    section {
        max-width: 100vw; /* Prevent sections from exceeding the viewport width */
        overflow-x: hidden; /* Prevent horizontal overflow */
    }

    /* Fix for sliding container */
    .animate-slide {
        display: flex;
        width: calc(10 * 16rem); /* Adjust width based on the number of boxes */
        animation: slide 20s linear infinite; /* Adjust duration for speed */
    }
</style>
  <style>
    /* Smooth transition for hover effects */
    a, button, input, textarea {
        transition: all 0.3s ease-in-out;
    }

    /* Navbar Links Hover Effect */
    nav a:hover {
        color: #ff7f50; /* Coral color */
        transform: scale(1.1); /* Slight zoom */
    }

    /* Button Hover Effect */
    button:hover {
        background-color: #ff7f50; /* Coral color */
        transform: translateY(-2px); /* Lift up */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow */
    }

    /* Input Fields Focus Effect */
    input:focus, textarea:focus {
        border-color: #ff7f50; /* Coral border */
        box-shadow: 0 0 5px rgba(255, 127, 80, 0.5); /* Glow effect */
    }

    /* Slide-in from left animation */
    @keyframes slideInFromLeft {
        0% {
            transform: translateX(-100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Slide-in from right animation */
    @keyframes slideInFromRight {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Fade-in animation */
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    /* Apply animation to sections */
    .slide-in-left {
        animation: slideInFromLeft 1s ease-out;
    }

    .slide-in-right {
        animation: slideInFromRight 1s ease-out;
    }

    .fade-in {
        animation: fadeIn 1s ease-in;
    }
</style>
  <style>
    /* Lift-up effect with shadow on hover */
    .hover-box {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-box:hover {
        transform: translateY(-5px); /* Lift up */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Add shadow */
    }
</style>
  <script>
    function scrollToForm(section) {
        const formSection = document.getElementById('form-section');
        formSection.scrollIntoView({ behavior: 'smooth' });
        
        // Highlight the selected section
        const demoButton = document.getElementById('demo-button');
        const quoteButton = document.getElementById('quote-button');
        
        if (section === 'demo') {
            demoButton.classList.add('bg-orange-600', 'text-white');
            quoteButton.classList.remove('bg-orange-600', 'text-white');
        } else if (section === 'quote') {
            quoteButton.classList.add('bg-orange-600', 'text-white');
            demoButton.classList.remove('bg-orange-600', 'text-white');
        }
    }
    
    function toggleDropdown(id) {
        const element = document.getElementById(id);
        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
    }
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
        const lazyElements = document.querySelectorAll(".lazy-hidden");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("lazy-visible");
                    observer.unobserve(entry.target); // Stop observing once the animation is applied
                }
            });
        });

        lazyElements.forEach((el) => observer.observe(el));
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
        const animatedElements = document.querySelectorAll(
            ".slide-in-left, .slide-in-right, .fade-in, .scale-up, .rotate-in"
        );

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target); // Stop observing once the animation is applied
                }
            });
        });

        animatedElements.forEach((el) => observer.observe(el));
    });
</script>
<script>
    function scrollToForm(option) {
        // Scroll to the form section
        document.getElementById('form-section').scrollIntoView({ behavior: 'smooth' });

        // Deselect both buttons first
        document.getElementById('demo-button').classList.remove('bg-orange-600', 'text-white');
        document.getElementById('quote-button').classList.remove('bg-orange-600', 'text-white');

        // Highlight the selected button
        if (option === 'demo') {
            document.getElementById('demo-button').classList.add('bg-orange-600', 'text-white');
        } else if (option === 'quote') {
            document.getElementById('quote-button').classList.add('bg-orange-600', 'text-white');
        }
    }
</script>
<script>
    function selectOption(button, group) {
        // Deselect all buttons in the group
        const buttons = document.querySelectorAll(`button[data-group="${group}"]`);
        buttons.forEach((btn) => {
            btn.classList.remove('bg-orange-600', 'text-white');
            btn.classList.add('border-gray-300', 'text-black');
        });

        // Highlight the selected button
        button.classList.add('bg-orange-600', 'text-white');
        button.classList.remove('border-gray-300', 'text-black');

        // Update the hidden input value
        if (group === 'vehicle') {
            document.getElementById('vehicle-selection').value = button.textContent.trim();
        } else if (group === 'demo-quote') {
            document.getElementById('demo-quote-selection').value = button.textContent.trim();
        }
    }

    function validateForm() {
        const name = document.getElementById('name').value.trim();
        const company = document.getElementById('company').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const vehicleSelection = document.getElementById('vehicle-selection').value.trim();
        const demoQuoteSelection = document.getElementById('demo-quote-selection').value.trim();

        if (!name || !company || !email || !phone || !vehicleSelection || !demoQuoteSelection) {
            alert('Please fill out all fields and make your selections.');
            return false;
        }

        return true;
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const slidingElements = document.querySelectorAll(".slide-in-left, .slide-in-right");
        const scalingElements = document.querySelectorAll(".scale-up");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                    
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target); // Stop observing once the animation is applied
                }
            });
        });

        slidingElements.forEach((el) => observer.observe(el));
        scalingElements.forEach((el) => observer.observe(el));
    });
</script>
<script>
    async function searchQuestion() {
        const query = document.querySelector('#search-bar').value.trim().toLowerCase();
        const answerBox = document.querySelector('#chatgpt-answer');
        const popup = document.querySelector('#chatgpt-popup');

        if (!query) {
            alert('Please enter a question.');
            return;
        }

        // Show the popup
        popup.classList.add('visible');
        popup.classList.remove('hidden');

        // Check for the predefined question
        if (query === 'tell me about your tracking company') {
            const predefinedAnswer = 'FleetTrack is a leading provider of real-time vehicle tracking and fleet management solutions. Our platform helps businesses optimize their operations, improve efficiency, and ensure the safety of their vehicles and drivers. With award-winning customer service and over 800,000 units installed, we are trusted by 20,000+ businesses worldwide.';
            typeAnswer(predefinedAnswer, answerBox);
            return;
        }

        // Show loading message for other queries
        answerBox.textContent = 'Fetching answer...';

        try {
            // Call OpenAI API for other questions
            const response = await fetch('https://api.openai.com/v1/chat/completions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer YOUR_OPENAI_API_KEY' // Replace with your API key
                },
                body: JSON.stringify({
                    model: 'gpt-3.5-turbo',
                    messages: [{ role: 'user', content: query }]
                })
            });

            const data = await response.json();
            if (data.choices && data.choices.length > 0) {
                const answer = data.choices[0].message.content;
                typeAnswer(answer, answerBox);
            } else {
                typeAnswer('Sorry, no answer was found.', answerBox);
            }
        } catch (error) {
            typeAnswer('An error occurred. Please try again later.', answerBox);
            console.error(error);
        }
    }

    // Typing effect function
    function typeAnswer(text, element) {
        element.textContent = ''; // Clear the element
        let index = 0;

        function type() {
            if (index < text.length) {
                element.textContent += text.charAt(index);
                index++;
                setTimeout(type, 30); // Adjust typing speed (30ms per character)
            }
        }

        type();
    }

    function closePopup() {
        const popup = document.querySelector('#chatgpt-popup');
        popup.classList.remove('visible');
        popup.classList.add('hidden');
    }

    // Add "Enter" key support for the search bar
    document.querySelector('#search-bar').addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent form submission
            searchQuestion(); // Trigger the search function
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const animatedElements = document.querySelectorAll(
            ".slide-in-left, .slide-in-right, .fade-in"
        );

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target); // Stop observing once the animation is applied
                }
            });
        });

        animatedElements.forEach((el) => observer.observe(el));
    });
</script>
 </head>
 <body class="font-sans">
  <header class="bg-gray-800 shadow-2xl p-4 flex justify-between items-center fixed w-full z-10 rounded-lg">
    <div class="text-2xl font-bold text-gray-300">
        FleetTrack
    </div>
    <nav class="flex-1 flex justify-center space-x-8 text-gray-300">
        <a href="price.html" class="hover:text-orange-500 transition text-lg  hover:underline">
            Pricing
        </a>
        <a href="success.html" class="hover:text-orange-500 transition text-lg  hover:underline">
            Success Stories
        </a>
        <a href="./track.html" class="hover:text-orange-500 transition text-lg  hover:underline">
            Track Your Vehicle  
        </a>
        <a href="https://www.google.com/maps/dir/?api=1" target="_blank" class="hover:text-orange-500 transition text-lg  hover:underline">
            Search for Route
        </a>
    </nav>
    <div class="ml-auto flex space-x-4">
        <a href="./login.php" class="bg-blue-500 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow-lg hover:bg-blue-600 hover:shadow-xl transition-all duration-300">
    Login
</a>
    </div>
</header>
  <main class="relative">
    <!-- Hero Section -->
    <div class="relative bg-cover bg-center h-[500px] flex items-center justify-center px-12 slide-in-left" style="background-image: url('/Real-time-vehicle-tracking/images/11.jpg');">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-transparent to-black opacity-70"></div>
        
        <!-- Hero Content -->
        <div class="relative text-white max-w-2xl text-center slide-in-left">
            <h1 class="text-4xl font-bold mb-6 leading-tight">
                Go the Extra Mile with <span class="text-orange-400 text-5xl"><br>FleetTrack</span>
            </h1>
            <p class="text-lg mb-8">
                Real-time vehicle tracking and fleet management solutions tailored for your business.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="sign.html" class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition">
                    Get Started Today
                </a>
                <a href="contact.html" class="bg-transparent border border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-black transition">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</main>
  <div class="py-8 bg-gray-100">
    <div class="container mx-auto flex justify-center space-x-4">
        <div class="text-center bg-white border border-gray-200 rounded-lg p-4 shadow-md hover-box">
            <i class="fas fa-award text-3xl text-orange-500 mb-2"></i>
            <p class="text-md font-semibold text-gray-800">Experience award-winning customer service</p>
        </div>
        <div class="text-center bg-white border border-gray-200 rounded-lg p-4 shadow-md hover-box">
            <i class="fas fa-briefcase text-3xl text-orange-500 mb-2"></i>
            <p class="text-md font-semibold text-gray-800">We've helped 20,000+ businesses</p>
        </div>
        <div class="text-center bg-white border border-gray-200 rounded-lg p-4 shadow-md hover-box">
            <i class="fas fa-cogs text-3xl text-orange-500 mb-2"></i>
            <p class="text-md font-semibold text-gray-800">Over 800,000 units installed and counting</p>
        </div>
    </div>
</div>
  <div class="py-12 bg-gray-100">
    <div class="container mx-auto max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-14">
        <!-- Business Owners Box -->
        <div class="bg-white p-6 rounded-lg shadow-md text-center hover-box">
            <h2 class="text-xl font-bold text-gray-800 mb-3">Business Owners</h2>
            <p class="text-sm text-gray-600 mb-4">Our vehicle tracking makes running your business easier.</p>
            <button class="bg-orange-500 text-white px-4 py-2 text-sm rounded hover:bg-orange-600 transition" onclick="scrollToForm('quote')">
                Get My Quote
            </button>
        </div>
        <!-- Fleet Managers Box -->
        <div class="bg-white p-6 rounded-lg shadow-md text-center hover-box">
            <h2 class="text-xl font-bold text-gray-800 mb-3">Fleet Managers</h2>
            <p class="text-sm text-gray-600 mb-4">No auto renewals or hidden costs. You're in complete control.</p>
            <button class="bg-orange-500 text-white px-4 py-2 text-sm rounded hover:bg-orange-600 transition" onclick="scrollToForm('demo')">
                Book My Demo
            </button>
        </div>
    </div>
</div>
  <section class="p-12 bg-blacktext-white text-center">
    <h2 class="text-2xl font-bold mb-2">Great value pricing plans.</h2>
    <p class="text-lg mb-8">Choose the right vehicle tracking plan for your business.</p>
    <div class="flex flex-col md:flex-row justify-center items-center space-y-6 md:space-y-0 md:space-x-6">
        <!-- Info Point -->
        <div class="bg-white text-black p-6 rounded-lg shadow-lg w-80 hover-box">
            <h2 class="text-xl font-bold mb-4">
                Info <span class="text-green-600">Point</span>
            </h2>
            <ul class="mb-6">
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Live tracking
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Award winning support
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Vehicle and driver logs
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Route maps
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> System configuration
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Quartix mobile app
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Privacy mode
                </li>
            </ul>
            <button class="shadow-lg bg-orange-600 text-white py-2 px-4 rounded-lg mb-4" onclick="scrollToForm('quote')">
                Get My Quote
            </button>
        </div>
        <!-- Info Plus -->
        <div class="bg-white text-black p-6 rounded-lg shadow-lg w-80 hover-box">
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-600 text-white py-1 px-4 rounded-full">
                Most Popular
            </div>
            <h2 class="text-xl font-bold mb-4">
                Info <span class="text-green-600">Plus</span>
            </h2>
            <p class="mb-4">Includes everything from Info Point and more:</p>
            <ul class="mb-6">
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Trip reports
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Driver behavior
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Geofences
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Management reports
                </li>
            </ul>
            <button class="shadow-lg bg-orange-600 text-white py-2 px-4 rounded-lg mb-4" onclick="scrollToForm('quote')">
                Get My Quote
            </button>
        </div>
        <!-- Info Plus + Driver ID -->
        <div class="bg-white text-black p-6 rounded-lg shadow-lg w-80 hover-box">
            <h2 class="text-xl font-bold mb-4">
                Info <span class="text-green-600">Plus</span> + Driver ID
            </h2>
            <p class="mb-4">Includes everything from Info Plus and Driver Identification:</p>
            <ul class="mb-6">
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Driver ID
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Driver's Name
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Driver's Phone Number
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Driver's Email Address
                </li>
                <li class="flex items-center mb-2">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i> Driver's Previous Records
                </li>
            </ul>
            <button class="shadow-lg bg-orange-600 text-white py-2 px-4 rounded-lg mb-4" onclick="scrollToForm('quote')">
                Get My Quote
            </button>
        </div>
    </div>
</section>
  <section class="flex items-center justify-center min-h-screen" >
   <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
    <div class="text-center md:text-left md:w-1/2">
     <h1 class="text-2xl md:text-3xl font-semibold mb-4">
      Fed up with your current supplier?
      <br/>
      Switching to FleetTrack is easy.
     </h1>
     <div class="space-y-4 mb-6">
      <div class="bg-black  text-white p-4 flex items-center rounded-2xl">
       <i class="fas fa-star text-green-500 mr-2">
       </i>
       <span>
        Award-winning customer service
       </span>
      </div>
      <div class="bg-black text-white p-4 flex items-center rounded-2xl">
       <i class="fas fa-star text-green-500 mr-2">
       </i>
       <span>
        No hidden costs or auto renewals
       </span>
      </div>
      <div class="bg-black text-white p-4 flex items-center rounded-2xl">
       <i class="fas fa-star text-green-500 mr-2">
       </i>
       <span>
        Great value for money
       </span>
      </div>
     </div>
     <button class="bg-orange-600 text-white py-2 px-6 rounded" onclick="scrollToForm('demo')">
      Book My Demo
     </button>
    </div>
    <div class="md:w-1/2 mt-6 md:mt-0">
     <img alt="A man with a beard and crossed arms looking to the side, wearing a blue shirt, standing against a blue background" height="1000" src="/Real-time-vehicle-tracking/images/n.png" width="900">
     </img>
    </div>
   </div>
  </section>
  <section class="p-12 bg-gray-100 fade-in">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-center items-start">
            <!-- Left Section -->
            <div class="w-full md:w-1/3 p-4">
                <h1 class="text-xl font-semibold mb-4 text-gray-800">
                    Got a question? We have the answers.
                </h1>
                <h2 class="text-l font-semibold mb-2 text-gray-800">
                    Have a different question?
                    <br />
                </h2>
                <div class="flex items-center border-gray-300 rounded">
                    <input id="search-bar" class="w-full p-3 text-black" placeholder="Search..." type="text" />
                    <button onclick="searchQuestion()" class="bg-green-500 text-white p-4 rounded-r">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <img alt="Decorative image related to questions and answers" class="mt-4 w-full h-55 object-cover rounded" src="/Real-time-vehicle-tracking/images/hii.png" />
            </div>

            <!-- FAQ Section -->
            <div class="w-full md:w-2/3 lg:w-1/2 p-4 ml-8 slide-in-right">
                <div class="bg-white p-5 rounded shadow mb-4 slide-in-right">
                    <div class="flex justify-between items-center cursor-pointer" onclick="toggleDropdown('faq1')">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-chevron-down text-gray-500 mr-2"></i> <!-- Added down arrow -->
                            How does GPS vehicle tracking work?
                        </h3>
                    </div>
                    <p class="mt-2 text-gray-700 hidden transition-all duration-300 ease-in-out" id="faq1">
                        In most cases, vehicle tracking uses GPS devices securely installed within the vehicle to track its location over time. The data is sent to a central server which will often work in conjunction with a wider fleet management tool, allowing users to assess the data. Most tracking systems will also incorporate wider telematics data such as fuel use, journey times and driver behavior, which can help businesses manage their vehicles more effectively.
                    </p>
                </div>
                <div class="bg-white p-5 rounded shadow mb-4 slide-in-right">
                    <div class="flex justify-between items-center cursor-pointer" onclick="toggleDropdown('faq2')">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-chevron-down text-gray-500 mr-2"></i> <!-- Added down arrow -->
                            What is vehicle tracking?
                        </h3>
                    </div>
                    <p class="mt-2 text-gray-700 hidden transition-all duration-300 ease-in-out" id="faq2">
                        Vehicle tracking is the use of GPS technology to monitor the location, movements, status, and behavior of a vehicle or fleet of vehicles.
                    </p>
                </div>
                <div class="bg-white p-5 rounded shadow mb-4 slide-in-right">
                    <div class="flex justify-between items-center cursor-pointer" onclick="toggleDropdown('faq3')">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-chevron-down text-gray-500 mr-2"></i> <!-- Added down arrow -->
                            What are the benefits of vehicle tracking for drivers?
                        </h3>
                    </div>
                    <p class="mt-2 text-gray-700 hidden transition-all duration-300 ease-in-out" id="faq3">
                        Vehicle tracking can help drivers by providing real-time information on traffic conditions, optimizing routes, improving fuel efficiency, and enhancing overall safety.
                    </p>
                </div>
                <div class="bg-white p-5 rounded shadow mb-4 slide-in-right">
                    <div class="flex justify-between items-center cursor-pointer" onclick="toggleDropdown('faq4')">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-chevron-down text-gray-500 mr-2"></i> <!-- Added down arrow -->
                            Is vehicle tracking legal?
                        </h3>
                    </div>
                    <p class="mt-2 text-gray-700 hidden transition-all duration-300 ease-in-out" id="faq4">
                        Yes, vehicle tracking is legal in most places, but it is important to comply with local laws and regulations regarding privacy and data protection.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
  <section id="form-section" class="p-10 bg-gray text-white scale-up">
    <div class="text-center mb-6">
        <h1 class="text-3xl font-semibold">
            Book a demo or get a custom quote.
        </h1>
    </div>
    <div class="flex flex-col lg:flex-row items-center justify-center">
        <!-- Image Section -->
        <div class="mb-8 lg:mb-0 lg:mr-14"> <!-- Increased margin with lg:mr-8 -->
            <img alt="Laptop showing a map with routes" class="inline-block" height="180" src="/Real-time-vehicle-tracking/images/fou.png" width="400" />
        </div>

        <!-- Form Section -->
        <div class="bg-white text-black p-6 rounded-lg shadow-lg w-full max-w-sm">
            <form id="demo-quote-form" onsubmit="return validateForm()">
                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium" for="name">Name</label>
                    <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-sm" id="name" required type="text" />
                </div>

                <!-- Company -->
                <div class="mb-3">
                    <label class="block text-sm font-medium" for="company">Company</label>
                    <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-sm" id="company" required type="text" />
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="block text-sm font-medium" for="email">Email address</label>
                    <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-sm" id="email" required type="email" />
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label class="block text-sm font-medium" for="phone">Phone number</label>
                    <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-sm" id="phone" required type="tel" />
                </div>

                <!-- How many vehicles -->
                <div class="mb-3">
                    <label class="block text-sm font-medium">How many vehicles do you currently have?</label>
                    <div class="flex space-x-2 mt-1">
                        <button class="flex-1 border border-gray-300 rounded-md shadow-sm p-2 text-sm" type="button" onclick="selectOption(this, 'vehicle')">
                            1-10
                        </button>
                        <button class="flex-1 border border-gray-300 rounded-md shadow-sm p-2 text-sm" type="button" onclick="selectOption(this, 'vehicle')">
                            11-50
                        </button>
                        <button class="flex-1 border border-gray-300 rounded-md shadow-sm p-2 text-sm" type="button" onclick="selectOption(this, 'vehicle')">
                            51-200
                        </button>
                    </div>
                    <input type="hidden" id="vehicle-selection" required />
                </div>

                <!-- Demo or Quote -->
                <div class="mb-3">
                    <label class="block text-sm font-medium">Would you like a demo, or a quote?</label>
                    <div class="flex space-x-2 mt-1">
                        <button id="demo-button" class="flex-1 border border-gray-300 rounded-md shadow-sm p-2 text-sm" type="button" onclick="selectOption(this, 'demo-quote')">
                            Demo
                        </button>
                        <button id="quote-button" class="flex-1 border border-gray-300 rounded-md shadow-sm p-2 text-sm" type="button" onclick="selectOption(this, 'demo-quote')">
                            Quote
                        </button>
                    </div>
                    <input type="hidden" id="demo-quote-selection" required />
                </div>

                <!-- Submit -->
                <div>
                    <button class="w-full shadow-lg bg-orange-600 text-white py-2 rounded-md shadow-sm text-sm" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="bg-gray-100 py-12 overflow-hidden testimonial-section fade-in">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">What Our Customers Say</h2>
        <div class="relative">
            <!-- Sliding Container -->
            <div class="flex space-x-4 animate-slide">
                <!-- Testimonial Box 1 -->
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600 ">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
              
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600 ">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md w-64 bg-gradient-to-r from-orange-500 to-orange-600">
                    <p class="text-white italic mb-4">
                        "FleetTrack has completely transformed the way we manage our fleet. The real-time tracking and detailed reports have saved us time and money!"
                    </p>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-user-circle text-white text-4xl mr-3"></i>
                        <div>
                            <p class="font-bold text-gray-800">John Doe</p>
                            <p class="text-sm text-white">CEO, Logistics Co.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<section class="bg-gray-100 py-12">
    <div class="container mx-auto text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Why Choose FleetTrack?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Benefit 1 -->
            <div class="flex flex-col items-center">
                <i class="fas fa-map-marker-alt text-orange-500 text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Real-Time Tracking</h3>
                <p class="text-gray-600 text-sm">
                    Monitor your fleet's location in real-time and optimize routes for better efficiency.
                </p>
            </div>
            <!-- Benefit 2 -->
            <div class="flex flex-col items-center">
                <i class="fas fa-chart-line text-orange-500 text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Detailed Reports</h3>
                <p class="text-gray-600 text-sm">
                    Get actionable insights with detailed trip and driver behavior reports.
                </p>
            </div>
            <!-- Benefit 3 -->
            <div class="flex flex-col items-center">
                <i class="fas fa-headset text-orange-500 text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Award-Winning Support</h3>
                <p class="text-gray-600 text-sm">
                    Our dedicated support team is here to help you every step of the way.
                </p>
            </div>
        </div>
    </div>
</section>

  <div class="bg-gray-800 text-white py-4 text-center">
    <p class="text-xs font-semibold">Real-Time Vehicle Tracking</p>
    <p class="text-sm mt-1">&copy; 2025 FleetTrack. All rights reserved.</p>
    <div class="flex justify-center space-x-4 mt-2">
        <a href="pr.html" class="text-orange-500 hover:underline">Privacy Policy</a>
        <a href="t.html" class="text-orange-500 hover:underline">Terms of Service</a>
        <a href="contact.html" class="text-orange-500 hover:underline">Contact Us</a>
    </div>
    <!-- Social Media Buttons -->
    <div class="flex justify-center space-x-4 mt-1">
        <a href="https://accounts.google.com/o/oauth2/auth?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&response_type=code&scope=email%20profile" 
   target="_blank" 
   class="bg-red-500 text-white p-3 rounded-full shadow hover:bg-red-600 transition">
    <i class="fab fa-google"></i>
</a>
        <a href="https://twitter.com" target="_blank" class="bg-blue-400 text-white p-3 rounded-full shadow hover:bg-blue-500 transition">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://facebook.com" target="_blank" class="bg-blue-600 text-white p-3 rounded-full shadow hover:bg-blue-700 transition">
            <i class="fab fa-facebook-f"></i>
        </a>
    </div>
</div>

<div id="chatgpt-popup" class="fixed bottom-4 right-4 bg-white p-6 rounded-lg shadow-lg w-96 transform translate-y-full transition-transform duration-500 hidden">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold text-gray-800">FleetTrack Copilot</h2>
        <button onclick="closePopup()" class="text-gray-500 hover:text-gray-800 text-xl">&times;</button>
    </div>
    <div id="chatgpt-answer" class="text-gray-700 text-sm overflow-y-auto max-h-48">
        <!-- Answer will be displayed here -->
    </div>
    <div class="mt-4 flex justify-end">
        <button onclick="closePopup()" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow hover:bg-orange-600 transition">
            Close
        </button>
    </div>
</div>

 </body>
</html>



