<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'database.php'; // Adatbázis kapcsolat

// Menüpontok definiálása
$menu_items = [
    ['name' => 'Főoldal', 'url' => 'index.php'],
    ['name' => 'Rólunk', 'url' => 'index.php#about'],
    ['name' => 'Vetítések', 'url' => 'projections.php'],
    ['name' => 'MNB', 'url' => 'mnb.php'],
    ['name' => 'Kapcsolat', 'url' => 'index.php#contact'],
    ['name' => 'Kategóriák', 'url' => 'index.php#category'],
    ['name' => 'Blog', 'url' => 'index.php#blog'],
    ['name' => 'Értékelések', 'url' => 'index.php#review'],
];


$query = "SELECT * FROM menu WHERE name = ? AND url = ?";
$stmt = $conn->prepare($query);

// Hibaellenőrzés
if (!$stmt) {
    die("SQL előkészítési hiba: " . $conn->error);
}

$stmt->bind_param("ss", $item['name'], $item['url']);


// Frissítés az adatbázisban
foreach ($menu_items as $item) {
    $query = "SELECT * FROM menu WHERE name = ? AND url = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $item['name'], $item['url']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Ha nincs ilyen menüpont, hozzáadjuk az adatbázishoz
        $insert_query = "INSERT INTO menu (name, url) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ss", $item['name'], $item['url']);
        $insert_stmt->execute();
    }
}
?>



<header id="header" class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">




            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand" href="index.php"><img src="images/logo.png"></a>
                <ul class="navbar-nav ml-auto">
                    <?php
                    // Az adatbázisban tárolt menüpontok betöltése
                    $query = "SELECT name, url FROM menu ORDER BY id ASC";
                    $result = $conn->query($query);

                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="nav-item"><a class="nav-link" href="' . htmlspecialchars($row['url']) . '">' . htmlspecialchars($row['name']) . '</a></li>';
                    }

                    // Admin menüpont dinamikus hozzáadása
                    if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
                        echo '<li class="nav-item"><a  class="nav-link" href="admin.php">Admin</a></li>';
                    }
                    ?>
                </ul>
                <form class="form-inline my-2 my-lg-0"></form>
            </div>
        </nav>



        <!-- Dinamikus bejelentkezés állapot kijelzése -->
        <div class="user-status" style="display: flex; flex-direction: column; align-items: flex-end;">
            <?php if (isset($_SESSION['felh_ID'])): ?>
                <p class="welcome-message" style="color: #fff; margin: 0 0 5px 0; text-align: right;">Üdvözöljük, <strong><?php echo htmlspecialchars($_SESSION['felh_nev']); ?></strong></p>
                <a class="btn-getstarted" href="logout.php" style="text-align: right;">Kijelentkezés</a>
            <?php else: ?>
                <a class="btn-getstarted" href="login.php">Bejelentkezés</a>
            <?php endif; ?>
        </div>
    </div>
</header>