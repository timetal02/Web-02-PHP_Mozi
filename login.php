<?php
session_start();
include_once 'database.php';
include_once 'login.php';

$welcome_message = "";

// Sikeres bejelentkezés megerősítése
if (isset($_SESSION['felh_ID'])) {
    $welcome_message = "Ön sikeresen bejelentkezett, " . htmlspecialchars($_SESSION['felh_nev']) . "!";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['felh_nev'];
    $password = $_POST['jelszo'];

    $query = "SELECT felh_ID, felh_nev, jelszo, jogosultsag FROM felhasznalok WHERE felh_nev = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['jelszo'])) {
            $_SESSION['felh_ID'] = $user['felh_ID'];
            $_SESSION['felh_nev'] = $user['felh_nev'];
            $_SESSION['jogosultsag'] = $user['jogosultsag'];

            header("Location: index.php");
            exit();
        } else {
            $error = "Sikertelen bejelentkezés, hibás jelszó!";
        }
    } else {
        $error = "Sikertelen bejelentkezés, hibás felhasználónév!";
    }
}
?>


<!-- Felhasználói bejelentkezési felület kialakítása -->

<!DOCTYPE html>
<html>

<?php
include_once 'common/head.php';
?>

<body class="starter-page-page">

    <?php
    include_once 'common/header.php';
    ?>

    <main class="main">

        <div class="container">
            <h1>Kérem adja meg a bejelentkezési adatait: </h1>
        </div>


        <section id="starter-section" class="starter-section section">
            <div class="container" data-aos="fade-up">
                <?php if (!empty($welcome_message)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $welcome_message; ?>
                    </div>
                <?php elseif (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <?php if (empty($welcome_message)): ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="felh_nev" class="form-label">Felhasználónév</label>
                            <input type="text" class="form-control" id="felh_nev" name="felh_nev" required>
                        </div>
                        <div class="mb-3">
                            <label for="jelszo" class="form-label">Jelszó</label>
                            <input type="jelszo" class="form-control" id="jelszo" name="jelszo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Bejelentkezés</button>
                    </form>

                    <p class="mt-3">Nem regisztrált felhasználó? <a href="registration.php">Regisztráljon most</a>.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php
    include_once 'common/footer.php';
    ?>

</body>

</html>