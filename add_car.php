<?php
require_once 'security.php';

// Your existing session_start() and other code
?>
<!-- Add New Cars Page -->

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //  database connection  
    include 'db_connect.php';

    // Get form data
    $agencyId = $_SESSION["agency_id"]; 
    $model = $_POST["model"];
    $vehicleNumber = $_POST["vehicle_number"];
    $seatingCapacity = $_POST["seating_capacity"];
    $rentPerDay = $_POST["rent_per_day"];

    // SQL statement
    $stmt = $conn->prepare("INSERT INTO Cars (agency_id, model, vehicle_number, seating_capacity, rent_per_day) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $agencyId, $model, $vehicleNumber, $seatingCapacity, $rentPerDay);

    // Execute the statement
    if ($stmt->execute()) {
        // Car registration successful
        $_SESSION["car_registration_success"] = "Car registered successfully.";
        header("Location: agency_dashboard.php");
        exit();
    } else {
        // Car registration failed
        $_SESSION["car_registration_error"] = "Error occurred while registering the car.";
        header("Location: add_car.php");
        exit();
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
    <title>Add New Car</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <?php include 'agency_navbar.php' ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Add New Car</h3>
                        <form action="add_car.php" method="POST">
                            <div class="form-group">
                                <label for="agency_id">Agency ID</label>
                                <input type="text" class="form-control" id="agency_id" name="agency_id">
                            </div>
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" required>
                            </div>
                            <div class="form-group">
                                <label for="vehicle_number">Vehicle Number</label>
                                <input type="text" class="form-control" id="vehicle_number" name="vehicle_number"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="seating_capacity">Seating Capacity</label>
                                <input type="number" class="form-control" id="seating_capacity" name="seating_capacity"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="rent_per_day">Rent Per Day</label>
                                <input type="number" class="form-control" id="rent_per_day" name="rent_per_day"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Add Car</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
