<?php
session_start();

// Check login status
if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] == false) {
    echo "Unauthorized Access";
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "project", 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch old car data
$query = "SELECT * FROM old_car ORDER BY year DESC"; // Sorting by latest model year
$result = $conn->query($query);

// Check for query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚗 Old Cars for Sale</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle, #1a1a2e, #16213e);
            color: #fff;
            text-align: center;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            font-size: 35px;
            font-weight: bold;
            background: linear-gradient(90deg, #ff6b6b, #f0c27b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
            max-width: 1300px;
            margin: auto;
            padding-bottom: 30px;
        }

        .card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            text-align: left;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0px 15px 40px rgba(255, 255, 255, 0.15);
        }

        img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .info {
            margin-top: 12px;
        }

        .info p {
            font-size: 16px;
            margin: 6px 0;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #ff6b6b;
        }

        .contact-btn {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 10px;
            background: linear-gradient(90deg, #ff6b6b, #ffb88c);
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0px 0px 10px rgba(255, 107, 107, 0.6);
            position: relative;
            overflow: hidden;
        }

        .contact-btn:hover {
            background: linear-gradient(90deg, #ff4757, #ff9f43);
            transform: scale(1.05);
            box-shadow: 0px 0px 15px rgba(255, 107, 107, 0.8);
        }

        @media (max-width: 400px) {
            .container {
                width: 90%;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <h2>🚗 Find Your Dream Car</h2>

    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">
                        <img src="' . htmlspecialchars($row['impath']) . '" alt="Car Image">
                        <div class="info">
                            <p><strong>' . htmlspecialchars($row['car_name']) . ' - ' . htmlspecialchars($row['model_name']) . '</strong></p>
                            <p>Year: ' . htmlspecialchars($row['year']) . '</p>
                            <p>Distance: ' . htmlspecialchars($row['distance']) . ' km</p>
                            <p class="price">Price: ₹' . htmlspecialchars($row['price']) . '</p>
                            <p>Owner: ' . htmlspecialchars($row['owner_name']) . '</p>
                            <p>Contact: ' . htmlspecialchars($row['contact']) . '</p>
                            <a href="tel:' . htmlspecialchars($row['contact']) . '" class="contact-btn">📞 Call Now</a>
                        </div>
                      </div>';
            }
        } else {
            echo "<p>No old cars available at the moment.</p>";
        }

        // Close connection
        $conn->close();
        ?>
    </div>

</body>
</html>
