<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pemesanan - E-Ticket</title>
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
            padding: 20px;
        }

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
            max-width: 1200px;
            margin: 0 auto;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 25px;
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

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-back {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #3ad0c3;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .nav-back:hover {
            transform: translateX(-5px);
            color: #007BFF;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
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

        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .order-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .order-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: #3ad0c3;
        }

        .order-header {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            padding: 20px;
            position: relative;
        }

        .order-header::before {
            content: '✈️';
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 1.5rem;
            opacity: 0.5;
        }

        .order-route {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .order-date {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .order-body {
            padding: 20px;
        }

        .order-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 0.95rem;
        }

        .order-detail-icon {
            color: #3ad0c3;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .order-detail-label {
            color: #666;
            font-weight: 500;
        }

        .order-detail-value {
            color: #333;
            font-weight: 600;
        }

        .order-price {
            background: linear-gradient(135deg, rgba(58, 208, 195, 0.1) 0%, rgba(0, 123, 255, 0.1) 100%);
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            text-align: center;
        }

        .price-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 5px;
        }

        .price-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #3ad0c3;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            width: 100%;
            text-align: center;
            margin-bottom: 15px;
        }

        .status-success {
            background: #4CAF50;
            color: white;
        }

        .status-pending {
            background: #ff9800;
            color: white;
        }

        .status-rejected {
            background: #f44336;
            color: white;
        }

        .order-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 10px 15px;
            border: none;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-pay {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            box-shadow: 0 4px 10px rgba(58, 208, 195, 0.3);
        }

        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(58, 208, 195, 0.4);
        }

        .btn-retry {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
            box-shadow: 0 4px 10px rgba(255, 152, 0, 0.3);
        }

        .btn-retry:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 152, 0, 0.4);
        }

        .status-text {
            font-size: 0.95rem;
            font-weight: 600;
            padding: 10px;
            text-align: center;
            display: block;
        }

        .status-waiting {
            color: #ff9800;
        }

        .status-confirmed {
            color: #4CAF50;
        }

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

        @media (max-width: 768px) {
            .container {
                padding: 25px;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .orders-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <a class="nav-back" href="/dashboard">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>

    <div class="header">
        <h1>📋 Riwayat Pemesanan Tiket Anda</h1>
    </div>

    @if ($orders->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <h3 class="empty-title">Belum Ada Pemesanan</h3>
            <p class="empty-text">Anda belum memiliki riwayat pemesanan. Mulai dengan memesan tiket penerbangan sekarang!</p>
        </div>
    @else
        <div class="orders-grid">
            @foreach ($orders as $index => $item)
                <div class="order-card" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="order-header">
                        <div class="order-route">{{ $item->schedule->plane_name }}</div>
                        <div class="order-date">{{ $item->schedule->origin }} → {{ $item->schedule->destination }}</div>
                    </div>

                    <div class="order-body">
                        <span class="status-badge @if($item->status == 'success') status-success @elseif($item->status == 'pending') status-pending @else status-rejected @endif">
                            @if($item->status == 'success')
                                <i class="fas fa-check-circle"></i> Dikonfirmasi
                            @elseif($item->status == 'pending')
                                <i class="fas fa-hourglass-half"></i> Pending
                            @else
                                <i class="fas fa-times-circle"></i> {{ ucfirst($item->status) }}
                            @endif
                        </span>

                        <div class="order-detail">
                            <i class="fas fa-calendar-alt order-detail-icon"></i>
                            <span class="order-detail-label">Tanggal:</span>
                            <span class="order-detail-value">{{ $item->created_at->format('d M Y') }}</span>
                        </div>

                        <div class="order-detail">
                            <i class="fas fa-chair order-detail-icon"></i>
                            <span class="order-detail-label">Kursi:</span>
                            <span class="order-detail-value">{{ $item->total_seats }} kursi</span>
                        </div>

                        <div class="order-detail">
                            <i class="fas fa-clock order-detail-icon"></i>
                            <span class="order-detail-label">Waktu:</span>
                            <span class="order-detail-value">{{ \Carbon\Carbon::parse($item->schedule->departure)->format('H:i') }}</span>
                        </div>

                        <div class="order-price">
                            <div class="price-label">Total Pembayaran</div>
                            <div class="price-value">Rp {{ number_format($item->total_price) }}</div>
                        </div>

                        <div class="order-actions">
                            @if(!$item->payment)
                                <a href="/checkout/{{ $item->id }}" class="btn btn-pay">
                                    <i class="fas fa-credit-card"></i> Bayar
                                </a>
                            @elseif($item->payment->payment_verification_status == 'rejected')
                                <a href="/checkout/{{ $item->id }}" class="btn btn-retry">
                                    <i class="fas fa-redo"></i> Upload Ulang
                                </a>
                            @elseif($item->status == 'pending')
                                <span class="status-text status-waiting">
                                    <i class="fas fa-spinner fa-spin"></i> Menunggu Konfirmasi
                                </span>
                            @else
                                <span class="status-text status-confirmed">
                                    <i class="fas fa-check-circle"></i> Sudah Dikonfirmasi
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>