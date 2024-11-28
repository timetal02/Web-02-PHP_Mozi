<?php
session_start();
include_once 'database.php'; // Adatbázis kapcsolat
?>

<link href="bootstrap.css" rel="stylesheet">
<link href="custom.css" rel="stylesheet">

<!DOCTYPE html>
<html lang="hu">
<head>
    <?php include_once 'common/head.php'; ?> <!-- Fejléc -->
</head>
<body>
    <?php include_once 'common/header.php'; ?> <!-- Fejléc -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Előadások listája</h1>
                <p class="text-center">Tekintse meg az aktuális előadásainkat!</p>
            </div>
        </div>

        <!-- Keresőmező -->
        <div class="row mb-4">
            <div class="col-md-12">
                <form method="GET" class="form-inline d-flex justify-content-center">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Keresés dátum vagy mozi alapján">
                    <button type="submit" class="btn btn-primary">Keresés</button>
                </form>
            </div>
        </div>

        <div class="row">
            <?php
            // Keresési feltétel kezelése
            $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
            $sql = "SELECT eloadas.filmid, mozi.nev AS mozi_nev, eloadas.datum, eloadas.nezoszam, eloadas.bevetel 
                    FROM eloadas 
                    JOIN mozi ON eloadas.moziid = mozi.id";

            if (!empty($search)) {
                $sql .= " WHERE eloadas.datum LIKE '%$search%' OR mozi.nev LIKE '%$search%'";
            }

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Film ID: <?php echo htmlspecialchars($row['filmid']); ?></h5>
                            <p><strong>Mozi:</strong> <?php echo htmlspecialchars($row['mozi_nev']); ?></p>
                            <p><strong>Dátum:</strong> <?php echo htmlspecialchars($row['datum']); ?></p>
                            <p><strong>Nézőszám:</strong> <?php echo htmlspecialchars($row['nezoszam']); ?></p>
                            <p><strong>Bevétel:</strong> <?php echo htmlspecialchars($row['bevetel']); ?> Ft</p>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
            else:
            ?>
                <div class="col-md-12">
                    <p class="text-center">Jelenleg nincs elérhető előadás.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include_once 'common/footer.php'; ?> <!-- Lábjegyzet -->

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
