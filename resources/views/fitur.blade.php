<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cara Kerja | SIMASET Kabupaten</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Internal -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #ffffff;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,.05);
        }
        /* Hero */
        .hero {
            position: relative;
            background: url('https://upload.wikimedia.org/wikipedia/commons/6/6f/Kantor_Bupati_Tasikmalaya.jpg') center/cover no-repeat;
            min-height: 380px;
            display: flex;
            align-items: center;
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,0.75);
        }

        .hero-content {
            position: relative;
            max-width: 600px;
        }

        .hero h1 {
            font-weight: 800;
            font-size: 38px;
        }

        .hero p {
            color: #555;
        }
        /* HERO SECTION */
.hero-section {
    background-color: #f3f4f6; /* abu-abu lembut */
    padding: 80px 0;
}

.hero-title {
    font-size: 38px;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 20px;
}

.hero-desc {
    font-size: 16px;
    color: #555;
    max-width: 500px;
}

.hero-image {
    max-height: 320px;
    object-fit: cover;
}


        /* Section Title */
        .section-title {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .section-subtitle {
            color: #777;
            margin-bottom: 40px;
        }

        /* Feature Card */
        .feature-card {
            background-color: #fff4e0;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
            height: 100%;
        }

        .feature-icon {
            font-size: 28px;
        }

        .feature-card h6 {
            margin: 0;
            font-weight: 600;
        }

        .feature-card small {
            color: #666;
        }

        /* Role Card */
        .role-card {
            background-color: #fff4e0;
            border-radius: 14px;
            padding: 25px;
            text-align: center;
            height: 100%;
        }

        .role-card h6 {
            font-weight: 700;
            margin-top: 15px;
        }

        /* Footer */
        footer {
            background-color: #0b2c4d;
            color: #fff;
            padding: 40px 0 20px;
        }

        footer small {
            color: #ccc;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.2);
            margin-top: 20px;
            padding-top: 15px;
            font-size: 13px;
            text-align: center;
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
            <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="/fitur">Fitur</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Kategori Aset</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Cara Kerja</a></li>
        </ul>
    </div>
</nav>
<!-- HERO -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">

            <!-- TEXT -->
            <div class="col-md-6">
                <h1 class="hero-title">
                    Cara Kerja Sistem<br>
                    Manajemen Aset Daerah
                </h1>
                <p class="hero-desc">
                    Alur pengelolaan aset daerah mulai dari pendataan,
                    pemberian barcode, hingga pelaporan dan monitoring.
                </p>
            </div>

            <!-- IMAGE -->
            <div class="col-md-6 text-center">
                <img src="{{ asset('storage/images/images.jpeg') }}"
                     class="img-fluid rounded-4 shadow hero-image"
                     alt="Foto Aset">
            </div>

        </div>
    </div>
</section>


<!-- CARA KERJA -->
<section class="py-5">
    <div class="container text-center">
        <h3 class="section-title">Cara Kerja Sistem</h3>
        <p class="section-subtitle">Kelola Jenis Aset dalam satu sistem</p>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon">📂</div>
                    <div>
                        <h6>Manajemen Terpusat</h6>
                        <small>Dataset tersimpan dalam satu database</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon">🔳</div>
                    <div>
                        <h6>Barcode & QR Code</h6>
                        <small>Identifikasi aset secara digital</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <div>
                        <h6>Scan via Smartphone</h6>
                        <small>Akses cepat data aset</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <div>
                        <h6>Laporan Otomatis</h6>
                        <small>Pelaporan real-time</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon">🔐</div>
                    <div>
                        <h6>Hak Akses Pengguna</h6>
                        <small>Kontrol akses sistem</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <div>
                        <h6>Riwayat Pengguna</h6>
                        <small>Audit aktivitas pengguna</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PERAN -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h3 class="section-title mb-5">Peran Pengguna Sistem</h3>

        <div class="row justify-content-center g-4">
            <div class="col-md-3">
                <div class="role-card">
                    <div>🧑‍💼</div>
                    <h6>Admin</h6>
                    <small>Input dan kelola data aset per instansi</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="role-card">
                    <div>👤</div>
                    <h6>User</h6>
                    <small>Melihat dan melaporkan kondisi aset</small>
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
                <strong>PEMERINTAH KABUPATEN TASIKMALAYA</strong>
                <p><small>Sistem Informasi Manajemen Aset Daerah</small></p>
            </div>

            <div class="col-md-4">
                <small>
                    Kontak<br>
                    Jl. Raya Kabupaten No. 10<br>
                    Email: aset@kabupaten.go.id<br>
                    Telp: (0262) 123456
                </small>
            </div>

            <div class="col-md-4">
                <small>
                    Menu<br>
                    Beranda<br>
                    Fitur<br>
                    Cara Kerja<br>
                    Kontak
                </small>
            </div>
        </div>

        <div class="footer-bottom">
            © 2025 Pemerintah Kabupaten Tasikmalaya. Seluruh Hak Dilindungi.
        </div>
    </div>
</footer>

</body>
</html>
