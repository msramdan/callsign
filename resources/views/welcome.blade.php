<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Net Kemerdekaan - RAPI DIY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2e7d32; /* Deep green */
            --secondary-color: #81c784; /* Light green */
            --accent-color: #ffb74d; /* Soft orange for accents */
            --dark-color: #263238; /* Dark blue-gray */
            --light-color: #f5f5f5; /* Light gray */
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
            padding: 20px 0;
            background-image:
                linear-gradient(135deg, rgba(46, 125, 50, 0.05) 0%, rgba(129, 199, 132, 0.05) 100%),
                url('https://images.unsplash.com/photo-1566438480900-0609be27a4be?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1190&q=80');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-blend-mode: overlay;
        }

        .container-box {
            max-width: 1000px;
            margin: 30px auto;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 30px;
            border-top: 8px solid var(--primary-color);
            position: relative;
            backdrop-filter: blur(2px);
        }

        .header-container {
            position: relative;
            margin-bottom: 30px;
            text-align: center;
        }

        .container-box::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background: linear-gradient(135deg, rgba(46, 125, 50, 0.05) 0%, rgba(129, 199, 132, 0.05) 100%);
            z-index: 0;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 30% 100%);
        }

        .header-logo {
            text-align: center;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }

        .header-logo img {
            width: 60%;
            margin-bottom: 15px;
            transition: transform 0.3s;
        }

        .header-logo img:hover {
            transform: scale(1.05);
        }

        .header-banner {
            width: 80%;
            max-width: 700px;
            border-radius: 12px;
            margin: 0 auto 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: block;
            border: 3px solid white;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .header-banner:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .table thead {
            background: linear-gradient(90deg, var(--primary-color), #1b5e20);
            color: white;
            position: sticky;
            top: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table th {
            padding: 12px 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.3s;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .table tbody tr:hover {
            background-color: rgba(129, 199, 132, 0.1);
            transform: scale(1.005);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .search-box {
            position: relative;
            margin-bottom: 25px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .search-box input {
            padding-left: 45px;
            border-radius: 25px;
            border: 2px solid #eee;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            height: 45px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.1);
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.1em;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            text-align: center;
            color: #666;
            font-size: 0.9em;
            position: relative;
            z-index: 1;
        }

        .btn-download {
            background: linear-gradient(135deg, var(--secondary-color), #66bb6a);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.9em;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-download:hover {
            background: linear-gradient(135deg, #66bb6a, #4caf50);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .btn-download i {
            margin-right: 5px;
        }

        .title-section {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 25px;
            text-align: center;
        }

        .title-section h2 {
            font-weight: 700;
            color: var(--primary-color);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.05);
        }

        .title-section::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 4px;
        }

        .empty-state {
            text-align: center;
            padding: 50px 0;
            color: #666;
        }

        .empty-state i {
            font-size: 3.5em;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-state h5 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .header-decoration {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
        }

        .header-decoration::before {
            content: "";
            position: absolute;
            top: -50px;
            left: -50px;
            width: 100px;
            height: 100px;
            background: var(--secondary-color);
            border-radius: 50%;
            opacity: 0.2;
        }

        .header-decoration::after {
            content: "";
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 80px;
            height: 80px;
            background: var(--primary-color);
            border-radius: 50%;
            opacity: 0.2;
        }

        .header-title {
            margin: 20px 0;
            position: relative;
            display: inline-block;
        }

        .header-title h1 {
            font-weight: 700;
            color: var(--primary-color);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
            position: relative;
            display: inline-block;
            padding: 0 20px;
        }

        .header-title h1::before,
        .header-title h1::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .header-title h1::before {
            left: -60px;
        }

        .header-title h1::after {
            right: -60px;
        }

        .header-subtitle {
            font-size: 1.2rem;
            color: var(--dark-color);
            margin-bottom: 20px;
            font-weight: 500;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.8);
        }

        .badge {
            background-color: var(--primary-color);
            font-weight: 500;
            padding: 6px 10px;
            min-width: 80px;
        }

        @media (max-width: 768px) {
            .container-box {
                padding: 20px;
                margin: 15px;
            }

            .header-banner {
                width: 100%;
            }

            .table th,
            .table td {
                padding: 8px 10px;
                font-size: 0.85em;
            }

            .header-title h1 {
                font-size: 1.8rem;
            }

            .header-title h1::before,
            .header-title h1::after {
                width: 30px;
            }

            .header-title h1::before {
                left: -40px;
            }

            .header-title h1::after {
                right: -40px;
            }
        }
    </style>
</head>

<body>
    <div class="container-box">

        <div class="header-container">
            <div class="header-logo">
                <img src="logo.png" alt="Logo RAPI DIY">
            </div>

            <div class="header-title">
                <h1>RADIO ANTAR PENDUDUK INDONESIA</h1>
                <div class="header-subtitle">DAERAH ISTIMEWA YOGYAKARTA</div>
            </div>

            <div class="text-center">
                <img src="banner.jpg" alt="Banner RAPI DIY" class="header-banner">
            </div>
        </div>

        <!-- Search Box -->
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" class="form-control"
                placeholder="Cari berdasarkan callsign, peserta, atau nama event...">
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle" id="data-table" width="100%">
                <thead>
                    <tr>
                        <th><i class="bi bi-broadcast me-1"></i>Callsign</th>
                        <th><i class="bi bi-person me-1"></i>Peserta</th>
                        <th><i class="bi bi-calendar-event me-1"></i>Nama Event</th>
                        <th><i class="bi bi-file-earmark-text me-1"></i>Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge">YB1ABC</span></td>
                        <td>John Doe</td>
                        <td>Net Kemerdekaan RI ke-78</td>
                        <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                    </tr>
                    <tr>
                        <td><span class="badge">YB2DEF</span></td>
                        <td>Jane Smith</td>
                        <td>Net HUT RAPI DIY</td>
                        <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                    </tr>
                    <tr>
                        <td><span class="badge">YB3GHI</span></td>
                        <td>Budi Santoso</td>
                        <td>Net Kemerdekaan RI ke-78</td>
                        <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                    </tr>
                    <tr>
                        <td><span class="badge">YB4JKL</span></td>
                        <td>Ani Wijaya</td>
                        <td>Net Hari Radio Nasional</td>
                        <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="mb-1">Radio Antar Penduduk Indonesia Daerah Istimewa Yogyakarta &copy; 2023</p>
            <p class="text-muted small">Aplikasi pencatatan logbook Event 10.98 | Semangat Merdeka!</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
