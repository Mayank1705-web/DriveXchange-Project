<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "project", 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' column exists; otherwise, use another column
$query = "SELECT * FROM old_car ORDER BY car_name DESC LIMIT 1"; // Change 'car_name' to the actual unique column

$result = $conn->query($query);

// Check for query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Check if a record exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No product found.";
    exit();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Product</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top left, #001f3f, #004080);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 174, 255, 0.3);
            width: 400px;
            text-align: center;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        h2 {
            margin-bottom: 15px;
        }

        img {
            max-width: 100%;
            border-radius: 10px;
            margin-top: 10px;
            box-shadow: 0 0 12px rgba(0, 217, 255, 0.6);
        }

        .info {
            text-align: left;
            margin-top: 15px;
        }

        .info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Latest Uploaded Product</h2>
        <img src="<?php echo htmlspecialchars($row['impath']); ?>" alt="Car Image">
        
        <div class="info">
            <p><strong>Owner Name:</strong> <?php echo htmlspecialchars($row['owner_name']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($row['owner_address']); ?></p>
            <p><strong>Car Name:</strong> <?php echo htmlspecialchars($row['car_name']); ?></p>
            <p><strong>Model Name:</strong> <?php echo htmlspecialchars($row['mode_name']); ?></p>
            <p><strong>Year:</strong> <?php echo htmlspecialchars($row['year']); ?></p>
            <p><strong>Distance:</strong> <?php echo htmlspecialchars($row['distance']); ?> km</p>
            <p><strong>Price:</strong> ₹<?php echo htmlspecialchars($row['price']); ?></p>
            <p><strong>Contact:</strong> <?php echo htmlspecialchars($row['contact']); ?></p>
        </div>
    </div>

</body>
</html>
