<?php
session_start();
include_once 'database.php';

// Adatok bevitele, illetve ellenőrzése

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['felh_nev'];
    $password = $_POST['jelszo'];
    $confirm_password = $_POST['jelszo_megerosites'];
    $terms_accepted = isset($_POST['szabalyzat']);

    if (!$terms_accepted) {
        $error = "Kérjük fogadja el előbb az Általános Szerződési Feltételeket!";
    } elseif ($password !== $confirm_password) {
        $error = "A jelszavak nem egyeznek!";
    } else {
        $query = "SELECT felh_ID FROM felhasznalok WHERE felh_nev = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Ez a felhasználónév már foglalt!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO felhasznalok (felh_nev, jelszo, jogosultsag) VALUES (?, ?, 'regisztrált látogató')";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['felh_ID'] = $conn->insert_id;
                $_SESSION['felh_nev'] = $username;
                $_SESSION['jogosultsag'] = 'regisztrált látogató';

                header("Location: index.php");
                exit();
            } else {
                $error = "Hiba történt a regisztráció során. Kérjük próbálkozzon újra!";
            }
        }
    }
}
?>

<!-- Felhasználói regisztrációs felület kialakítása -->

<!DOCTYPE html>
<html>

<?php
include_once 'common/head.php';
?>

<?php
include_once 'common/header.php';
?>

<body class="starter-page-page">
    <main class="main">
        <div class="container">
            <section class="pt-5" id="registration">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="contact_taital">Regisztráció</h1>
                        <p class="contact_text">Kérem adja meg a regisztrációhoz szükséges adatait</p>
                    </div>
                </div>
                <div class="registration_section_2">
                    <div class="row">
                        <div class="col-md-12 padding15">

                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo htmlspecialchars($error); ?>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="">
                                <div class="mail_section_1">
                                    <label for="felh_nev" class="form-label">Felhasználónév</label>
                                    <input type="text" class="form-control" id="felh_nev" name="felh_nev" required>
                                </div>
                                <div class="mail_section_1">
                                    <label for="jelszo" class="form-label">Jelszó</label>
                                    <input type="jelszo" class="form-control" id="jelszo" name="jelszo" required>
                                </div>
                                <div class="mail_section_1">
                                    <label for="jelszo_megerosites" class="form-label">Jelszó megerősítése</label>
                                    <input type="jelszo" class="form-control" id="jelszo_megerosites" name="jelszo_megerosites" required>
                                </div>
                                <div class="mail_section_1">
                                    <input type="checkbox" class="form-check-input" id="szabalyzat" name="szabalyzat" required>
                                    <label for="szabalyzat" class="form-check-label">
                                        Tudomásul veszem az <a href="terms.php" target="_blank">Általános Szerződési Feltételeket</a>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">Regisztráció</button>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php
    include_once 'common/footer.php';
    ?>

</body>

</html>