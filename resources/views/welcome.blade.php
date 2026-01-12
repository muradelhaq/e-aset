<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIMASET Kabupaten</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #ffffff;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,.05);
        }

        .hero {
            padding: 80px 0;
        }

        .hero-title {
            font-size: 38px;
            font-weight: 700;
        }

        .hero-desc {
            color: #6c757d;
            margin-top: 15px;
        }
        .hero {
    background-color: #f1f3f5; /* abu-abu muda */
    padding: 50px 0;
}


        .btn-orange {
            background-color: #f59e0b;
            color: #fff;
            border-radius: 8px;
            padding: 10px 22px;
        }

        .btn-orange:hover {
            background-color: #d97706;
            color: #fff;
        }

        .category-card {
            border-radius: 14px;
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,.08);
            overflow: hidden;
        }

        .category-header {
            background-color: #0f2942;
            color: #fff;
            padding: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .progress-custom {
            height: 10px;
            border-radius: 20px;
        }

        footer {
            background-color: #0f2942;
            color: #fff;
            padding: 40px 0;
            margin-top: 80px;
        }

        footer a {
            color: #d1d5db;
            text-decoration: none;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="#">
    <img src="{{ asset('storage/images/logo.png') }}"
         alt="Logo"
         height="40">
    SIMASET KABUPATEN
</a>


        <ul class="navbar-nav ms-auto gap-3">
            <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="/fitur">Fitur</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Kategori Aset</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Cara Kerja</a></li>
        </ul>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title">
                    Kelola Aset Kabupaten<br>
                    Secara Digital & Terintegrasi
                </h1>
                <p class="hero-desc">
                    Sistem manajemen aset daerah untuk mendata, memantau,
                    dan melaporkan aset milik pemerintah kabupaten secara
                    transparan dan akurat.
                </p>
                <a href="/admin" class="btn btn-orange mt-3">Masuk Sistem</a>
            </div>

           <div class="col-md-6 text-center">
    <img src="{{ asset('storage/images/images.jpeg') }}"
         class="img-fluid rounded-4 shadow"
         alt="Foto Aset">
</div>


        </div>
    </div>
</section>

<!-- KATEGORI ASET -->
<section class="container">
    <h3 class="text-center fw-bold mb-2">Kategori Aset</h3>
    <p class="text-center text-muted mb-5">Kelola berbagai jenis aset milik daerah</p>

    <div class="row g-4">
        <!-- Card -->
        <div class="col-md-3">
            <div class="card category-card">
                <div class="category-header">
                    🏢 Bangunan Pemerintah
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        Kelola data gedung kantor dan fasilitas pemerintah
                    </p>
                    <div class="progress progress-custom">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card category-card">
                <div class="category-header">
                    🚗 Kendaraan Dinas
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        Kelola data kendaraan operasional pemerintah
                    </p>
                    <div class="progress progress-custom">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card category-card">
                <div class="category-header">
                    💻 Barang Elektronik
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        Kelola aset kabupaten tasikmalaya elektronik & non elektronik
                    </p>
                    <div class="progress progress-custom">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card category-card">
                <div class="category-header">
                    🌍 Tanah
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        Kelola data aset tanah milik daerah Kabupaten tasikmalaya
                    </p>
                    <div class="progress progress-custom">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h6 class="fw-bold">PEMERINTAH KABUPATEN TASIKMALAYA</h6>
                <p class="small">Sistem Informasi Manajemen Aset Daerah</p>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold">Kontak</h6>
                <p class="small mb-1">Jl. Raya Kabupaten No.10</p>
                <p class="small mb-1">Email: aset@kabupaten.go.id</p>
                <p class="small">Telp: (0262) 123456</p>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold">Menu</h6>
                <ul class="list-unstyled small">
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Fitur</a></li>
                    <li><a href="#">Cara Kerja</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
        </div>

        <hr class="border-secondary">

        <p class="text-center small mb-0">
            © 2025 Pemerintah Kabupaten Tasikmalaya. Seluruh Hak Dilindungi.
        </p>
    </div>
</footer>

</body>
</html>
