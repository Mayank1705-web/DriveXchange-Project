<?php
    session_start();
    if ($_SESSION['login_status'] == false){
        echo "Unauthorized Access";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Upload</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top left, #001f3f, #004080);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Glassmorphism Form */
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 174, 255, 0.3);
            width: 400px;
            height: auto;
            text-align: center;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        h2 {
            color: #fff;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
            color: #ccc;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            color: #fff;
            transition: 0.3s;
        }

        input:focus {
            border-color: #00d9ff;
            outline: none;
            box-shadow: 0 0 12px rgba(0, 217, 255, 0.7);
        }

        /* Custom File Upload */
        .file-input {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .file-input input[type="file"] {
            display: none;
        }

        .upload-button {
            background: linear-gradient(45deg, #00d9ff, #0078ff);
            padding: 12px;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            width: 100%;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(0, 217, 255, 0.6);
        }

        .upload-button:hover {
            background: linear-gradient(45deg, #0078ff, #00d9ff);
            box-shadow: 0 0 20px rgba(0, 217, 255, 1);
        }

        .selected-file {
            margin-top: 10px;
            color: #fff;
            font-size: 14px;
        }

        /* Submit Button */
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #00d9ff, #0078ff);
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(0, 217, 255, 0.6);
            margin-top: 15px;
        }

        button:hover {
            background: linear-gradient(45deg, #0078ff, #00d9ff);
            box-shadow: 0 0 20px rgba(0, 217, 255, 1);
        }

    </style>
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <h2>Upload Product</h2>
        <div class="form-group">
            <label>Owner Name</label>
            <input type="text" placeholder="Enter owner name" name="owner_name" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" placeholder="Enter address" name="owner_address" required>
        </div>
        <div class="form-group">
            <label>Contact</label>
            <input type="text" placeholder="Enter contact" name="contact" required>
        </div>
        <div class="form-group">
            <label>Car Name</label>
            <input type="text" placeholder="Enter car name" name="car_name" required>
        </div>
        <div class="form-group">
            <label>Model Name</label>
            <input type="text" placeholder="Enter model name" name="model_name" required>
        </div>
        <div class="form-group">
            <label>Year</label>
            <input type="number" placeholder="Enter year" name="year" required>
        </div>
        <div class="form-group">
            <label>Distance</label>
            <input type="text" placeholder="Enter distance" name="distance" required>
        </div>
        <div class="form-group">
            <label>Product Price</label>
            <input type="number" placeholder="Enter price" name="price" required>
        </div>
        
        <!-- Fixed File Upload -->
        <div class="form-group">
            <input id="fileInput" type="file" accept=".jpg,.png" name="pdt_img" required>
            <p id="selectedFile" class="selected-file">No file chosen</p>
        </div>

        <button type="submit">Upload Product</button>
    </div>
</form>

<script>
    document.getElementById('fileInput').addEventListener('change', function() {
        var fileName = this.files.length > 0 ? this.files[0].name : "No file chosen";
        document.getElementById('selectedFile').textContent = fileName;
    });
</script>


</body>
</html>
