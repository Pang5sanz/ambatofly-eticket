<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin - E-Ticket LSP RPL</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #3ad0c3 0%, #b6e1ff 50%, #ffd1c1 100%);
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(58, 208, 195, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(182, 225, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 209, 193, 0.1) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(10px) rotate(-1deg); }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideInFromTop 0.8s ease-out;
        }

        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }

        .hero-text {
            flex: 1;
            min-width: 300px;
        }

        .hero-text h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-text p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .hero-image {
            flex: 1;
            min-width: 300px;
            text-align: center;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        /* Stats Cards */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out;
            animation-fill-mode: both;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 1rem;
            color: #666;
            font-weight: 500;
        }

        /* Schedules Section */
        .schedules-section {
            margin-bottom: 40px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-header h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 10px;
            position: relative;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            border-radius: 2px;
        }

        .section-header p {
            color: #666;
            font-size: 1.1rem;
        }

        /* Schedule Cards */
        .schedules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .schedule-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out;
            animation-fill-mode: both;
        }

        .schedule-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .schedule-header {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            padding: 20px;
            position: relative;
        }

        .schedule-header::before {
            content: '✈️';
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 1.5rem;
            opacity: 0.8;
        }

        .airline-name {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .route {
            font-size: 1rem;
            opacity: 0.9;
        }

        .schedule-body {
            padding: 20px;
        }

        .schedule-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-icon {
            color: #3ad0c3;
            font-size: 1.2rem;
            width: 20px;
        }

        .detail-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 2px;
        }

        .detail-value {
            font-weight: 600;
            color: #333;
        }

        .price-stock-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #3ad0c3;
        }

        .stock-info {
            background: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-edit {
            background: #4CAF50;
            color: white;
        }

        .btn-edit:hover {
            background: #3e9442;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background: #d32f2f;
            transform: translateY(-2px);
        }

        /* Pagination */
        .pagination-container {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .pagination-container .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 5px;
        }

        .pagination-container .page-link {
            padding: 10px 15px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .pagination-container .page-link:hover {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(58, 208, 195, 0.3);
        }

        .pagination-container .active .page-link {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            border-color: #3ad0c3;
        }

        /* Navigation */
        .nav-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nav-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(58, 208, 195, 0.3);
        }

        .nav-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(58, 208, 195, 0.4);
        }

        .nav-link i {
            font-size: 1rem;
        }

        /* Success Message */
        .alert {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid rgba(40, 167, 69, 0.2);
            animation: slideInFromTop 0.5s ease-out;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .empty-icon {
            font-size: 4rem;
            color: #3ad0c3;
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .empty-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .empty-text {
            color: #666;
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .hero-section {
                padding: 25px;
                margin-bottom: 25px;
            }

            .hero-content {
                flex-direction: column;
                text-align: center;
            }

            .hero-text h1 {
                font-size: 2rem;
            }

            .stats-section {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .schedules-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                flex-direction: column;
                align-items: center;
            }

            .schedule-details {
                grid-template-columns: 1fr;
            }

            .price-stock-section {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .action-buttons {
                flex-direction: column;
            }
        }

        /* Loading Animation */
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        .loading {
            animation: pulse 2s infinite;
        }
    </style>
</head>

<body>

<div class="container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Panel Admin Ambatofly</h1>
                <p>Kelola jadwal penerbangan, pantau transaksi, dan atur sistem e-ticket dengan mudah melalui dashboard modern ini.</p>
            </div>
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=300&fit=crop&crop=center" alt="Admin Dashboard" loading="lazy">
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="nav-section">
        <div class="nav-links">
            <a href="/admin/schedules/create" class="nav-link">
                <i class="fas fa-plus"></i>
                Tambah Jadwal
            </a>
            <a href="/admin/bookings" class="nav-link">
                <i class="fas fa-list"></i>
                Riwayat Transaksi
            </a>
            <a href="{{ route('admin.report') }}" class="nav-link">
                <i class="fas fa-chart-line"></i>
                Report Transaksi
            </a>
            <a href="/logout" class="nav-link">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-plane"></i>
            </div>
            <div class="stat-number">{{ $allSchedules->count() }}</div>
            <div class="stat-label">Total Jadwal</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-route"></i>
            </div>
            <div class="stat-number">{{ $allSchedules->sum('stock') }}</div>
            <div class="stat-label">Total Kursi Tersedia</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-number">Rp {{ number_format($allSchedules->sum('price')) }}</div>
            <div class="stat-label">Total Nilai Jadwal</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <div class="stat-number">{{ $allSchedules->unique('destination')->count() }}</div>
            <div class="stat-label">Destinasi Tersedia</div>
        </div>
    </div>

    <!-- Schedules Section -->
    <div class="schedules-section">
        <div class="section-header">
            <h2>Daftar Jadwal Pesawat</h2>
            <p>Kelola semua jadwal penerbangan yang tersedia</p>
        </div>

        @if($schedules->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-plane-slash"></i>
                </div>
                <h3 class="empty-title">Belum Ada Jadwal</h3>
                <p class="empty-text">Belum ada jadwal penerbangan yang tersedia. Tambahkan jadwal baru untuk memulai.</p>
            </div>
        @else
            <div class="schedules-grid">
                @foreach($schedules as $index => $schedule)
                <div class="schedule-card" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="schedule-header">
                        <div class="airline-name">{{ $schedule->plane_name }}</div>
                        <div class="route">{{ $schedule->origin }} → {{ $schedule->destination }}</div>
                    </div>
                    <div class="schedule-body">
                        <div class="schedule-details">
                            <div class="detail-item">
                                <i class="fas fa-calendar-alt detail-icon"></i>
                                <div>
                                    <div class="detail-label">Keberangkatan</div>
                                    <div class="detail-value">{{ \Carbon\Carbon::parse($schedule->departure)->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-clock detail-icon"></i>
                                <div>
                                    <div class="detail-label">Durasi</div>
                                    <div class="detail-value">± 2 jam</div>
                                </div>
                            </div>
                        </div>

                        <div class="price-stock-section">
                            <div class="price">Rp {{ number_format($schedule->price) }}</div>
                            <div class="stock-info">
                                <i class="fas fa-chair"></i> {{ $schedule->stock }} kursi
                            </div>
                        </div>

                        <div class="action-buttons">
                            <a href="/admin/schedules/edit/{{ $schedule->id }}" class="btn btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="/admin/schedules/delete/{{ $schedule->id }}" class="btn btn-delete"
                               onclick="return confirm('Hapus jadwal ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="pagination-container">
                {{ $schedules->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    // Add loading animation for images
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            img.addEventListener('load', function() {
                this.classList.remove('loading');
            });
            img.classList.add('loading');
        });

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>

</body>
</html>