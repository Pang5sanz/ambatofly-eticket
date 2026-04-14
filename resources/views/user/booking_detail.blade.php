<!DOCTYPE html>
<html>
<head>
    <title>Detail Pemesanan - E-Ticket</title>
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

        .flight-info-card {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(58, 208, 195, 0.2);
        }

        .flight-info-card h3 {
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .flight-info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 10px;
        }

        .flight-info-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .flight-info-item i {
            font-size: 1.2rem;
            opacity: 0.8;
        }

        .flight-info-item strong {
            display: block;
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 2px;
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

        input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.6) 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        input:focus {
            border-color: #3ad0c3;
            outline: none;
            box-shadow: 0 0 0 3px rgba(58, 208, 195, 0.1);
            background: white;
            transform: translateY(-2px);
        }

        .passenger-card {
            background: linear-gradient(135deg, rgba(58, 208, 195, 0.05) 0%, rgba(0, 123, 255, 0.05) 100%);
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .passenger-card:hover {
            border-color: #3ad0c3;
            box-shadow: 0 10px 20px rgba(58, 208, 195, 0.1);
        }

        .passenger-card h4 {
            color: #3ad0c3;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .total-section {
            background: linear-gradient(135deg, rgba(58, 208, 195, 0.1) 0%, rgba(0, 123, 255, 0.1) 100%);
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            margin: 30px 0;
        }

        .total-label {
            color: #666;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .total-amount {
            font-size: 2.5rem;
            font-weight: bold;
            color: #3ad0c3;
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

            .flight-info-row {
                grid-template-columns: 1fr;
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
        Kembali ke Jadwal
    </a>

    <div class="header">
        <h1>✏️ Konfirmasi Pemesanan Tiket</h1>
    </div>

    <div class="flight-info-card">
        <h3>✈️ Rincian Maskapai</h3>
        <div class="flight-info-row">
            <div class="flight-info-item">
                <i class="fas fa-plane"></i>
                <div>
                    <strong>Maskapai</strong>
                    {{ $schedule->plane_name }}
                </div>
            </div>
            <div class="flight-info-item">
                <i class="fas fa-map-marked-alt"></i>
                <div>
                    <strong>Rute</strong>
                    {{ $schedule->origin }} → {{ $schedule->destination }}
                </div>
            </div>
            <div class="flight-info-item">
                <i class="fas fa-calendar-alt"></i>
                <div>
                    <strong>Keberangkatan</strong>
                    {{ $schedule->departure }}
                </div>
            </div>
            <div class="flight-info-item">
                <i class="fas fa-tag"></i>
                <div>
                    <strong>Harga/Kursi</strong>
                    Rp {{ number_format($schedule->price) }}
                </div>
            </div>
        </div>
        <div class="flight-info-item" style="margin-top: 15px;">
            <i class="fas fa-chair"></i>
            <div>
                <strong>Stok Tersedia</strong>
                {{ $schedule->stock }} Kursi
            </div>
        </div>
    </div>

    <form action="/booking/{{ $schedule->id }}" method="POST">
        @csrf

        <div class="form-section">
            <h3>📅 Pilih Jumlah Kursi</h3>
            <div class="form-group">
                <label>
                    <i class="fas fa-chair label-icon"></i>
                    Masukkan Jumlah Kursi
                </label>
                <input 
                    type="number" 
                    name="total_seats" 
                    min="1" 
                    max="{{ $schedule->stock }}" 
                    required
                    id="input_kursi"
                    placeholder="Contoh: 2"
                >
            </div>
        </div>

        <div id="passenger_forms" style="display: none;">
            <div class="form-section">
                <h3>👥 Detail Penumpang</h3>
                <div id="passengers-container"></div>
            </div>
        </div>

        <div class="total-section">
            <div class="total-label">Total Harga</div>
            <div class="total-amount" id="total_harga">Rp 0</div>
        </div>

        <button type="submit" class="btn">
            <i class="fas fa-check-circle"></i>
            Konfirmasi & Pesan Sekarang
        </button>
    </form>
</div>

<script>
    const inputKursi = document.getElementById('input_kursi');
    const totalHargaElem = document.getElementById('total_harga');
    const passengerForms = document.getElementById('passenger_forms');
    const passengersContainer = document.getElementById('passengers-container');
    const hargaPerKursi = {{ $schedule->price }};

    function updatePassengerForms(numSeats) {
        passengersContainer.innerHTML = '';
        for (let i = 0; i < numSeats; i++) {
            const formDiv = document.createElement('div');
            formDiv.className = 'passenger-card';
            formDiv.innerHTML = `
                <h4>
                    <i class="fas fa-user-circle"></i>
                    Penumpang ${i + 1}
                </h4>
                <div class="form-group">
                    <label>
                        <i class="fas fa-user label-icon"></i>
                        Nama Lengkap
                    </label>
                    <input type="text" name="passengers[${i}][name]" placeholder="Nama lengkap" required>
                </div>
                <div class="form-group">
                    <label>
                        <i class="fas fa-envelope label-icon"></i>
                        Email
                    </label>
                    <input type="email" name="passengers[${i}][email]" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>
                        <i class="fas fa-phone label-icon"></i>
                        No. Telepon
                    </label>
                    <input type="text" name="passengers[${i}][phone]" placeholder="No. Telepon" required>
                </div>
            `;
            passengersContainer.appendChild(formDiv);
        }
    }

    inputKursi.addEventListener('input', function () {
        const jumlahKursi = parseInt(this.value) || 0;
        const totalHarga = jumlahKursi * hargaPerKursi;
        totalHargaElem.textContent = 'Rp ' + totalHarga.toLocaleString('id-ID');
        
        if (jumlahKursi > 0) {
            passengerForms.style.display = 'block';
            updatePassengerForms(jumlahKursi);
        } else {
            passengerForms.style.display = 'none';
            passengersContainer.innerHTML = '';
        }
    });
</script>

</body>
</html>