<!-- regisztracio.php -->
<?php
// Adatbázis kapcsolat
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kornyezettudatos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Felhasználó hozzáadása az adatbázishoz
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Új felhasználó sikeresen regisztrálva!";
        header("Location: bejelentkezes.php"); // Sikeres regisztráció után irányítás a bejelentkezési oldalra
        exit();
    } else {
        echo "Hiba: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="../css/pic.css">
</head>
<body>

    <div class="registration-container">
        <h2>Regisztráció</h2>
        <form action="regisztracio.php" method="POST">
            <label for="name">Felhasználónév:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Jelszó:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Regisztráció</button>
            <button class="bbutton"> <a href="bejelentkezes.php">Bejelentkezés</a></button>
        </form>
    </div>

</body>
</html>
