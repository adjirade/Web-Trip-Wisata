<?php
include 'db_config.php';

// Nilai Tukar Mata Uang
$exchange_rate = 16197.66;

$stmt = $pdo->query('SELECT * FROM trips');
$trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Pesan Sukses
$successMessage = '';
if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $successMessage = "Pesanan Anda Sukses!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        
        body {
            background-image: url('./images/background.jpg'); /* Ganti dengan path gambar latar belakang */
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Menghindari scroll pada latar belakang */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .main-container {
            position: relative;
            background-color: rgba(255, 255, 255, 0.9); /* Warna latar belakang dengan transparansi */
            padding: 20px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 1200px;
    /* Tambahkan overflow hidden untuk memastikan konten tidak meluber ke luar kontainer */
            overflow: hidden;
        }
        .description {
            display: inline-block;
            max-height: 4.5em; /* Limit 3 baris */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            width: 100%;
            transition: max-height 1s ease; /* Smooth transisi */
        }

        .card-body:hover .description {
            max-height: 20em;
            white-space: normal; /* Text wrapping */
        }
        /* Ukuran Carousel */
        #carouselExampleAutoplaying {
            max-width: 80%; /* Atur lebar maksimum carousel */
            margin: auto; /* Pusatkan carousel */
        }

        #carouselExampleAutoplaying .carousel-inner img {
            width: 100%; /* Pastikan gambar memenuhi lebar carousel */
            height: auto; /* Jaga rasio aspek gambar */
        }

        /* Ukuran Gambar Carousel */
        .carousel-item img {
            max-height: 400px; /* Atur tinggi maksimum gambar */
            object-fit: cover; /* Jaga gambar tetap proporsional */
        }
    
    </style>
</head>
<body>
    <div class="main-container mt-5">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./images/logo_fix.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                Tera Travel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">List Perjalanan</h1>
        
        <?php if ($successMessage): ?>
            <div id="successMessage" class="alert alert-success text-center" role="alert">
                <?= htmlspecialchars($successMessage) ?>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <?php foreach ($trips as $trip): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= htmlspecialchars($trip['image_path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($trip['trip_name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($trip['trip_name']) ?></h5>
                            <p class="card-text">
                                <span class="description"><?= htmlspecialchars($trip['description']) ?></span>
                            </p>
                            <p class="card-text">
                                </b>Harga Per-orang: Rp<?= number_format($trip['price_per_person'] * $exchange_rate, 0, ',', '.') ?>
                                </p>
                            <a href="booking.php?trip_id=<?= $trip['id'] ?>" class="btn btn-primary">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bagian untuk Galeri dan Tentang -->
    <div id="gallery" class="container mt-5">
        <h2 class="text-center">Galeri</h2>
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./images/trip1.jpg" class="d-block w-100" alt="LAMPUNG - BALI">
                </div>
                <div class="carousel-item">
                    <img src="./images/trip2.jpg" class="d-block w-100" alt="LAMPUNG - MALAYSIA">
                </div>
                <div class="carousel-item">
                    <img src="./images/trip3.jpg" class="d-block w-100" alt="FULL TRIP PALEMBANG">
                </div>
                <div class="carousel-item">
                    <img src="./images/trip4.jpg" class="d-block w-100" alt="FULL TRIP LAMPUNG">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Selanjutnya</span>
            </button>
        </div>
    </div>

    <div id="about" class="container mt-5">
        <h2 class="text-center">Tentang Kami</h2>
        <p class="text-center">Kami adalah Tera Travel, penyedia layanan perjalanan yang siap membantu Anda menjelajahi destinasi favorit Anda dengan nyaman dan aman. Hubungi kami melalui media sosial:</p>
            <div class="text-center">
                <a href="https://www.instagram.com/adjiraa.a" target="_blank" class="btn btn-outline-dark me-2">
                <i class="fab fa-instagram"></i> Instagram
                </a>
                <a href="https://www.youtube.com/channel/UC7RDJF5ReLzByTU86Z4Sevg" target="_blank" class="btn btn-outline-dark me-2">
                <i class="fab fa-youtube"></i> YouTube
                </a>
        <!-- Tambahkan lebih banyak media sosial jika perlu -->
            </div>
        </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3">
            © 2024 Tera Travel. All Rights Reserved.
        </div>
    </footer>
    </div>
    <script>
        // Fungsi untuk menghilangkan teks dalam waktu 1 menit
        setTimeout(function() {
            const messageElement = document.getElementById('successMessage');
            if (messageElement) {
                messageElement.style.transition = 'opacity 0.5s ease';
                messageElement.style.opacity = '0';
                setTimeout(() => messageElement.remove(), 500);
            }
        }, 60000); // 60000 milisekon
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
