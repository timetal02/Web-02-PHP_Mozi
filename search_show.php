<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mozi_id = $_POST['mozi_id'];
    $datum = $_POST['datum'];

    $sql = "SELECT * FROM eloadas WHERE moziid = $mozi_id AND datum = '$datum'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Előadások</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Film ID</th>
                    <th>Mozi ID</th>
                    <th>Dátum</th>
                    <th>Nézőszám</th>
                    <th>Bevétel</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['filmid']}</td>
                    <td>{$row['moziid']}</td>
                    <td>{$row['datum']}</td>
                    <td>{$row['nezoszam']}</td>
                    <td>{$row['bevetel']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Nincs találat.";
    }
}
$conn->close();
?>
<!-- Űrlap -->
<form method="post">
    Mozi ID: <input type="number" name