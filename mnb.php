<!DOCTYPE html>
<html>

<?php
include_once 'common/head.php';
?>

<body>

<?php
include_once 'common/header.php';
?>

<div class="market_section layout_padding">
    <div class="container">
        <h1 class="market_taital">MNB Árfolyamok Lekérdezése</h1>

        <!-- Adott nap árfolyamának lekérdezése -->
        <h2>Adott nap árfolyama</h2>
        <form id="singleDayForm">
            <div class="form-group">
                <label for="currencyDay">Devizapár (pl. EUR/HUF):</label>
                <input type="text" id="currencyDay" name="currencyDay" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="singleDate">Dátum:</label>
                <input type="date" id="singleDate" name="singleDate" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Lekérdezés</button>
        </form>
        <p id="singleDayResult"></p>

        <!-- Egy hónap árfolyamainak lekérdezése -->
        <h2>Egy hónap árfolyamai</h2>
        <form id="monthlyForm">
            <div class="form-group">
                <label for="currencyMonth">Devizapár (pl. EUR/HUF):</label>
                <input type="text" id="currencyMonth" name="currencyMonth" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="monthStartDate">Kezdő dátum:</label>
                <input type="date" id="monthStartDate" name="monthStartDate" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="monthEndDate">Záró dátum:</label>
                <input type="date" id="monthEndDate" name="monthEndDate" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Lekérdezés</button>
        </form>

        <h3>Eredmények</h3>
        <div class="table-responsive mt-4">
            <table class="table table-striped" id="ratesTable">
                <thead>
                    <tr>
                        <th>Dátum</th>
                        <th>Árfolyam</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <canvas id="ratesChart"></canvas>
    </div>
</div>

<?php
include_once 'common/footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Adott nap árfolyamának lekérdezése
    document.getElementById('singleDayForm').addEventListener('submit', async (event) => {
        event.preventDefault();

        const currency = document.getElementById('currencyDay').value;
        const date = document.getElementById('singleDate').value;

        const response = await fetch(`soap_client.php?currency=${currency}&startDate=${date}&endDate=${date}`);
        const data = await response.json();

        if (data.Day && data.Day[0]) {
            document.getElementById('singleDayResult').textContent =
                `${date} napi árfolyam (${currency}): ${data.Day[0].Rate}`;
        } else {
            document.getElementById('singleDayResult').textContent = "Nincs adat a megadott napra.";
        }
    });

    // Egy hónap árfolyamainak lekérdezése
    document.getElementById('monthlyForm').addEventListener('submit', async (event) => {
        event.preventDefault();

        const currency = document.getElementById('currencyMonth').value;
        const startDate = document.getElementById('monthStartDate').value;
        const endDate = document.getElementById('monthEndDate').value;

        const response = await fetch(`soap_client.php?currency=${currency}&startDate=${startDate}&endDate=${endDate}`);
        const data = await response.json();

        const tableBody = document.querySelector("#ratesTable tbody");
        tableBody.innerHTML = "";

        const labels = [];
        const rates = [];

        if (data.Day) {
            data.Day.forEach(day => {
                const row = `<tr>
                    <td>${day['@attributes']['date']}</td>
                    <td>${day.Rate}</td>
                </tr>`;
                tableBody.innerHTML += row;

                labels.push(day['@attributes']['date']);
                rates.push(parseFloat(day.Rate));
            });
        } else {
            tableBody.innerHTML = "<tr><td colspan='2'>Nincs adat</td></tr>";
        }

        const ctx = document.getElementById('ratesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: `Árfolyam (${currency})`,
                    data: rates,
                    borderWidth: 1
                }]
            }
        });
    });
</script>

</body>

</html>
