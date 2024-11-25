<?php
include 'db_connection.php';

$sql = "SELECT id, nev, varos, ferohely FROM Mozi";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Mozik listája</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Név</th>
                <th>Város</th>
                <th>Férőhely</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nev']}</td>
                <td>{$row['varos']}</td>
                <td>{$row['ferohely']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nincs megjeleníthető mozi.";
}

$conn->close();
?>
