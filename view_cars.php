<?php
require_once 'security.php';
require_once 'auth_check.php';
require_agency();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cars</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="d-flex flex-column">

    <?php include 'agency_navbar.php' ?>


    <h1 class="text-center mt-5">View Cars</h1>
    <?php
//  database connection  
include 'db_connect.php';

// Fetch cars from the database
$query = "SELECT * FROM Cars";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<div class='container mt-5'>";
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Serial No.</th>";
    echo "<th>Model</th>";
    echo "<th>Vehicle Number</th>";
    echo "<th>Seating Capacity</th>";
    echo "<th>Rent Per Day</th>";
    echo "<th>Actions</th>"; 
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $serialNumber = 1; // Initial serial number

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $serialNumber . "</td>";
        echo "<td>" . $row['model'] . "</td>";
        echo "<td>" . $row['vehicle_number'] . "</td>";
        echo "<td>" . $row['seating_capacity'] . "</td>";
    echo "<td>" . $row['rent_per_day'] . "</td>";
      // Edit and delete buttons with form for delete
      echo "<td>";
      echo "<a href='edit_car.php?id=" . $row['car_id'] . "' class='btn btn-primary btn-sm mr-2'>Edit</a>";
      echo "<form method='POST' action='view_cars.php' style='display:inline-block'> ";
      echo "<input type='hidden' name='delete' value='true'>";
      echo "<input type='hidden' name='id' value='" . $row['car_id'] . "'>";
      echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this car?\")' >Delete</button>";
      echo "</form>";
      echo "</td>";
      echo "</tr>";
      $serialNumber++;// Increment serial number for next row
    }

    // PHP code block at the bottom for handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $car_id = $_POST['id'];

        // Delete the car
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

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "No cars found.";
}

// Add Car button
echo "<div class='container mt-3'>";
echo "<a href='add_car.php' class='btn btn-success'>Add Car</a>";
echo "</div>";

$conn->close();
?>



</body>

</html>
