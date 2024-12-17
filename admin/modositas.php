<?php
require "../connect.php";

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/felvitel.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Új energiafogyasztás felvitele</title>
</head>
<body>
    <nav class="nav">
        <div class="logo">Logo</div>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="#">Bejelentkezés</a></li>
            <li><a href="#">Energiafogyasztás kalkulátor</a></li>
            <li><a href="#">Tippek</a></li>
        </ul>
        <div class="login">Bejelentkezés</div>
    </nav>
    <h1>Energiafogyasztási adatok felvitele</h1>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Hibák megjelenítése -->
            <?php if (isset($kimenet)) echo $kimenet; ?>
            
            <p><label for="date">Dátum:</label></p>
            <input type="datetime-local" name="date" id="date" required>
            
            <p><label for="consumed_quantity">Elfogyasztott mennyiség (kWh vagy kg):</label></p>
            <input type="number" name="consumed_quantity" id="consumed_quantity" step="0.01" required>
            
            <p><label for="consumption_type">Fogyasztás típusa:</label></p>
            <select name="consumption_type" id="consumption_type" required>
                <option value="aram">Áram</option>
                <option value="gaz">Gáz</option>
                <option value="viz">Víz</option>
            </select>
            
            <p><label for="waste_type">Hulladéktípus:</label></p>
            <select name="waste_type" id="waste_type" required>
                <option value="szerves">Szerves</option>
                <option value="muanyag">Műanyag</option>
                <option value="papir">Papír</option>
                <option value="uveg">Üveg</option>
                <option value="fem">Fém</option>
            </select>
            
            <input type="submit" value="Rendben" name="rendben" id="rendben">
            <input type="reset" value="Mégsem">
            <button> <a href="lista.php">Vissza a listához</a></button>
        </form>
    </div>    
</body>
</html>
