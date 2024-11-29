
<?php
include_once 'database.php'; // Adatbázis kapcsolat

// Üzenet inicializálása
$uzenet = ""; // Üres üzenet az elején
$uzenet_szin = ""; // Üzenet színének kezelése

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = $conn->real_escape_string($_POST['nev']);
    $telefonszam = $conn->real_escape_string($_POST['telefonszam']);
    $email = $conn->real_escape_string($_POST['email']);
    $uzenet_szoveg = $conn->real_escape_string($_POST['uzenet']);

    // Adatok beszúrása
    $sql = "INSERT INTO kapcsolat (nev, telefonszam, email, uzenet) VALUES ('$nev', '$telefonszam', '$email', '$uzenet_szoveg')";
    if ($conn->query($sql) === TRUE) {
        $uzenet = "Üzenet sikeresen elküldve!";
        $uzenet_szin = "green"; // Zöld szín
    } else {
        $uzenet = "Hiba történt az üzenet mentésekor: " . $conn->error;
        $uzenet_szin = "red"; // Piros szín
    }
}
?>


<!DOCTYPE html>
<html>
<link href="css/bootstrap.css" rel="stylesheet">

<?php
include_once 'common/head.php';
?>

<body>

    <?php
    include_once 'common/header.php';
    ?>


    <!-- banner section start -->
    <div class="banner_section layout_padding">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                Kérem adja meg a bejelentkezési adatait:
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="banner_img"><img src="images/banner-img.png"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="banner_taital_main">
                                    <h1 class="banner_taital">Művészfilmek</h1>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="banner_img"><img src="images/banner-img2.png"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="banner_taital_main">
                                    <h1 class="banner_taital">"Csókolj meg édes" c. Romantikus film"</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="banner_img"><img src="images/banner-img3.png"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="banner_taital_main">
                                    <h1 class="banner_taital">"Te és Én"
                                         kassza siker film újra a vásznon!"</h1>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner section end -->
    <!-- categroy section start -->
    <div class="categroy_section layout_padding">
        <div class="container">
            <section class="pt-5" id="category">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="categroy_taital">MűvészFilmjeink</h1>
                    </div>
                </div>
                <div class="categroy_section_2">
                    <div id="main_slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="hover01 column">
                                            <figure><img src="images/piri.png"></figure>
                                        </div>
                                        <h3 class="materials_text">Piri és a Kamera (1932)</h3>
                                        <p class="categroy_text">Egy romantikus vígjáték, amely egy fiatal fényképész és egy bájos nő találkozásáról szól. A korai filmkészítés varázsát és a szerelem kialakulását ötvözi egy vidám, lendületes történetben.</p>
 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="hover01 column">
                                            <figure><img src="images/emmy.png"></figure>
                                        </div>
                                        <h3 class="materials_text">Emmy (1934)</h3>
                                        <p class="categroy_text">Egy ambiciózus fiatal nő története, aki Hollywood csillogó világában próbál érvényesülni. Az alkotás a sztárrá válás küzdelmeit és a hírnév árát mutatja be, egyedi látványvilággal.</p>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="hover01 column">
                                            <figure><img src="images/30.png"></figure>
                                        </div>
                                        <h3 class="materials_text">Az Arany Korszak (1930)</h3>
                                        <p class="categroy_text">Egy társasági dráma, amely a szesztilalom idején játszódik, bemutatva a kor extravagáns partijait és a szereplők közötti intrikákat. A film a jazz korszak hangulatát és a titkos bárok világát idézi meg.</p>
    
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="hover01 column">
                                            <figure><img src="images/blog-img1.png"></figure>
                                        </div>
                                        <h3 class="materials_text">Az Ellopott Szerda (1933)</h3>
                                        <p class="categroy_text">Egy misztikus melodráma, amely egy melankolikus fiatal nő történetét meséli el, aki egy rejtélyes bűntény szálait bogozza ki. A film a romantika és a noir elemeit ötvözi, miközben a főszereplő belső küzdelmei és érzelmi vívódásai kerülnek előtérbe. A korszak ikonikus stílusa és szimbolikája végigkíséri a történetet.</p>
                                       
                                    </div>
                                    <div class="col-md-4">
                                        <div class="hover01 column">
                                            <figure><img src="images/blog-img2.png"></figure>
                                        </div>
                                        <h3 class="materials_text">Szerelmi Álmok (1932)</h3>
                                        <p class="categroy_text">Ez a romantikus dráma egy gazdag örökös és egy középosztálybeli fiatal nő találkozásáról szól. A két világ között húzódó társadalmi különbségeket a korszak grandiózus építészeti háttere és az érzelmek színes skálája teszi hitelessé. A film központi kérdése: vajon legyőzheti-e a szerelem az osztálykorlátoka</p>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="hover01 column">
                                            <figure><img src="images/blog-img3.png"></figure>
                                        </div>
                                        <h3 class="materials_text">Repülő Arany (1932)</h3>
                                        <p class="categroy_text">Egy látványos kalandfilm, amely a repülés hőskorát idézi meg. A történet középpontjában egy fiatal pilóta áll, aki egy veszélyes repülős mutatványokkal teli színházi előadás során próbálja megmenteni családja nevét és örökségét. A látványos légi jelenetek és a korabeli építészeti stílus elegánsan ötvöződik ebben a drámában.</p>

                                    </div>
                                </div>
                            </div>
                        <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
        </div>
    </div>
    </section>
    <!-- categroy section end -->
    <!-- market section start -->
    <div class="market_section layout_padding">
        <div class="container">
            <section class="pt-5" id="about">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="market_taital">Rólunk, MűvészetiFilmjeink</h1>
                    </div>
                </div>
                <div class="market_section_2">
                    <h4 class="market_text active">Repülő Arany (1932)<span class="padding10">
                    <p class="dummy_text">Egy látványos kalandfilm, amely a repülés hőskorát idézi meg. A történet középpontjában egy fiatal pilóta áll, aki egy veszélyes repülős mutatványokkal teli színházi előadás során próbálja megmenteni családja nevét és örökségét. A látványos légi jelenetek és a korabeli építészeti stílus elegánsan ötvöződik ebben a drámában.</p>
                    <h4 class="market_text">Szerelmi Álmok (1932)<span class="padding10">
                    <p class="dummy_text">Ez a romantikus dráma egy gazdag örökös és egy középosztálybeli fiatal nő találkozásáról szól. A két világ között húzódó társadalmi különbségeket a korszak grandiózus építészeti háttere és az érzelmek színes skálája teszi hitelessé. A film központi kérdése: vajon legyőzheti-e a szerelem az osztálykorlátokat?</p>
                    <h4 class="market_text">Az Ellopott Szerda (1933)<span class="padding10">
                    <p class="dummy_text">Egy misztikus melodráma, amely egy melankolikus fiatal nő történetét meséli el, aki egy rejtélyes bűntény szálait bogozza ki. A film a romantika és a noir elemeit ötvözi, miközben a főszereplő belső küzdelmei és érzelmi vívódásai kerülnek előtérbe. A korszak ikonikus stílusa és szimbolikája végigkíséri a történetet.</p>
                    <h4 class="market_text">Emmy (1934)<span class="padding10">
                    <p class="dummy_text">Emmy egy ambiciózus nő története, aki Hollywood aranykorában próbál érvényesülni. A film bemutatja a sztárrá válás nehézségeit és a hírnév árát. A lenyűgöző kosztümök és a filmipar korabeli intrikái mellett a történet az önmegvalósítás és a személyes álmok megvalósításának kihívásait tárja elénk.</p>
                </div>
 
            </section>
        </div>
    </div>
    <!-- market section end -->
    <!-- blog section start -->
    <div class="blog_section layout_padding">
        <div class="container">
            <section class="pt-5" id="blog">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="blog_taital">Vetítéseink-Előadásaink</h1>
                    </div>
                </div>
                <div class="blog_section_2">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="blog_img"><img src="images/blog-img1.png"></div>
                            <div class="btn_main">
                                <div class="date_text"><a href="#">06<br>April</a></div>
                            </div>
                            <div class="blog_box">
                                <h3 class="blog_text">Az Ellopott Szerda (1933)</h3>
                                <p class="lorem_text">Mály Gerõ, Zalaegerszeg</p>
                            </div>
 
                        </div>
                        <div class="col-md-4">
                            <div class="blog_img"><img src="images/blog-img2.png"></div>
                            <div class="btn_main">
                                <div class="date_text active"><a href="#">06<br>Majus</a></div>
                            </div>
                            <div class="blog_box">
                                <h3 class="blog_text">Szerelmi Álmok (1932)</h3>
                                <p class="lorem_text">Gertler Viktor, Győr</p> 
                            </div>
 
                        </div>
                        <div class="col-md-4">
                            <div class="blog_img"><img src="images/blog-img3.png"></div>
                            <div class="btn_main">
                                <div class="date_text"><a href="#">06<br>Június</a></div>
                            </div>
                            <div class="blog_box">
                                <h3 class="blog_text">Repülő Arany (1932)</h3>
                                <p class="lorem_text">Salamon Béla, Kaposvár</p> 
 
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- blog section end -->
    <!-- client section start -->
    <div class="client_section layout_padding">
        <div class="container">
            <section class="pt-5" id="review">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="client_taital">Rólunk mondtátok</h1>
                        <p class="client_text"> </p>
                    </div>
                </div>
        </div>
    </div>
    <div class="client_section_2">
        <div class="container">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="customer_main">
                                    <div class="customer_left">
                                        <div class="customer_img"><img src="images/client-img.png"></div>
                                    </div>
                                    <div class="customer_right">
                                        <h3 class="customer_name">Kázmér Elemér</h3>
                                        <p class="enim_text">Hihetelen élmény volt egy ilyen filmet látni, modern vetítésben. Egy élmény, ha lehet na hagyd ki! </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="customer_main">
                                    <div class="customer_left">

                                        <div class="client_img1"><img src="images/client-img1.png"></div>
                                    </div>
                                    <div class="customer_right_1">
                                        <h3 class="customer_name">Gipsz Jakab</h3>
                                        <p class="enim_text">Még gyermekként láttam ezt a filmet anyám régi Tvjén, és most újra éltem gyerekkkorom, Köszönöm az élményt</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
            </section>
        </div>
    </div>
    <!-- client section end -->
    <!-- contact section start -->
    <div class="contact_section layout_padding">
        <div class="container">
            <section class="pt-5" id="contact">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="contact_taital">Lépj Velünk kapcsolatba!</h1>
                        <p class="contact_text">Érdkelődj, Keress minket, ha nem találod Városod az előadásaink között Érdkelődj, Köszönjük</p>
                    </div>
                </div>
                <div class="contact_section_2">
                    <div class="row">
                        <div class="col-md-12 padding15">
                            <form method="POST"> <!-- Az űrlap kezdete -->
                                <div class="mail_section_1">
                                    <input type="text" name="nev" placeholder="Név" required>
                                    <input type="text" name="telefonszam" placeholder="Telefonszám">
                                    <input type="email" name="email" placeholder="Email" required>
                                    <textarea name="uzenet" placeholder="Üzenet" required></textarea>
                                </div>
                                <div class="send_bt">
                                    <button type="submit">Küldés</button>
                                </div>
                            </form> <!-- Az űrlap vége -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
        <div class="map_main">
            <div class="map-responsive">
                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="300" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
    </div>
    <!-- contact section end -->

    <?php
    include_once 'common/footer.php';
    ?>

</body>

</html>