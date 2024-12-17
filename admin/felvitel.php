<?php 
    // Kezdjük a session-t
    session_start();
    
    // Ha nincs bejelentkezve a felhasználó, irányítsuk a bejelentkezési oldalra
    if (!isset($_SESSION['username'])) {
        header("Location: ../bejelentkezes/bejelentkezes.php");
        exit();
    }

    // Hibák tömbjének inicializálása
    $hibak = [];

    // Ellenőrizzük, hogy a formot beküldték
    if (isset($_POST['rendben'])) {
        // A form adatait biztonságosan beolvaszuk
        $date = htmlspecialchars(strip_tags($_POST['date']));
        $consumed_quantity = floatval($_POST['consumed_quantity']);
        $consumption_type = htmlspecialchars(strip_tags($_POST['consumption_type']));
        $waste_type = htmlspecialchars(strip_tags($_POST['waste_type']));
        $user_id = 1; // Mivel nem volt meghatározva, alapértelmezett felhasználó ID 1

        // Hibakezelés
        if (empty($date)) {
            $hibak[] = "A dátum megadása kötelező!";
        }

        if ($consumed_quantity <= 0) {
            $hibak[] = "Az elfogyasztott mennyiségnek pozitív számnak kell lennie!";
        }

        if (empty($consumption_type)) {
            $hibak[] = "A fogyasztás típusának megadása kötelező!";
        }

        // Ha nincs hiba, akkor felvisszük az adatokat az adatbázisba
        if (empty($hibak)) {
            // Kapcsolódás az adatbázishoz
            require "../connect.php";

            // SQL lekérdezés előkészítése          inner join
            try {
                // energy_consumption tábla
                $sql_energy_consumption = "INSERT INTO energy_consumption (user_id, date, consumed_quantity) 
                                           VALUES ('$user_id', '$date', '$consumed_quantity')";
                if (!mysqli_query($conn, $sql_energy_consumption)) {
                    throw new Exception("Hiba történt az 'energy_consumption' táblában");
                }
                $energy_consumption_id = mysqli_insert_id($conn);
            
                // energy_consumption_type tábla
                $sql_energy_consumption_type = "INSERT INTO energy_consumption_type (energy_consumption_id, user_id, unit) 
                                                VALUES ('$energy_consumption_id', '$user_id', '$consumption_type')";
                if (!mysqli_query($conn, $sql_energy_consumption_type)) {
                    throw new Exception("Hiba történt az 'energy_consumption_type' táblában");
                }

                // Itt határozzuk meg a waste_quantity-t, például használhatjuk a consumed_quantity értéket
                $waste_quantity = $consumed_quantity;  // A waste_quantity = consumed_quantity

                // waste_tracking tábla
                $sql_waste_tracking = "INSERT INTO waste_tracking (user_id, date, quantity) 
                                       VALUES ('$user_id', '$date', '$waste_quantity')";
                if (!mysqli_query($conn, $sql_waste_tracking)) {
                    throw new Exception("Hiba történt a 'waste_tracking' táblában");
                }
                $waste_tracking_id = mysqli_insert_id($conn);
            
                // waste_type tábla
                $sql_waste_type = "INSERT INTO waste_type (waste_tracking_id, user_id, unit, recycled) 
                                   VALUES ('$waste_tracking_id', '$user_id', '$waste_type', 0)";
                if (!mysqli_query($conn, $sql_waste_type)) {
                    throw new Exception("Hiba történt a 'waste_type' táblában");
                }
            
                // Ha minden sikerült, elkötelezzük a tranzakciót
                mysqli_commit($conn);
                echo "Sikeres adatbevitel!";
            } catch (Exception $e) {
                // Hiba esetén visszavonjuk a tranzakciót
                mysqli_roll_back($conn);
                echo "Hiba történt: " . $e->getMessage();
            }
        } else {
            // Hibák megjelenítése
            $kimenet = "<ul>";
            foreach ($hibak as $hiba) {
                $kimenet .= "<li>" . $hiba . "</li>";
            }
            $kimenet .= "</ul>";
        }
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/felvitel.css">
    <title>Új energiafogyasztás felvitele</title>
</head>
<body>
    <div class="container">
        <form action="felvitel.php" method="post">
            <!-- Hibák megjelenítése -->
            <?php if (isset($kimenet)) echo $kimenet; ?>
            
            <p><label for="date">Dátum:</label></p>
            <input type="date" name="date" id="date"   min="2000-01-01"  required>
            
            <p><label for="consumed_quantity">Elfogyasztott mennyiség:</label></p>
            <input type="number" name="consumed_quantity" min="0" id="consumed_quantity" step="0.01" required>
            
            <p><label for="consumption_type">Fogyasztás típusa:</label></p>
            <select name="consumption_type" id="consumption_type" required>
                <option value="aram">Áram</option>
                <option value="gaz">Gáz</option>
                <option value="viz">Víz</option>
            </select>
            
            <p><label for="waste_type">Hulladéktípus mennyiség:</label></p>
            <input type="number" name="waste_type" min="0" id="quantity" step="0.01" required>
            
            <select name="waste_type" id="waste_type" required>
                <option value="szerves">Szerves</option>
                <option value="muanyag">Műanyag</option>
                <option value="papir">Papír</option>
                <option value="uveg">Üveg</option>
                <option value="fem">Fém</option>
            </select>
            
            <input type="submit" value="Rendben" name="rendben" id="rendben">
            <input type="reset" value="Mégsem">
            <button><a href="../home.php">Vissza a fő oldalra</a></button>
        </form>
    </div>    
</body>
</html>
