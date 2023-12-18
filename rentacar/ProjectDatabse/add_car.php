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
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <style>
        body {
            background-color: #d3d3d3;
            font-family: 'Montserrat', sans-serif;
            color: #fff;
            font-size: 14px;
            letter-spacing: 1px;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: url(https://images.pexels.com/photos/120049/pexels-photo-120049.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Montserrat', sans-serif;
        }

        .login {
            position: relative;
            height: auto;
            width: auto;
            margin: auto;
            padding: 60px 60px;
            backdrop-filter: blur(20px);
            box-shadow: 0px 30px 60px -5px #000;
            border-radius: 8px;
            text-align: center;
        }

        form {
            padding-top: 20px;
        }

        h2 {
            padding-left: 12px;
            font-size: 22px;
            text-transform: uppercase;
            padding-bottom: 5px;
            letter-spacing: 2px;
            display: inline-block;
            font-weight: 100;
        }

        span {
            text-transform: uppercase;
            font-size: 12px;
            opacity: 0.4;
            display: inline-block;
            position: relative;
            top: -20px;
            transition: all 0.5s ease-in-out;
        }

        input {
            border: none;
            width: 100%;
            padding: 10px 20px;
            display: block;
            height: 15px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0);
            overflow: hidden;
            margin-top: 15px;
            transition: all 0.5s ease-in-out;
            color: #fff;
        }

        input:focus {
            outline: 0;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            background: rgba(0, 0, 0, 0);
        }

        input:focus+span {
            opacity: 0.6;
        }

        input[type="text"],
        input[type="number"],
        input[type="password"] {
            font-family: 'Montserrat', sans-serif;
            color: #fff;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            margin-top: 15px;
        }

        .btn {
            border: 2px solid #1161ed;
            color: #1161ed;
            background-color: transparent;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #1161ed;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            color: #fff;
            margin-top: 30px;
            height: 50px;
        }

        .btn-primary:hover {
            background-color: #4082f5;
        }

        .custom-checkbox {
            -webkit-appearance: none;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 8px;
            border-radius: 2px;
            display: inline-block;
            position: relative;
            top: 6px;
            margin-top: 15px;
        }

        .custom-checkbox:checked {
            background-color: rgba(17, 97, 237, 1);
        }

        .custom-checkbox:checked:after {
            content: '\2714';
            font-size: 10px;
            position: absolute;
            top: 1px;
            left: 4px;
            color: #fff;
        }

        .custom-checkbox:focus {
            outline: none;
        }

        label {
            display: inline-block;
            width: 100%;
            text-align: start;
            padding-top: 10px;
            padding-left: 5px;
        }

        .uploaded-image {
            margin-top: 16px;
            text-align: center;
        }
        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            margin-top: 15px;
        }

        .file-upload {
            display: inline-block;
            width: auto;
            padding: 10px 20px;
            border: 2px solid #1161ed;
            border-radius: 8px;
            background-color: transparent;
            color: #1161ed;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .file-upload:hover {
            background-color: #1161ed;
            color: #fff;
        }

        #file-name {
            display: inline-block;
            margin-top: 15px;
            opacity: 0.6;
        }

        #image {
            display: none;
        }
    </style>
</head>

<body>
    <div class="login">
        <h2>Voeg een nieuwe auto toe</h2>
        <form action="" method="post" enctype="multipart/form-data">

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
            

            <div class="file-upload-wrapper">
                <label for="image" class="file-upload">Kies een afbeelding</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                <div id="file-name"></div>
            </div>

            <div class="uploaded-image" id="uploaded-image"></div>

            <input type="submit" class="btn-primary" value="Voeg Auto Toe" name="submit">
        </form>

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
