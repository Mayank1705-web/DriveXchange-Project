<?php
session_start();
if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] == false) {
    echo "Unauthorized Access";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Car Type</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            overflow: hidden;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #ffdde1);
            background-size: 300% 300%;
            animation: gradientBG 6s infinite alternate ease-in-out;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            100% {
                background-position: 100% 50%;
            }
        }

        .container {
            background: rgba(255, 255, 255, 0.3);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 350px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out;
        }

        .container:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        }

        h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #d81b60;
            animation: slideIn 1s ease-out;
        }

        p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
            animation: fadeIn 1.2s ease-in;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            background: linear-gradient(135deg, #ec407a, #d81b60);
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(236, 64, 122, 0.4);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1.5s ease-out;
        }

        .btn:hover {
            background: linear-gradient(135deg, #d81b60, #b0003a);
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(236, 64, 122, 0.5);
        }

        .btn:active {
            transform: scale(0.98);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 400px) {
            .container {
                width: 90%;
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Find Your Dream Car 🚗</h2>
        <p>Select the type of car you are looking for:</p>
        
        <form action="http://localhost/Project/Buyer/new_car.php" method="GET">
            <button type="submit" class="btn">🚗 New Cars</button>
        </form>

        <form action="http://localhost/Project/Buyer/old_car.php" method="GET">
            <button type="submit" class="btn">🚙 Old Cars</button>
        </form>
    </div>

</body>
</html>
