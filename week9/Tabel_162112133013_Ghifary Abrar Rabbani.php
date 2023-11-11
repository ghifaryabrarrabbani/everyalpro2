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
    display: flex;
    flex-direction: column;
    height: 100vh;
    margin: 0;
}

h1 {
    text-align: center;
}

.box {
    width: 50%;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin: 10px auto;
    background-color: #eaeaeaab;
    border-radius: 15px;
}

.input-container {
    display: flex;
    justify-content: center; /* Memusatkan horizontal */
    align-items: center; /* Memusatkan vertikal */
}

#urlInput {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 500px;
}

/* Tambahkan gaya untuk pesan kesalahan */
.error-message {
    font-size: 14px;
}

button {
    background-color: #007BFF;
    color: white;
    padding: 8px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 5px;
}

button:hover {
    background-color: #0056b3;
}

/* Tabel */
.table-container {
    overflow-x: auto;
    margin-top: 10px;
}

table {
    font-size: 12px;
    padding: 8px;
    text-align: center;
    border: 1px solid black;
    width: 100%;
    font-family: 'Montserrat', sans-serif;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: rgb(41, 145, 236);
    color: white;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

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
    margin-left: 20px; /* Margin di antara elemen-elemen pada layar yang lebih besar */
}

.navbar a {
    position: relative;
    font-size: 18px;
    color: #fff;
    font-weight: 500;
    text-decoration: none;
    padding: 0 10px; /* Margin yang lebih kecil di antara elemen-elemen pada layar yang lebih kecil */
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
<?php
    function csvToJson($csvUrl) {
        $csvData = [];
        
        if (($handle = fopen($csvUrl, 'r')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $csvData[] = $row;
            }
            fclose($handle);
        }
    
        // Assuming the first row of the CSV contains the column headers
        $headers = array_shift($csvData);
    
        $jsonArray = [];
    
        foreach ($csvData as $row) {
            $jsonArrayItem = array(); #Dari error expected berbentuk (), bukan []
            for ($i = 0; $i< 6; $i++) { #Dari error expected memiliki ; sehingga perlu didefinisikan perulangannya
                #Perulangan tersebut dimulai dari 0, yang bertambah terus hingga kurang dari 6, karena kolom yang digunakan sebanyak
                $jsonArrayItem[$headers[$i]] = $row[$i];
            }
            $jsonArray[] = $jsonArrayItem;
        }
    
        return json_encode($jsonArray);
    }
    
    $csvUrl = 'https://alpro2-162112133013.alwaysdata.net/datapribadi.csv';
    $jsonData = csvToJson($csvUrl);
    $data = json_decode($jsonData, true); #didecode kembali agar dapat dibaca
?>
Search Data
<input type="text" id="search" name="search" style="text-align: center;" placeholder="Input search" onkeyup=search()>
<br>
Sort Data
    <select name="rowCount" id="rowCount" onchange="setRowCount()">
        <option value="all">All</option>
        <option value="10">10 Rows</option>
        <option value="20">20 Rows</option>
        <option value="50">50 Rows</option>
    </select>
    </div>
        <div class="table-container">
            <table>
                <tr>
                    <td>ID</td>
                    <td>F_Name</td>
                    <td>L_Name</td>
                    <td>email</td>
                    <td>email2</td>
                    <td>profesi</td>
                </tr>
                    <?php
                    foreach ($data as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . "</td>";
                        echo "<td>" . $row['F_Name'] . "</td>";
                        echo "<td>" . $row['L_Name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['email2'] . "</td>";
                        echo "<td>" . $row['profesi'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
            </table>
        </div>
</body>
<script> function search() {
    var input = document.getElementById("search");
    var filter = input.value.toLowerCase();
    var table = document.querySelector("table");
    var rows = table.getElementsByTagName('tr');

    for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var rowData = row.textContent.toLowerCase();

        if (rowData.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

function setRowCount() {
            var rowCount = document.getElementById("rowCount").value;
            var table = document.querySelector("table");
            var rows = table.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) {
                if (rowCount === "all" || i <= rowCount) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
</script>
</html>