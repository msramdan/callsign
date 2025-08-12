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
            --primary-color: #e30613;
            --secondary-color: #f8d64e;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
            padding: 20px 0;
            background-image:
                linear-gradient(135deg, rgba(227, 6, 19, 0.05) 0%, rgba(248, 214, 78, 0.05) 100%),
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            padding: 30px;
            border-top: 8px solid var(--primary-color);
            position: relative;
            backdrop-filter: blur(2px);
        }

        .container-box::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background: linear-gradient(135deg, rgba(227, 6, 19, 0.05) 0%, rgba(248, 214, 78, 0.05) 100%);
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
            width: 70%;
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            display: block;
            border: 3px solid white;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .header-banner:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .table thead {
            background: linear-gradient(90deg, var(--primary-color), #c00511);
            color: white;
            position: sticky;
            top: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            background-color: #ffeaea;
            transform: scale(1.005);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            height: 45px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(227, 6, 19, 0.1);
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
            background: linear-gradient(135deg, var(--secondary-color), #f0c926);
            color: var(--dark-color);
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.9em;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-download:hover {
            background: linear-gradient(135deg, #f0c926, #e8c63d);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            color: #000;
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
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
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

        @media (max-width: 768px) {
            .container-box {
                padding: 20px;
                margin: 15px;
            }

            .header-banner {
                width: 100%;
            }

            .table th, .table td {
                padding: 8px 10px;
                font-size: 0.85em;
            }
        }
    </style>
</head>

<body>
    <div class="container-box">
        <!-- Header dengan Logo -->
        <div class="header-logo">
            <img src="logo.png" alt="Logo RAPI DIY">
        </div>

        <!-- Header dengan Banner -->
        <div class="text-center">
            <img src="banner.jpg" alt="Banner RAPI DIY" class="header-banner">
        </div>

        <!-- Search Box -->
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan callsign, peserta, atau nama event...">
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
                        <td><span class="badge bg-danger">YB1ABC</span></td>
                        <td>John Doe</td>
                        <td>Net Kemerdekaan RI ke-78</td>
                        <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-danger">YB2DEF</span></td>
                        <td>Jane Smith</td>
                        <td>Net HUT RAPI DIY</td>
                        <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-danger">YB3GHI</span></td>
                        <td>Budi Santoso</td>
                        <td>Net Kemerdekaan RI ke-78</td>
                        <td><button class="btn-download"><i class="bi bi-download"></i> Unduh</button></td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-danger">YB4JKL</span></td>
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
