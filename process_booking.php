<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $trip_id = $_POST['trip_id'];
    $trip_date = $_POST['trip_date'];
    $num_people = $_POST['num_people'];
    $hotel_service = in_array('hotel', $_POST['services']) ? 1 : 0;
    $transport_service = in_array('transport', $_POST['services']) ? 1 : 0;

    // Calculate total price
    $stmt = $pdo->prepare('SELECT price_per_person FROM trips WHERE id = ?');
    $stmt->execute([$trip_id]);
    $trip = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$trip) {
        die("Error: Trip not found.");
    }

    $total_price = $trip['price_per_person'] * $num_people;

    if ($hotel_service) {
        $total_price += 500000 * $num_people;
    }
    if ($transport_service) {
        $total_price += 300000 * $num_people;
    }

    // Memasukkan ke database
    try {
        $stmt = $pdo->prepare('INSERT INTO bookings (name, phone, trip_id, trip_date, num_people, hotel_service, transport_service, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$name, $phone, $trip_id, $trip_date, $num_people, $hotel_service, $transport_service, $total_price]);

        // kembali ke index.php
        header('Location: index.php?status=success');
        exit;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    die("Invalid request.");
}

