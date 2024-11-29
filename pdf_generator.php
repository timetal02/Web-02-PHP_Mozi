<?php
// Töröld a bufferben lévő esetleges kimenetet
if (ob_get_length()) {
    ob_end_clean();
}

session_start();
include_once 'database.php'; // Adatbázis kapcsolat
require_once 'libs/tcpdf/tcpdf.php'; // TCPDF osztály betöltése

ob_start(); // Kezdd el újra a bufferelést

// Adatok fogadása
$search = isset($_POST['search']) ? $_POST['search'] : '';
$sql = "SELECT eloadas.filmid, mozi.nev AS mozi_nev, eloadas.datum, eloadas.nezoszam, eloadas.bevetel 
        FROM eloadas 
        JOIN mozi ON eloadas.moziid = mozi.id";

if (!empty($search)) {
    $sql .= " WHERE eloadas.datum LIKE '%$search%' OR mozi.nev LIKE '%$search%'";
}

$result = $conn->query($sql);
$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Ha nincs adat
if (empty($data)) {
    $data = [
        ['filmid' => '-', 'mozi_nev' => 'Nincs adat', 'datum' => '-', 'nezoszam' => '-', 'bevetel' => '-']
    ];
}

// Új PDF dokumentum
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Projekt Neve');
$pdf->SetTitle('Előadások PDF');

// Fejléc beállítása
$pdf->SetHeaderData('', 0, 'Előadások PDF', 'Generált PDF', [0,0,0], [0,0,0]); // Színek: fekete
$pdf->setHeaderFont(['dejavusans', '', 12]); // Unicode betűtípus a fejléc számára

// Lábjegyzet betűtípus (opcionális)
$pdf->setFooterFont(['dejavusans', '', 10]);

// Oldal beállítások
$pdf->SetFont('dejavusans', '', 12); // Unicode betűtípus a tartalomhoz
$pdf->AddPage(); // Csak egyszer adjuk hozzá az oldalt

// PDF tartalom
$html = '<h1>Előadások listája</h1>';
$html .= '<table border="1" cellpadding="5">
            <tr>
                <th>Film ID</th>
                <th>Mozi</th>
                <th>Dátum</th>
                <th>Nézőszám</th>
                <th>Bevétel (Ft)</th>
            </tr>';

foreach ($data as $row) {
    $html .= '<tr>
                <td>' . htmlspecialchars($row['filmid']) . '</td>
                <td>' . htmlspecialchars($row['mozi_nev']) . '</td>
                <td>' . htmlspecialchars($row['datum']) . '</td>
                <td>' . htmlspecialchars($row['nezoszam']) . '</td>
                <td>' . htmlspecialchars($row['bevetel']) . '</td>
              </tr>';
}

$html .= '</table>';

// PDF tartalom hozzáadása
$pdf->writeHTML($html);

// Buffer törlése és PDF generálás
ob_end_clean(); // Buffert töröljük
$pdf->Output('eloadasok.pdf', 'D'); // 'D': letöltés
exit();
