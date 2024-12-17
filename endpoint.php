<?php
// Beillesztjük az adatbázis kapcsolatot
require 'connect.php';

// Az eredmény tárolására szolgáló tömb
$response = [];

try {
    // Kapcsolódás az adatbázishoz a connect.php-ban található kapcsolattal
    if ($conn) {
        // Létrehozunk egy SQL lekérdezést
        $query = "SELECT * FROM energy_consumption";
        $result = mysqli_query($conn, $query);

        // Ellenőrizzük, hogy van-e eredmény
        if ($result) {
            // Az adatok tömbbe helyezése
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            
            $response['data'] = $data;
            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Hiba a lekérdezés során: ' . mysqli_error($conn);
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Nem sikerült csatlakozni az adatbázishoz.';
    }
} catch (Exception $e) {
    // Hibakezelés
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

// A válasz JSON formátumban történő visszaadása
header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);
