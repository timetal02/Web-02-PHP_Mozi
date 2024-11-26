<?php
include 'database.php';

$sql = "SELECT id, cim, ev, hossz FROM film";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Filmek listája</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Cím</th>
                <th>Év</th>
                <th>Hossz (perc)</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['cim']}</td>
                <td>{$row['ev']}</td>
                <td>{$row['hossz']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nincs megjeleníthető film.";
}

$conn->close();
