<?php

session_start();
//  database connection  
include 'db_connect.php';
// Query to retrieve available cars from the database
$sql = "SELECT * FROM Cars";
$result = $conn->query($sql);



// Function to book a car
function bookCar($car_id, $customer_id, $start_date, $days_rented) {
    global $conn;
    // Insert booking details into the database
    $sql = "INSERT INTO Bookings (car_id, customer_id, start_date, days_rented) VALUES ('$car_id', '$customer_id', '$start_date', '$days_rented')";
    if ($conn->query($sql) === TRUE) {
        // echo "Car booked successfully!";
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
    $customer_id = $_SESSION['user_id']; 
    $start_date = $_POST['start_date'];
    $days_rented = $_POST['days'];
    bookCar($car_id, $customer_id, $start_date, $days_rented);
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
    .navbar {
        background-color: #008DDA;
    }

    .navbar-nav {
        margin: auto;
    }

    .nav-item .nav-link {
        color: white;
        font-size: 18px;
    }

    .buttons {
        margin: auto;
    }


    a {
        text-decoration: none;
    }

    /* Card Styles */

    .card-sl {
        border-radius: 8px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .card-image img {
        max-height: 100%;
        max-width: 100%;
        border-radius: 8px 8px 0px 0;
    }

    .card-action {
        position: relative;
        float: right;
        margin-top: -25px;
        margin-right: 20px;
        z-index: 2;
        color: #E26D5C;
        background: #fff;
        border-radius: 100%;
        padding: 15px;
        font-size: 15px;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);
    }

    .card-action:hover {
        color: #fff;
        background: #E26D5C;
        -webkit-animation: pulse 1.5s infinite;
    }

    .card-heading {
        font-size: 18px;
        font-weight: bold;
        background: #fff;
        padding: 10px 15px;
    }

    .card-text {
        padding: 10px 15px;
        background: #fff;
        font-size: 14px;
        color: #636262;
    }

    .card-button {
        display: flex;
        justify-content: center;
        padding: 10px 0;
        width: 100%;
        background-color: #1F487E;
        color: #fff;
        border-radius: 0 0 8px 8px;
    }

    .card-button:hover {
        text-decoration: none;
        background-color: #1D3461;
        color: #fff;
    }


    @-webkit-keyframes pulse {
        0% {
            -moz-transform: scale(0.9);
            -ms-transform: scale(0.9);
            -webkit-transform: scale(0.9);
            transform: scale(0.9);
        }

        70% {
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -webkit-transform: scale(1);
            transform: scale(1);
            box-shadow: 0 0 0 50px rgba(90, 153, 212, 0);
        }

        100% {
            -moz-transform: scale(0.9);
            -ms-transform: scale(0.9);
            -webkit-transform: scale(0.9);
            transform: scale(0.9);
            box-shadow: 0 0 0 0 rgba(90, 153, 212, 0);
        }
    }
    </style>
</head>

<body>
    <?php include 'customer_navbar.php' ?>


    <!-- Display success message if registration was successful -->
    <?php if(isset($_SESSION["registration_success"])): ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $_SESSION["registration_success"]; ?>
    </div>



    <?php unset($_SESSION["registration_success"]); // Clear the session variable ?>
    <?php endif; ?>

    <!-- Display error message if registration failed -->
    <?php if(isset($_SESSION["registration_error"])): ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $_SESSION["registration_error"]; ?>
    </div>
    <?php unset($_SESSION["registration_error"]); // Clear the session variable ?>
    <?php endif; ?>

    <div class="container my-5 main">
        <h1 class="text-center">Welcome to the Car Rental Agency</h1>
    </div>

    <div class="container">
        <div class="heading">
            <h3>Cheap car rentals</h3>
        </div>



        <div class="container" style="margin-top:50px; margin-bottom:100px">
            <div class="row">
                <?php
            // Iterate over the retrieved car data and display each car in a card
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col-md-4">
                    <div class="card p-2 ">
                        <div class="card-body">
                            <h5 class="card-title">Vehicle Model: <?php echo $row['model']; ?></h5>
                            <h5 class="card-title">Vehicle Number: <?php echo $row['vehicle_number']; ?></h5>
                            <h5 class="card-title">Seating Capacity: <?php echo $row['seating_capacity']; ?></h5>
                            <h5 class="card-title">Rent Per Day: Rs. <?php echo $row['rent_per_day']; ?></h5>


                            <?php if(isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
                            <form action="" method="POST">
                                <input type="hidden" name="car_id" value="<?php echo $row['car_id']; ?>">
                                <div class="form-group">

                                    <label for="days">Number of Days:</label>
                                    <select class="form-control" id="days" name="days" required>
                                        <option value="1">1 Day</option>
                                        <option value="2">2 Days</option>
                                        <option value="3">3 Days</option>
                                        <option value="4">4 Days</option>
                                        <option value="5">5 Days</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Rent
                                    Car</button>
                            </form>
                            <?php else: ?>
                            <button type="button" class="btn btn-primary mt-4" onclick="redirectToLogin()">Rent
                                Car</button>
                            <script>
                            function redirectToLogin() {
                                window.location.href = "customer_login.php";
                            }
                            </script>
                            <?php endif; ?>

                            <!-- <a href="available_cars.php" class="btn btn-primary mt-3">Book Now</a> -->
                        </div>
                    </div>
                </div>
                <?php
                }
            } else {
                echo "No cars available for rent.";
            }
            ?>
            </div>

        </div>


        <!-- Display booking message -->
        <?php if(isset($booking_message)): ?>
        <div class="container mt-3">
            <div class="alert <?php echo strpos($booking_message, 'successfully') !== false ? 'alert-success' : 'alert-danger'; ?>"
                role="alert">
                <?php echo $booking_message; ?>
            </div>
        </div>
        <?php endif; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>