<?php
include "database.php";

if (isset($_POST['submit'])) {
    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $jaar = $_POST['jaar'];
    $kenteken = $_POST['kenteken'];
    $beschikbaarheid = $_POST['beschikbaarheid'];
    $prijs = $_POST['prijs'];

    // Bestandsverwerking voor afbeelding
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $target_directory = "images/";
    $target_file = $target_directory . basename($image);

    // Upload de afbeelding naar de server
    if (move_uploaded_file($image_temp, $target_file)) {
        // Als de afbeelding succesvol is geüpload, voeg de auto toe aan de database
        $database = new Database();
        $database->addCar($merk, $model, $jaar, $kenteken, $beschikbaarheid, $prijs, $image);
        echo "Nieuwe auto succesvol toegevoegd!";
    } else {
        echo "Fout bij het uploaden van de afbeelding.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg Auto Toe</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        form {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            color: #4caf50;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            display: block;
            margin: 10px 0 8px;
            color: #333;
            font-weight: bold;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="file"] {
            display: none;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn {
            border: 2px solid #4caf50;
            color: #4caf50;
            background-color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        .custom-file-selected {
            color: #495057;
            font-size: 14px;
            margin-top: 8px;
        }

        .uploaded-image {
            margin-top: 16px;
            text-align: center;
        }

        .btn-primary {
            background-color: #4caf50;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Voeg een nieuwe auto toe</h2>

        <label for="merk">Merk:</label>
        <input type="text" id="merk" name="merk" required>

        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required>

        <label for="jaar">Jaar:</label>
        <input type="number" id="jaar" name="jaar" required>

        <label for="kenteken">Kenteken:</label>
        <input type="text" id="kenteken" name="kenteken" required>

        <label for="beschikbaarheid">Beschikbaarheid:</label>
        <input type="text" id="beschikbaarheid" name="beschikbaarheid" required>

        <label for="prijs">Prijs:</label>
        <input type="text" id="prijs" name="prijs" required>

        <div class="upload-btn-wrapper">
            <label for="image" class="btn">Kies een afbeelding</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <div class="custom-file-selected" id="file-name">Bestand niet geselecteerd</div>
        </div>

        <div class="uploaded-image" id="uploaded-image"></div>

        <input type="submit" class="btn-primary" value="Voeg Auto Toe" name="submit">

        <script>
            document.getElementById('image').addEventListener('change', function () {
                var fileName = this.value.split("\\").pop();
                document.getElementById('file-name').textContent = fileName;

                // Toon de geselecteerde afbeelding
                var fileInput = document.getElementById('image');
                var uploadedImage = document.getElementById('uploaded-image');
                uploadedImage.innerHTML = '';

                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100%';
                        img.style.borderRadius = '8px';
                        uploadedImage.appendChild(img);
                    }

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        </script>
    </form>
</body>

</html>
