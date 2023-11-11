<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpro II_162112133013</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
        }
        /* button {
            background-color: #007BFF;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5px;
        } */

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 50px;
            background: peru;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
        }

        .navbar {
            display: flex;
            margin-left: 20px;
        }

        .navbar a {
            position: relative;
            font-size: 18px;
            color: #fff;
            font-weight: 500;
            text-decoration: none;
            padding: 0 10px;
        }

        form {
            width: 300px;
            padding: 30px;
            border-radius: 5px;
            font-size: 20px;
            margin: auto;
        }

        label {
            display: flex;
            margin-bottom: 2px;
        }

        input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #0073e6;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin-left:8px;
            width: 100%;
        }
    </style>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="Tabel_162112133013_Ghifary Abrar Rabbani.php">Data</a>
            <a href="input.php">Input Data</a>
        </nav>
    </header>
    <br>
    <br>
    <br>
    <br>
    <form action="" method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id"><br><br>

        <label for="F_Name">First Name:</label>
        <input type="text" id="F_Name" name="F_Name"><br><br>

        <label for="L_Name">Last Name:</label>
        <input type="text" id="L_Name" name="L_Name"><br><br> <!-- Perbaiki typo disini (from "type text" to "type="text") -->

        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>

        <label for="email2">Email2:</label> <!-- Perbaiki nama "Email2" menjadi "email2" agar sesuai dengan PHP -->
        <input type="text" id="email2" name="email2"><br><br>

        <label for="profesi">Profesi:</label>
        <input type="text" id="profesi" name="profesi"><br>

        <input type="submit" name="submit" value="Submit">
    </form>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $f_name = $_POST['F_Name'];
    $l_name = $_POST['L_Name'];
    $email = $_POST['email'];
    $email2 = $_POST['email2'];
    $profesi = $_POST['profesi'];

    // Data yang akan ditambahkan ke file CSV
    $newData = "$id,$f_name,$l_name,$email,$email2,$profesi\n";

    // Nama dan path file CSV lokal
    $csvFilePath = 'datapribadi.csv';

    // Menyimpan data ke file CSV lokal
    file_put_contents($csvFilePath, $newData, FILE_APPEND);
        // Jika penyimpanan lokal berhasil, unggah ke server remote
    $csvUrl = 'https://alpro2-162112133013.alwaysdata.net/datapribadi.csv';
    $ch = curl_init($csvUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($csvFilePath));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Periksa respons dan tampilkan pesan
    if ($httpCode == 200) {
       echo "<p>Data berhasil diunggah ke server eksternal.</p>";
    } else {
     echo "<p>Gagal mengunggah data ke server eksternal. Status HTTP: $httpCode</p>";
        }
    }

?>
</body>
</html>
