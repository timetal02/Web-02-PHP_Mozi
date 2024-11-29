<?php
$wsdl = "https://www.mnb.hu/arfolyamok.asmx?WSDL";

function getExchangeRates($startDate, $endDate, $currency) {
    try {
        // Debug: kiírjuk a beérkezett paramétereket
        error_log("SOAP paraméterek: startDate=$startDate, endDate=$endDate, currency=$currency");

        // SOAP kliens inicializálása
        $client = new SoapClient($GLOBALS['wsdl']);
        error_log("SOAP kliens inicializálva.");

        // SOAP kérés küldése
        $response = $client->GetExchangeRates([
            "startDate" => $startDate,
            "endDate" => $endDate,
            "currencyNames" => $currency
        ]);

        error_log("SOAP válasz sikeresen érkezett.");
        error_log("SOAP válasz tartalma: " . print_r($response, true));

        // Ellenőrizzük, hogy van-e GetExchangeRatesResult
        if (!isset($response->GetExchangeRatesResult)) {
            error_log("Hiba: Nem található GetExchangeRatesResult a válaszban.");
            return ["error" => "Nincs érvényes válasz a SOAP API-tól."];
        }

        // Válasz feldolgozása XML-ből JSON-re
        $xml = simplexml_load_string($response->GetExchangeRatesResult);
        if ($xml === false) {
            error_log("XML feldolgozási hiba: " . print_r(libxml_get_errors(), true));
            return ["error" => "Nem sikerült az XML feldolgozása."];
        }

        // JSON konverzió és hiányzó Rate mezők pótlása
        $data = json_decode(json_encode($xml), true);
        foreach ($data['Day'] as &$day) {
            if (!isset($day['Rate'])) {
                $day['Rate'] = "Nincs árfolyam"; // Hiányzó árfolyam jelzése
            }
        }

        error_log("Feldolgozott adatok: " . print_r($data, true));
        return $data;
    } catch (Exception $e) {
        error_log("SOAP Hiba: " . $e->getMessage());
        return ["error" => "SOAP Error: " . $e->getMessage()];
    }
}

// Fő logika
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    error_log("Kapott GET paraméterek: " . print_r($_GET, true));

    if (empty($_GET["currency"]) || empty($_GET["startDate"]) || empty($_GET["endDate"])) {
        echo json_encode(["error" => "A kezdő dátum, záró dátum és devizapár megadása kötelező"]);
        exit;
    }

    $currency = strtoupper($_GET["currency"]);
    $startDate = $_GET["startDate"];
    $endDate = $_GET["endDate"];

    // Árfolyamok lekérdezése
    $rates = getExchangeRates($startDate, $endDate, $currency);

    header("Content-Type: application/json");
    echo json_encode($rates);
    exit;
}

echo json_encode(["error" => "Csak GET kérések engedélyezettek"]);
exit;
