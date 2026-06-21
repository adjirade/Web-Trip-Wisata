<?php
include 'db_config.php';

// Nilai Tukar Mata Uang
$exchange_rate = 16197.66;

$trip_id = isset($_GET['trip_id']) ? (int) $_GET['trip_id'] : 0;
if ($trip_id > 0) {
    $stmt = $pdo->prepare('SELECT * FROM trips WHERE id = ?');
    $stmt->execute([$trip_id]);
    $trip = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($trip) {
        $price_per_person = $trip['price_per_person'] * $exchange_rate;
    } else {
        // Trip Tidak Ditemukan
        die('Perjalanan Tidak Ditemukan');
    }
} else {
    // Trip Tidak Tersedia
    die('Perjalanan Tidak Tersedia');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Trip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Booking Perjalanan</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
            <form action="process_booking.php" method="POST">
                <input type="hidden" name="trip_id" value="<?= $trip_id ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="trip" class="form-label">Perjalanan</label>
                    <input type="text" class="form-control" id="trip" name="trip" value="<?= htmlspecialchars($trip['trip_name']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="date" name="trip_date" required>
                </div>
                <div class="mb-3">
                    <label for="people" class="form-label">Jumlah Orang</label>
                    <input type="number" class="form-control" id="people" name="num_people" required>
                </div>
                <div class="mb-3">
                    <label for="services" class="form-label">Paket Tambahan</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hotel_service" name="services[]" value="hotel">
                        <label class="form-check-label" for="hotel_service">
                        Hotel (+Rp500,000 per-orang)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="transport_service" name="services[]" value="transport">
                        <label class="form-check-label" for="transport_service">
                        Transportation (+Rp300,000 per-orang)
                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga per-orang</label>
                <input type="text" class="form-control" id="price" value="Rp<?= number_format($price_per_person, 0, ',', '.') ?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Pesan Perjalanan</button>
            </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const pricePerPerson = <?= $price_per_person ?>;
    const hotelCost = 500000;
    const transportCost = 300000;

    const peopleInput = document.getElementById('people');
    const hotelCheckbox = document.getElementById('hotel_service');
    const transportCheckbox = document.getElementById('transport_service');
    const priceInput = document.getElementById('price');

    function calculateTotalPrice() {
        let numPeople = parseInt(peopleInput.value) || 1;
        let totalPrice = pricePerPerson * numPeople;

        if (hotelCheckbox.checked) {
            totalPrice += hotelCost * numPeople;
        }

        if (transportCheckbox.checked) {
            totalPrice += transportCost * numPeople;
        }

        priceInput.value = `Rp${totalPrice.toLocaleString('id-ID')}`;
    }

    peopleInput.addEventListener('input', calculateTotalPrice);
    hotelCheckbox.addEventListener('change', calculateTotalPrice);
    transportCheckbox.addEventListener('change', calculateTotalPrice);

    calculateTotalPrice(); // Kalkulasi Dinamis
});
</script>

</body>
</html>