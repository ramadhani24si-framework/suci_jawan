<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil Pegawai</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background-color: #3187e9;
            color: white;
            padding: 50px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
        }

        .card {
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer {
            margin-top: 50px;
            padding: 20px 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        .footer p {
            margin: 0;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Profil Pegawai</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Lainnya</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-6 mb-2">{{ $name }}</h1>
            <p class="lead mb-0">Profil detail pegawai lengkap dengan data pribadi dan aspirasi.</p>
        </div>
    </section>

    <!-- Content Section -->
    <section id="content" class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Profile Card -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Data Pribadi</h4>

                        <p><strong>Nama:</strong> {{ $name }}</p>
                        <p><strong>Umur:</strong> {{ $my_age }} tahun</p>

                        <p><strong>Hobi:</strong></p>
                        <ul>
                            @foreach ($hobbies as $hobby)
                                <li>{{ $hobby }}</li>
                            @endforeach
                        </ul>

                        <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</p>
                        <p><strong>Sisa Waktu Studi (hari):</strong> {{ $time_to_study_left }}</p>
                        <p><strong>Semester Saat Ini:</strong> {{ $current_semester }}</p>

                        <div class="alert alert-info mt-3">
                            {{ $message }}
                        </div>

                        <p><strong>Cita-cita:</strong> {{ $future_goal }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Profil Pegawai. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
