<?php
session_start();

// Check login status
if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] == false) {
    echo "Unauthorized Access";
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch new car data
$query = "SELECT * FROM new_car ORDER BY year DESC"; // Latest models first
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Cars in India</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;600&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #064e3b, #0d6a4f);
            color: #fff;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h2 {
            font-family: 'Playfair Display', serif;
            margin-bottom: 20px;
            font-size: 34px;
            font-weight: 700;
            color: #f5c518;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .card {
            background: linear-gradient(145deg, #0d6a4f, #147a5b);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(255, 215, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255, 215, 0, 0.3);
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 20px rgba(255, 215, 0, 0.4);
        }

        img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }

        .info {
            text-align: left;
            margin-top: 15px;
        }

        .info p {
            margin: 5px 0;
            font-size: 16px;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #f5c518;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background: linear-gradient(135deg, #c49f0f, #f5c518);
            color: #121212;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
        }

        .btn:hover {
            background: linear-gradient(135deg, #f5c518, #ffd700);
            transform: translateY(-2px);
            box-shadow: 0px 4px 8px rgba(255, 215, 0, 0.5);
        }

        .safety-rating {
            font-weight: bold;
            margin-top: 10px;
            color: #f5c518;
        }
    </style>
</head>
<body>

    <h2>Latest Luxury Cars in India</h2>

    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">
                        <img src="' . htmlspecialchars($row['image_path']) . '" alt="Car Image">
                        <div class="info">
                            <p><strong>' . htmlspecialchars($row['car_name']) . ' - ' . htmlspecialchars($row['mode_name']) . '</strong></p>
                            <p>Brand: ' . htmlspecialchars($row['brand']) . '</p>
                            <p>Year: ' . htmlspecialchars($row['year']) . '</p>
                            <p>Fuel: ' . htmlspecialchars($row['fule_type']) . '</p>
                            <p>Transmission: ' . htmlspecialchars($row['transmission']) . '</p>
                            <p>Seating: ' . htmlspecialchars($row['seating_capacity']) . '</p>
                            <p class="price">Price: ₹' . number_format($row['price']) . '</p>
                            <p>Location: ' . htmlspecialchars($row['location']) . '</p>
                            <p class="safety-rating">Safety Rating: ' . htmlspecialchars($row['safety_rating']) . '</p>
                            <a href="tel:' . htmlspecialchars($row['contact']) . '" class="btn">Contact Seller</a>
                        </div>
                      </div>';
            }
        } else {
            echo "<p>No new cars available at the moment.</p>";
        }

        // Close connection
        $conn->close();
        ?>
    </div>

</body>
</html>
