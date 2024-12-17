<?php
session_start();
session_unset(); // Minden session változó törlése
session_destroy(); // A session lezárása

header("Location: ../home.php");
exit();
?>
