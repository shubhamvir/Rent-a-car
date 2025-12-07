<?php
require_once 'security.php'; // Add this line

//session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include 'agency_navbar.php' ?>

    <div class="container mt-5">
        <h2 class="mb-4">View Bookings</h2>
        <?php
        //  database connection  
        include 'db_connect.php';

        // Fetch bookings with additional details from the database using a JOIN query
    
$query = "SELECT b.booking_id, b.car_id, b.customer_id, b.start_date, b.days_rented, 
          c.model, c.vehicle_number, c.seating_capacity, c.rent_per_day, u.name AS user_name
          FROM Bookings b
          JOIN Cars c ON b.car_id = c.car_id
          JOIN Users u ON b.customer_id = u.user_id";

// ✅ FIXED (if you want to be thorough, but SELECT is lower risk)
// Keep as is if no user input, or use prepared statements if adding search filters
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Booking ID</th>";
            echo "<th>Car Model</th>";
            echo "<th>Vehicle Number</th>";
            echo "<th>Seating Capacity</th>";
            echo "<th>Rent Per Day</th>";
            echo "<th>User ID</th>";
            echo "<th>Name</th>";
            echo "<th>Days Rented</th>";
            echo "<th>Booking Date</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['booking_id'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";
                echo "<td>" . $row['vehicle_number'] . "</td>";
                echo "<td>" . $row['seating_capacity'] . "</td>";
                echo "<td>" . $row['rent_per_day'] . "</td>";
                echo "<td>" . $row['customer_id'] . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['days_rented'] . "</td>";
                echo "<td>" . $row['start_date'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "No bookings found.";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>
