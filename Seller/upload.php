<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file input exists
    if (isset($_FILES['pdt_img']) && $_FILES['pdt_img']['error'] === UPLOAD_ERR_OK) {
        $source_path = $_FILES['pdt_img']['tmp_name'];
        $target = "../home/old_carImages/" . basename($_FILES['pdt_img']['name']);
        
        // Move uploaded file
        if (!move_uploaded_file($source_path, $target)) {
            die("Error uploading the file.");
        }
    } else {
        die("File upload failed or no file was uploaded.");
    }

    // Database connection
    $conn = new mysqli("localhost", "root", "", "project", 3306);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate and escape user inputs
    $car_name = isset($_POST['car_name']) ? $conn->real_escape_string($_POST['car_name']) : '';
    $model_name = isset($_POST['model_name']) ? $conn->real_escape_string($_POST['model_name']) : '';
    $year = isset($_POST['year']) ? $conn->real_escape_string($_POST['year']) : '';
    $distance = isset($_POST['distance']) ? $conn->real_escape_string($_POST['distance']) : '';
    $price = isset($_POST['price']) ? $conn->real_escape_string($_POST['price']) : '';
    $owner_name = isset($_POST['owner_name']) ? $conn->real_escape_string($_POST['owner_name']) : '';
    $owner_address = isset($_POST['owner_address']) ? $conn->real_escape_string($_POST['owner_address']) : '';
    $contact = isset($_POST['contact']) ? $conn->real_escape_string($_POST['contact']) : '';

    // Insert query
    $query = "INSERT INTO old_car (car_name, model_name, year, distance, price, impath, owner_name, owner_address, contact) 
              VALUES ('$car_name', '$model_name', '$year', '$distance', '$price', '$target', '$owner_name', '$owner_address', '$contact')";

    // Debugging: Output query
    echo $query;

    // Execute query
    if ($conn->query($query)) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error in adding product: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>