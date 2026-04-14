<!DOCTYPE html>
<html>
<head>
    <title>Checkout Pembayaran - E-Ticket</title>
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
            max-width: 800px;
            margin: auto;
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

        .order-summary {
            background: linear-gradient(135deg, rgba(58, 208, 195, 0.1) 0%, rgba(0, 123, 255, 0.1) 100%);
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .order-summary h3 {
            color: #333;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .order-item {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 10px;
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-label {
            font-weight: 500;
            color: #666;
        }

        .order-value {
            color: #333;
        }

        .passenger-list {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }

        .passenger-item {
            padding: 8px;
            background: white;
            border-radius: 8px;
            margin-bottom: 8px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .passenger-item i {
            color: #3ad0c3;
        }

        .total-box {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            margin: 30px 0;
            box-shadow: 0 10px 30px rgba(58, 208, 195, 0.2);
        }

        .total-label {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .total-amount {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h3 {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
        }

        .form-group {
            margin-bottom: 20px;
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        label {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #333;
            margin-bottom: 10px;
        }

        .label-icon {
            color: #3ad0c3;
            font-size: 1.1rem;
            width: 20px;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.6) 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        input:focus, select:focus {
            border-color: #3ad0c3;
            outline: none;
            box-shadow: 0 0 0 3px rgba(58, 208, 195, 0.1);
            background: white;
            transform: translateY(-2px);
        }

        .file-input-wrapper {
            position: relative;
        }

        .file-helper {
            display: block;
            color: #666;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .btn {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(58, 208, 195, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(58, 208, 195, 0.4);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
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

            .total-amount {
                font-size: 2rem;
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
        <h1>💳 Checkout Pembayaran</h1>
    </div>

    <div class="order-summary">
        <h3>📄 Ringkasan Pesanan</h3>
        <div class="order-item">
            <div class="order-label">🚡 Maskapai</div>
            <div class="order-value">{{ $booking->schedule->plane_name }}</div>
        </div>
        <div class="order-item">
            <div class="order-label">📍 Rute</div>
            <div class="order-value">{{ $booking->schedule->origin }} → {{ $booking->schedule->destination }}</div>
        </div>
        <div class="order-item">
            <div class="order-label">🕐 Keberangkatan</div>
            <div class="order-value">{{ $booking->schedule->departure }}</div>
        </div>
        <div class="order-item">
            <div class="order-label">🪑 Jumlah Kursi</div>
            <div class="order-value">{{ $booking->total_seats }} kursi</div>
        </div>
        <div class="passenger-list">
            <div style="font-weight: 600; margin-bottom: 10px; color: #333;">👥 Penumpang:</div>
            @if($booking->passenger_details)
                @foreach(json_decode($booking->passenger_details, true) as $passenger)
                    <div class="passenger-item">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ $passenger['name'] }} ({{ $passenger['email'] }})</span>
                    </div>
                @endforeach
            @else
                <div class="passenger-item">
                    <i class="fas fa-info-circle"></i>
                    <span>Tidak ada data penumpang</span>
                </div>
            @endif
        </div>
    </div>

    <div class="total-box">
        <div class="total-label">Total Pembayaran</div>
        <div class="total-amount">Rp {{ number_format($booking->total_price) }}</div>
    </div>

    <form action="/checkout/{{ $booking->id }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div style="background: #fff4e5; color: #663c00; border: 1px solid #ffd8a8; padding: 16px; border-radius: 12px; margin-bottom: 20px;">
                <strong>Periksa kembali data Anda:</strong>
                <ul style="margin-top: 10px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-section">
            <h3>📄 Informasi Pembayaran</h3>

            <div class="form-group">
                <label>
                    <i class="fas fa-user label-icon"></i>
                    Nama Pelanggan
                </label>
                <input type="text" name="customer_name" value="{{ Auth::user()->name }}" required>
            </div>

            <div class="form-group">
                <label>
                    <i class="fas fa-envelope label-icon"></i>
                    Email
                </label>
                <input type="email" name="customer_email" value="{{ Auth::user()->email }}" required>
            </div>

            <div class="form-group">
                <label>
                    <i class="fas fa-phone label-icon"></i>
                    No. Telepon
                </label>
                <input type="text" name="customer_phone" placeholder="No. Telepon" required>
            </div>

            <div class="form-group">
                <label>
                    <i class="fas fa-credit-card label-icon"></i>
                    Metode Pembayaran
                </label>
                <select name="payment_method" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="credit_card" {{ old('payment_method', $booking->payment->payment_method ?? '') == 'credit_card' ? 'selected' : '' }}>💳 Kartu Kredit</option>
                    <option value="bank_transfer" {{ old('payment_method', $booking->payment->payment_method ?? '') == 'bank_transfer' ? 'selected' : '' }}>🏦 Transfer Bank</option>
                    <option value="e_wallet" {{ old('payment_method', $booking->payment->payment_method ?? '') == 'e_wallet' ? 'selected' : '' }}>📱 E-Wallet</option>
                    <option value="cash" {{ old('payment_method', $booking->payment->payment_method ?? '') == 'cash' ? 'selected' : '' }}>💵 Tunai</option>
                </select>
            </div>

            <div class="form-group payment-account-group" style="display:none;">
                <label>
                    <i class="fas fa-hashtag label-icon"></i>
                    Nomor Rekening / E-Wallet
                </label>
                <input type="text" name="payment_account" value="{{ old('payment_account', $booking->payment->payment_account ?? '') }}" placeholder="Contoh: 1234567890" />
                <small class="file-helper">Masukkan nomor rekening bila memilih bank transfer, atau nomor e-wallet jika memilih e-wallet.</small>
            </div>

            <div class="form-group">
                <label>
                    <i class="fas fa-receipt label-icon"></i>
                    Upload Bukti Pembayaran
                </label>
                <div class="file-input-wrapper">
                    <input type="file" name="payment_proof" accept="image/jpeg,image/png,image/jpg" required>
                    <small class="file-helper">📎 Format: JPG, JPEG, PNG | Max: 2MB</small>
                </div>
            </div>
        </div>

        <button type="submit" class="btn">
            <i class="fas fa-lock"></i>
            Bayar Sekarang
        </button>
    </form>
</div>

<script>
    const methodSelect = document.querySelector('select[name="payment_method"]');
    const accountGroup = document.querySelector('.payment-account-group');
    const accountInput = document.querySelector('input[name="payment_account"]');

    function toggleAccountField() {
        const value = methodSelect.value;
        if (value === 'bank_transfer' || value === 'e_wallet') {
            accountGroup.style.display = 'block';
            accountInput.required = true;
        } else {
            accountGroup.style.display = 'none';
            accountInput.required = false;
        }
    }

    methodSelect.addEventListener('change', toggleAccountField);
    document.addEventListener('DOMContentLoaded', toggleAccountField);
</script>
</body>
</html>