<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="d-flex flex-column">

    <?php include 'agency_navbar.php' ?>

</body>

</html>


<?php
// database connection  
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $car_id = $_GET['id'];


    // Prepare and execute the SELECT query
    $stmt = $conn->prepare("SELECT * FROM Cars WHERE car_id = ?");
    $stmt->bind_param("i", $car_id);
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($car_id, $agency_id, $model, $vehicle_number, $seating_capacity, $rent_per_day);

    // Fetch the result
    if ($stmt->fetch()) {
        // Car details fetched successfully
        $car_details = array(
            'car_id' => $car_id,
            'agency_id' => $agency_id,
            'model' => $model,
            'vehicle_number' => $vehicle_number,
            'seating_capacity' => $seating_capacity,
            'rent_per_day' => $rent_per_day
        );

        // Display a form pre-filled with the car details
        echo "<div class='container mt-5'>";
        echo "<h2>Edit Car</h2>";
        echo "<form method='POST' action='edit_car.php?id=" . $car_id . "'>";

        echo "<div class='form-group'>";
        echo "<label for='model'>Model:</label>";
        echo "<input type='text' class='form-control' id='model' name='model' value='" . $car_details['model'] . "'>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='vehicle_number'>Vehicle Number:</label>";
        echo "<input type='text' class='form-control' id='vehicle_number' name='vehicle_number' value='" . $car_details['vehicle_number'] . "'>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='seating_capacity'>Seating Capacity:</label>";
        echo "<input type='number' class='form-control' id='seating_capacity' name='seating_capacity' value='" . $car_details['seating_capacity'] . "'>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='rent_per_day'>Rent Per Day:</label>";
        echo "<input type='number' class='form-control' id='rent_per_day' name='rent_per_day' value='" . $car_details['rent_per_day'] . "'>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary' name='submit'>Update Car</button>";
        echo "</form>";
        echo "</div>";
    } else {
        // Car with the specified ID not found
        echo "Car not found.";
    }

    // Close the statement
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) { // Update car details
        $car_id = $_GET['id'];
        $model = $_POST['model'];
        $vehicle_number = $_POST['vehicle_number'];
        $seating_capacity = $_POST['seating_capacity'];
        $rent_per_day = $_POST['rent_per_day'];

        // **Update the car details (unchanged)**
        $stmt = $conn->prepare("UPDATE Cars SET model = ?, vehicle_number = ?, seating_capacity = ?, rent_per_day = ? WHERE car_id = ?");
        $stmt->bind_param("sssss", $model, $vehicle_number, $seating_capacity, $rent_per_day, $car_id);

        if ($stmt->execute()) {
            // Update successful
            $_SESSION['message'] = "Car details updated successfully.";
            header("Location: view_cars.php");
            exit();
        } else {
            // Update failed
            echo "Error updating car details: " . $conn->error;
        }

        $stmt->close();
    } else if (isset($_POST['delete'])) { // Delete car
        $car_id = $_POST['id'];

        // **Delete the car**
        $stmt = $conn->prepare("DELETE FROM Cars WHERE car_id = ?");
        $stmt->bind_param("i", $car_id);

        if ($stmt->execute()) {
            // Delete successful
            $_SESSION['message'] = "Car deleted successfully.";
            header("Location: view_cars.php");
            exit();
        } else {
            // Delete failed
            echo "Error deleting car: " . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>