<!DOCTYPE html>
<html>
<head>
    <title>Edit Jadwal - E-Ticket Admin</title>
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

        /* Animated background */
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
            max-width: 700px;
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

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-header p {
            color: #666;
            font-size: 1rem;
        }

        .nav-back {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            color: #4CAF50;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-back:hover {
            transform: translateX(-5px);
            color: #3e9442;
        }

        .form-group {
            margin-bottom: 25px;
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .form-group:nth-child(6) { animation-delay: 0.6s; }

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

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .label-icon {
            color: #4CAF50;
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
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
            background: white;
            transform: translateY(-2px);
        }

        input::placeholder {
            color: #aaa;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }

        .btn {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-submit {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        @media (max-width: 600px) {
            .container {
                padding: 25px;
            }

            .form-header h1 {
                font-size: 1.5rem;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-header">
        <h1>✏️ Edit Jadwal Penerbangan</h1>
        <p>Perbarui informasi jadwal penerbangan</p>
    </div>

    <a class="nav-back" href="/admin/dashboard">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>

    <form action="/admin/schedules/update/{{ $schedule->id }}" method="POST">
        @csrf

        <div class="form-group">
            <label>
                <i class="fas fa-plane label-icon"></i>
                Nama Maskapai
            </label>
            <input type="text" name="plane_name" value="{{ $schedule->plane_name }}" required>
        </div>

        <div class="form-group">
            <label>
                <i class="fas fa-map-pin label-icon"></i>
                Asal (Origin)
            </label>
            <input type="text" name="origin" value="{{ $schedule->origin }}" required>
        </div>

        <div class="form-group">
            <label>
                <i class="fas fa-location-dot label-icon"></i>
                Tujuan (Destination)
            </label>
            <input type="text" name="destination" value="{{ $schedule->destination }}" required>
        </div>

        <div class="form-group">
            <label>
                <i class="fas fa-calendar label-icon"></i>
                Waktu Keberangkatan
            </label>
            <input 
                type="datetime-local" 
                name="departure"
                value="{{ date('Y-m-d\TH:i', strtotime($schedule->departure)) }}" 
                required
            >
        </div>

        <div class="form-group">
            <label>
                <i class="fas fa-tag label-icon"></i>
                Harga per Tiket
            </label>
            <input type="number" name="price" value="{{ $schedule->price }}" required>
        </div>

        <div class="form-group">
            <label>
                <i class="fas fa-chair label-icon"></i>
                Stok Kursi
            </label>
            <input type="number" name="stock" value="{{ $schedule->stock }}" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-submit">
                <i class="fas fa-check"></i>
                Update Jadwal
            </button>
        </div>
    </form>
</div>

</body>
</html>