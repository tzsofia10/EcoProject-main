<nav class="nav">
    <div class="logo-container">
        <a href="./index.php" >
            <img class="logo" src="./imgs/logo.png">
        </a>
    </div>
    <ul>
        <li><a href="./index.php">Home</a></li>
        <li><a href="./admin/felvitel.php">Energiafogyasztás kalkulátor</a></li>
        <li><a href="./elerhetoseg.php">Elérhetőségek</a></li>
        <li><a href="./jatek/jatek.php">Játék</a></li>
    </ul>
    <div class="login">
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            // Ha be van jelentkezve, akkor kijelentkezés linket mutatunk
            echo '<a href="./bejelentkezes/kijelentkezes.php">Kijelentkezés</a>';
        } else {
            // Ha nincs bejelentkezve, akkor bejelentkezés linket mutatunk
            echo '<a href="./bejelentkezes/bejelentkezes.php">Bejelentkezés</a>';
        }
        ?>
    </div>
</nav>
