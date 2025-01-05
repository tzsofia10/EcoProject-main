<?php
    session_start();

    // Adatbázis kapcsolat
    require "../connect.php";

    $hibak = [];
    $adatok = [];

    // Ellenőrizzük, hogy a felhasználó be van jelentkezve
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];

        // Adatok lekérése
        try {
            $sql = "SELECT 
                energy_consumption.date AS consumption_date, 
                energy_consumption.consumed_quantity, 
                energy_consumption_type.unit AS consumption_type, 
                waste_tracking.quantity AS waste_quantity, 
                waste_type.unit AS waste_type
            FROM energy_consumption
            LEFT JOIN energy_consumption_type 
                ON energy_consumption.id = energy_consumption_type.energy_consumption_id
            LEFT JOIN waste_tracking 
                ON energy_consumption.id = waste_tracking.id
            LEFT JOIN waste_type 
                ON waste_tracking.id = waste_type.waste_tracking_id
            WHERE energy_consumption.user_id = '$user_id'"; // A bejelentkezett felhasználó adatai

            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $adatok[] = $row;
                }
            } else {
                $hibak[] = "Nincsenek megjeleníthető adatok.";
            }
        } catch (Exception $e) {
            $hibak[] = "Hiba történt az adatok lekérése során: " . $e->getMessage();
        }
    } else {
        $hibak[] = "Nincs bejelentkezett felhasználó!";
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/lista.css">
    <title>Energiafogyasztás Adatok</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            color:black;
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Felhasználói energiafogyasztás és hulladék adatok</h1>

        <!-- Hibák megjelenítése -->
        <?php if (!empty($hibak)): ?>
            <ul>
                <?php foreach ($hibak as $hiba): ?>
                    <li><?php echo htmlspecialchars($hiba); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <!-- Adatok táblázata -->
        <?php if (!empty($adatok)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Dátum</th>
                        <th>Elfogyasztott mennyiség</th>
                        <th>Fogyasztás típusa</th>
                        <th>Hulladékmennyiség</th>
                        <th>Hulladéktípus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($adatok as $adat): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($adat['consumption_date']); ?></td>
                            <td><?php echo htmlspecialchars($adat['consumed_quantity']); ?> egység</td>
                            <td><?php echo htmlspecialchars($adat['consumption_type']); ?></td>
                            <td><?php echo htmlspecialchars($adat['waste_quantity']); ?> egység</td>
                            <td><?php echo htmlspecialchars($adat['waste_type']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <button><a href="../index.php">Vissza a fő oldalra</a></button>
    </div>
</body>
</html>
