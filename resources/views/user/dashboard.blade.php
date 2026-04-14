<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User - E-Ticket LSP RPL</title>
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

        /* Flights Section */
        .flights-section {
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

        /* Flight Cards */
        .flights-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .flight-card {
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

        .flight-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .flight-header {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            padding: 20px;
            position: relative;
        }

        .flight-header::before {
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

        .flight-body {
            padding: 20px;
        }

        .flight-details {
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

        .price-section {
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

        .seats-left {
            background: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .book-btn {
            width: 100%;
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .book-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(58, 208, 195, 0.3);
        }

        /* Search Section */
        .search-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .search-inputs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .search-group {
            display: flex;
            flex-direction: column;
        }

        .search-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .search-input {
            padding: 12px 16px;
            border: 2px solid rgba(58, 208, 195, 0.2);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .search-input:focus {
            outline: none;
            border-color: #3ad0c3;
            box-shadow: 0 0 0 3px rgba(58, 208, 195, 0.1);
            background: white;
        }

        .search-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .search-btn, .clear-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
        }

        .search-btn {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            box-shadow: 0 4px 15px rgba(58, 208, 195, 0.3);
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(58, 208, 195, 0.4);
        }

        .clear-btn {
            background: #f44336;
            color: white;
            box-shadow: 0 4px 15px rgba(244, 67, 54, 0.3);
        }

        .clear-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(244, 67, 54, 0.4);
        }

        .search-results {
            background: linear-gradient(135deg, rgba(58, 208, 195, 0.1) 0%, rgba(0, 123, 255, 0.1) 100%);
            border: 1px solid rgba(58, 208, 195, 0.3);
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .search-results i {
            color: #3ad0c3;
            margin-right: 8px;
        }

        .search-results strong {
            color: #007BFF;
            font-weight: 600;
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

            .flights-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                flex-direction: column;
                align-items: center;
            }

            .flight-details {
                grid-template-columns: 1fr;
            }

            .price-section {
                flex-direction: column;
                gap: 10px;
                text-align: center;
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
                <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p>Temukan penerbangan impian Anda dengan harga terbaik. Kami menyediakan berbagai pilihan maskapai terpercaya untuk perjalanan Anda.</p>
            </div>
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=400&h=300&fit=crop&crop=center" alt="Travel" loading="lazy">
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="nav-section">
        <div class="nav-links">
            <a href="/history" class="nav-link">
                <i class="fas fa-history"></i>
                Riwayat Pemesanan
            </a>
            <a href="/logout" class="nav-link">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-plane"></i>
            </div>
            <div class="stat-number">{{ $allSchedules->count() }}</div>
            <div class="stat-label">Penerbangan Tersedia</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-route"></i>
            </div>
            <div class="stat-number">{{ $allSchedules->unique('origin')->count() }}</div>
            <div class="stat-label">Kota Asal</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="stat-number">{{ $allSchedules->unique('destination')->count() }}</div>
            <div class="stat-label">Kota Tujuan</div>
        </div>
    </div>

    <!-- Flights Section -->
    <div class="flights-section">
        <div class="section-header">
            <h2>Jadwal Penerbangan Tersedia</h2>
            <p>Pilih penerbangan yang sesuai dengan kebutuhan Anda</p>
        </div>

        <!-- Search Form -->
        <div class="search-section">
            <form method="GET" action="/dashboard" class="search-form">
                <div class="search-inputs">
                    <div class="search-group">
                        <label for="origin">Asal</label>
                        <input type="text" id="origin" name="origin" value="{{ request('origin') }}" placeholder="Kota asal" class="search-input">
                    </div>
                    <div class="search-group">
                        <label for="destination">Tujuan</label>
                        <input type="text" id="destination" name="destination" value="{{ request('destination') }}" placeholder="Kota tujuan" class="search-input">
                    </div>
                    <div class="search-group">
                        <label for="plane_name">Maskapai</label>
                        <input type="text" id="plane_name" name="plane_name" value="{{ request('plane_name') }}" placeholder="Nama maskapai" class="search-input">
                    </div>
                </div>
                <div class="search-actions">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    @if(request()->hasAny(['origin', 'destination', 'plane_name']))
                        <a href="/dashboard" class="clear-btn">
                            <i class="fas fa-times"></i> Hapus Filter
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if(request()->hasAny(['origin', 'destination', 'plane_name']))
            <div class="search-results">
                <p><i class="fas fa-search"></i> Menampilkan {{ $schedules->total() }} hasil pencarian
                    @if(request('origin')) untuk asal: <strong>{{ request('origin') }}</strong>@endif
                    @if(request('destination')) tujuan: <strong>{{ request('destination') }}</strong>@endif
                    @if(request('plane_name')) maskapai: <strong>{{ request('plane_name') }}</strong>@endif
                </p>
            </div>
        @endif

        @if($schedules->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-plane-slash"></i>
                </div>
                @if(request()->hasAny(['origin', 'destination', 'plane_name']))
                    <h3 class="empty-title">Tidak Ada Penerbangan Ditemukan</h3>
                    <p class="empty-text">Tidak ada penerbangan yang sesuai dengan kriteria pencarian Anda. Coba ubah kata kunci pencarian atau <a href="/dashboard" style="color: #3ad0c3; text-decoration: underline;">hapus filter</a>.</p>
                @else
                    <h3 class="empty-title">Tidak Ada Penerbangan Tersedia</h3>
                    <p class="empty-text">Saat ini belum ada jadwal penerbangan yang tersedia. Silakan kembali lagi nanti.</p>
                @endif
            </div>
        @else
            <div class="flights-grid">
                @foreach($schedules as $index => $item)
                <div class="flight-card" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="flight-header">
                        <div class="airline-name">{{ $item->plane_name }}</div>
                        <div class="route">{{ $item->origin }} → {{ $item->destination }}</div>
                    </div>
                    <div class="flight-body">
                        <div class="flight-details">
                            <div class="detail-item">
                                <i class="fas fa-calendar-alt detail-icon"></i>
                                <div>
                                    <div class="detail-label">Keberangkatan</div>
                                    <div class="detail-value">{{ \Carbon\Carbon::parse($item->departure)->format('d M Y, H:i') }}</div>
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

                        <div class="price-section">
                            <div class="price">Rp {{ number_format($item->price) }}</div>
                            <div class="seats-left">
                                <i class="fas fa-chair"></i> {{ $item->stock }} kursi tersisa
                            </div>
                        </div>

                        <a href="/booking/{{ $item->id }}" class="book-btn">
                            <i class="fas fa-ticket-alt"></i> Pesan Sekarang
                        </a>
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