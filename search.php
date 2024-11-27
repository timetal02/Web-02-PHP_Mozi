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
                    <h1 class="market_taital">Keresett valami</h1>
                </div>
            </div>
            <div class="market_section_2">



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
                mozi_id <input type="number" name

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