<?php
$url = "http://localhost/restful_api.php";
$result = "";
if (isset($_POST['id'])) {
  // felesleges karakterek eldobása
  $_POST['id'] = trim($_POST['id']);
  $_POST['cim'] = trim($_POST['cim']);
  $_POST['ev'] = trim($_POST['ev']);
  $_POST['hossz'] = trim($_POST['hossz']);


  if ($_POST['id'] == "" && $_POST['cim'] != "" && $_POST['ev'] != "" && $_POST['hossz'] != "") {
    $data = array("cim" => $_POST["cim"], "ev" => $_POST["ev"], "hossz" => $_POST["hossz"]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
  }

  // adatok ellenőrzése (id)
  elseif ($_POST['id'] == "") {
    $result = "Hiányzó paraméterek!";
  } elseif ($_POST['id'] >= 1 && ($_POST['cim'] != "" || $_POST['ev'] != "" || $_POST['hossz'] != "")) {
    $data = array("id" => $_POST["id"], "cim" => $_POST["cim"], "ev" => $_POST["ev"], "hossz" => $_POST["hossz"]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
  } elseif ($_POST['id'] >= 1) {
    $data = array("id" => $_POST["id"]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
  }

  // a megadott id ellenőrzése
  else {
    echo "Nem megfelelő azonosító (ID): " . $_POST['id'] . "<br>";
  }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);

?>

<!-- Felhasználói bejelentkezési felület kialakítása -->

<!DOCTYPE html>
<html>

<?php
include_once 'common/head.php';
?>


<body>
  <?= $result ?>
  <h1>Művészfilmek:</h1>
  <?= $tabla ?>
  <br>
  <h2>Filmek listájának kezelése:</h2>

  <form>
    <button type="submit" href="index.php" class="btn btn-success">Ugrás a vetítések listájára</button>
  </form>

  <form method="post">
    <h3>Film törlése:</h3>
    ID: <input type="text" name="id"><input type="hidden" name="cim"><input type="hidden" name="ev"><input type="hidden" name="hossz"><input type="submit" value="Törlés"><br><br>
  </form>
  <form method="post">
    <h3>Új film hozzáadása:</h3>
    <input type="hidden" name="id">Film cím: <input type="text" name="cim" maxlength="50">Megjelenés éve: <input type="text" name="ev" maxlength="10">Időtartam: <input type="text" name="hossz" maxlength="10"><input type="submit" value="Hozzáadás"><br><br>
  </form>
  <form method="post">
    <h3>Film módosítása:</h3>
    ID: <input type="text" name="id">Film cím: <input type="text" name="cim" maxlength="50">Megjelenés éve: <input type="text" name="ev" maxlength="10">Időtartam: <input type="text" name="hossz" maxlength="10"><input type="submit" value="Módosítás"><br><br>
  </form>
  <h3>Kérjük figyelmesen töltse ki a szükséges paramétereket és ügyeljen az adatok pontos megadására!</h3>
</body>

<?php
include_once 'common/footer.php';
?>

</html>