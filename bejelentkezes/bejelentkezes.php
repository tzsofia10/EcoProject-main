<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kornyezettudatos";

session_start();
$errMsg = '';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE name = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Lekérdezési hiba: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['name']; // Sessionben tárolt változó

            // Átirányítás az index.php oldalra
            header("Location: ../home.php");
            exit();
        } else {
            $errMsg = "Hibás jelszó!";
        }
    } else {
        $errMsg = "A felhasználónév nem található!";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="../css/pic.css">
    <style>
        p.red {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <h2>Bejelentkezés</h2>
        <form action="" method="POST">
            <label for="name">Felhasználónév:</label>
            <input type="text" name="username" required>
            
            <label for="password">Jelszó:</label>
            <input type="password" name="password" required>
            
            <p class="red"><?php echo $errMsg; ?></p>
            <button type="submit">Bejelentkezés</button>
        </form>
        <p>Még nincs fiókod? <a href="regisztracio.php">Regisztrálj most!</a></p>
    </div>

</body>
</html>
