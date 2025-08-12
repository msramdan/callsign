<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Net Kemerdekaan - RAPI DIY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1a4d2e;
            /* Deep forest green */
            --secondary-color: #4f9d69;
            /* Vibrant green */
            --accent-color: #ff9f29;
            /* Golden orange */
            --dark-color: #1e1e1e;
            /* Dark gray */
            --light-color: #f8f9fa;
            /* Light gray */
            --gradient-start: #1a4d2e;
            --gradient-end: #4f9d69;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
            padding: 0;
            margin: 0;
            background-image:
                radial-gradient(circle at 10% 20%, rgba(26, 77, 46, 0.05) 0%, rgba(26, 77, 46, 0.05) 90%),
                linear-gradient(135deg, #f5f7fa 0%, #f0f4f8 100%);
            min-height: 100vh;
        }

        .container-box {
            max-width: 1200px;
            margin: 40px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            padding: 0;
            position: relative;
            z-index: 1;
            border: none;
        }

        .container-box::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            z-index: 0;
            clip-path: polygon(0 0, 100% 0, 100% 70%, 0 100%);
        }

        .header-container {
            position: relative;
            padding: 40px 40px 0;
            margin-bottom: 30px;
            text-align: center;
            color: white;
        }

        .header-logo {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .header-logo img {
            height: 100px;
            margin-bottom: 15px;
            transition: transform 0.3s;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
        }

        .header-logo:hover {
            transform: translateY(-5px);
        }

        .header-logo img:hover {
            transform: scale(1.05) rotate(-2deg);
        }

        .header-title {
            margin: 20px 0;
            position: relative;
            display: inline-block;
            padding: 15px 30px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header-title h1 {
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin: 0;
            font-size: 2rem;
            letter-spacing: 0.5px;
        }

        .header-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 20px;
            font-weight: 400;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .header-banner {
            width: 100%;
            max-width: 900px;
            border-radius: 15px;
            margin: 0 auto 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            display: block;
            border: 3px solid white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 2;
            transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
        }

        .header-banner:hover {
            transform: perspective(1000px) rotateX(1deg) rotateY(-1deg) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .content-area {
            padding: 0 40px 40px;
            position: relative;
            z-index: 2;
        }

        .search-box {
            position: relative;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            z-index: 3;
        }

        .search-box input {
            padding-left: 50px;
            border-radius: 50px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            height: 50px;
            transition: all 0.3s;
            font-size: 1rem;
            border: 2px solid transparent;
            background: white;
        }

        .search-box input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 15px 30px rgba(79, 157, 105, 0.2);
            outline: none;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.2em;
            z-index: 4;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 30px;
            position: relative;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
            color: white;
            position: sticky;
            top: 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table th {
            padding: 15px 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 0.5px;
            border: none;
            position: relative;
        }

        .table th:not(:last-child)::after {
            content: "";
            position: absolute;
            right: 0;
            top: 15%;
            height: 70%;
            width: 1px;
            background: rgba(255, 255, 255, 0.3);
        }

        .table td {
            padding: 15px 20px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .table tbody tr {
            transition: all 0.3s;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background-color: rgba(79, 157, 105, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .table tbody tr:hover td {
            color: var(--primary-color);
        }

        .badge {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            font-weight: 600;
            padding: 8px 15px;
            min-width: 90px;
            border-radius: 50px;
            box-shadow: 0 4px 8px rgba(26, 77, 46, 0.2);
            letter-spacing: 0.5px;
            display: inline-block;
            color: white;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .btn-download {
            background: linear-gradient(135deg, var(--accent-color), #ff8a00);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9em;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(255, 159, 41, 0.3);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-download:hover {
            background: linear-gradient(135deg, #ff8a00, var(--accent-color));
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 159, 41, 0.4);
            color: white;
        }

        .btn-download i {
            margin-right: 8px;
            font-size: 1.1em;
        }

        .footer {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            text-align: center;
            color: #666;
            font-size: 0.9em;
            position: relative;
            z-index: 1;
        }

        .footer p {
            margin-bottom: 5px;
        }

        .footer .text-muted {
            font-size: 0.8em;
        }

        .floating-decoration {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .floating-decoration .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 159, 41, 0.1);
            animation: float 15s infinite ease-in-out;
        }

        .floating-decoration .circle:nth-child(1) {
            width: 150px;
            height: 150px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-decoration .circle:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 60%;
            left: -5%;
            animation-delay: 2s;
        }

        .floating-decoration .circle:nth-child(3) {
            width: 100px;
            height: 100px;
            top: 30%;
            right: 5%;
            animation-delay: 4s;
        }

        .floating-decoration .circle:nth-child(4) {
            width: 180px;
            height: 180px;
            bottom: 10%;
            right: 10%;
            animation-delay: 6s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: particle-float linear infinite;
        }

        @keyframes particle-float {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 1;
            }

            100% {
                transform: translateY(-1000px) translateX(100px);
                opacity: 0;
            }
        }

        .empty-state {
            text-align: center;
            padding: 60px 0;
            color: #666;
            position: relative;
            z-index: 1;
        }

        .empty-state i {
            font-size: 4em;
            color: #e0e0e0;
            margin-bottom: 20px;
            display: inline-block;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .empty-state h5 {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        .empty-state p {
            max-width: 500px;
            margin: 0 auto;
        }

        @media (max-width: 992px) {
            .container-box {
                margin: 20px;
                border-radius: 15px;
            }

            .header-container {
                padding: 30px 20px 0;
            }

            .content-area {
                padding: 0 20px 30px;
            }

            .header-title h1 {
                font-size: 1.6rem;
            }

            .header-subtitle {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .header-logo img {
                height: 80px;
            }

            .header-title {
                padding: 10px 20px;
            }

            .header-title h1 {
                font-size: 1.4rem;
            }

            .table th,
            .table td {
                padding: 12px 15px;
            }

            .badge {
                padding: 6px 12px;
                min-width: 80px;
            }
        }

        @media (max-width: 576px) {
            .container-box {
                margin: 10px;
                border-radius: 10px;
            }

            .header-container {
                padding: 20px 15px 0;
            }

            .content-area {
                padding: 0 15px 20px;
            }

            .header-title h1 {
                font-size: 1.2rem;
            }

            .header-subtitle {
                font-size: 0.9rem;
            }

            .table th,
            .table td {
                padding: 10px 12px;
                font-size: 0.85rem;
            }

            .btn-download {
                padding: 6px 15px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-box">
        <!-- Floating decorations -->
        <div class="floating-decoration">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>

        <!-- Particles animation -->
        <div class="particles" id="particles-js"></div>

        <div class="header-container">
            <div class="header-logo">
                <img src="logo.png" alt="Logo RAPI DIY">
            </div>

            <div class="text-center">
                <img src="banner.jpg" alt="Banner RAPI DIY" class="header-banner">
                <h3 class="mt-3"
                    style="color: var(--primary-color); font-weight: 700; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    LOGBOOK RAPIDA 12 DIY
                </h3>
            </div>
        </div>

        <div class="content-area">
            <!-- Search Box -->
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" class="form-control"
                    placeholder="Cari berdasarkan callsign, peserta, atau nama event...">
            </div>

            <!-- Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle" id="data-table" width="100%">
                        <thead>
                            <tr>
                                <th><i class="bi bi-broadcast me-2"></i>Callsign</th>
                                <th><i class="bi bi-person me-2"></i>Peserta</th>
                                <th><i class="bi bi-calendar-event me-2"></i>Nama Event</th>
                                <th><i class="bi bi-file-earmark-text me-2"></i>Sertifikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge">YB1ABC</span></td>
                                <td><strong>John Doe</strong></td>
                                <td>Net Kemerdekaan RI ke-78</td>
                                <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                            </tr>
                            <tr>
                                <td><span class="badge">YB2DEF</span></td>
                                <td><strong>Jane Smith</strong></td>
                                <td>Net HUT RAPI DIY</td>
                                <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                            </tr>
                            <tr>
                                <td><span class="badge">YB3GHI</span></td>
                                <td><strong>Budi Santoso</strong></td>
                                <td>Net Kemerdekaan RI ke-78</td>
                                <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                            </tr>
                            <tr>
                                <td><span class="badge">YB4JKL</span></td>
                                <td><strong>Ani Wijaya</strong></td>
                                <td>Net Hari Radio Nasional</td>
                                <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                            </tr>
                            <tr>
                                <td><span class="badge">YB5MNO</span></td>
                                <td><strong>Rudi Hermawan</strong></td>
                                <td>Net Kemerdekaan RI ke-78</td>
                                <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                            </tr>
                            <tr>
                                <td><span class="badge">YB6PQR</span></td>
                                <td><strong>Siti Rahayu</strong></td>
                                <td>Net HUT RAPI DIY</td>
                                <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p class="mb-1"><strong>Radio Antar Penduduk Indonesia Daerah Istimewa Yogyakarta</strong> &copy; 2025
                </p>
                <p class="text-muted small">Aplikasi pencatatan logbook Event 10.98 | Semangat Merdeka!</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Create floating particles
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.getElementById('particles-js');
            const particleCount = 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random size between 1px and 3px
                const size = Math.random() * 2 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;

                // Random position
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.bottom = `-${size}px`;

                // Random animation duration between 10s and 20s
                const duration = Math.random() * 10 + 10;
                particle.style.animationDuration = `${duration}s`;

                // Random delay
                particle.style.animationDelay = `${Math.random() * 10}s`;

                particlesContainer.appendChild(particle);
            }

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('#data-table tbody tr');

            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();

                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>
