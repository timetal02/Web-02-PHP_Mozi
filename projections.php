<!DOCTYPE html>
<html>

<?php
include_once 'common/head.php';

?>

<body>

   <?php
   include_once 'common/header.php';
   ?>

   <!-- market section start -->
   <div class="market_section layout_padding">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h1 class="market_taital">Adatbázis kilistázása: </h1>
            </div>
         </div>
         <div class="market_section_2">



            <?php
            include 'database.php';

            $sql = "SELECT * FROM eloadas INNER JOIN film ON eloadas.filmid = film.id INNER JOIN mozi ON eloadas.moziid = mozi.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
               echo "<h2>Legfrisseb műsorok: </h2>";
               echo "<table border='1'>
            <tr>
                <th>Cím</th>
                <th>Megjelenés</th>
                <th>Időtartam</th>
                <th>Bevétel</th>
                <th>Foglalás</th>
                <th>Vetítés</th>
                <th>Mozi</th>
                <th>Bevétel</th>
                <th>Város</th>
                <th>Férőhely</th>
            </tr>";
               while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                <td>{$row['cim']}</td>
                <td>{$row['ev']}</td>
                <td>{$row['hossz']}</td>
                <td>{$row['bevetel']}</td>
                <td>{$row['nezoszam']}</td>
                <td>{$row['datum']}</td>
                <td>{$row['nev']}</td>
                <td>{$row['bevetel']}</td>
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




         </div>
         <div class="seemore_bt"><a href="#">Read More</a></div>
      </div>
   </div>
   <!-- market section end -->

   <?php
   include_once 'common/footer.php';
   ?>

</body>

</html>