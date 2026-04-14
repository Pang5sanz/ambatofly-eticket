<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Ticket LSP RPL</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #3ad0c3 0%, #b6e1ff 50%, #ffd1c1 100%);
            color: #333;
            overflow-x: hidden;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.25), transparent 22%),
                radial-gradient(circle at 80% 10%, rgba(0, 123, 255, 0.18), transparent 20%),
                radial-gradient(circle at 70% 80%, rgba(255, 209, 193, 0.24), transparent 20%);
            pointer-events: none;
        }
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .auth-card {
            width: 100%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            border-radius: 30px;
            overflow: hidden;
            background: rgba(255,255,255,0.85);
            box-shadow: 0 30px 80px rgba(0,0,0,0.12);
            backdrop-filter: blur(20px);
        }
        .hero-panel {
            position: relative;
            padding: 60px 50px;
            background: linear-gradient(135deg, rgba(255,255,255,0.96), rgba(255,255,255,0.82));
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 18px;
        }
        .hero-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top left, rgba(58, 208, 195, 0.25), transparent 25%) no-repeat;
            pointer-events: none;
        }
        .hero-panel h1 {
            font-size: clamp(2.4rem, 2.8vw, 3.2rem);
            color: #0f172a;
            line-height: 1.05;
        }
        .hero-panel p {
            color: #475569;
            font-size: 1rem;
            line-height: 1.8;
            max-width: 520px;
        }
        .hero-panel .plane-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .hero-panel img {
            width: min(280px, 100%);
            animation: float 6s ease-in-out infinite;
        }
        .hero-panel .highlight {
            display: inline-block;
            padding: 6px 14px;
            background: rgba(58, 208, 195, 0.15);
            border-radius: 999px;
            color: #0f172a;
            font-weight: 600;
            margin-top: 10px;
        }
        .form-panel {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 22px;
        }
        .form-panel h2 {
            font-size: 2rem;
            color: #0f172a;
        }
        .form-panel p.subtitle {
            color: #64748b;
            line-height: 1.8;
        }
        form {
            display: grid;
            gap: 18px;
        }
        label {
            font-size: 0.95rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            display: block;
        }
        input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            font-size: 1rem;
            color: #0f172a;
            transition: all 0.25s ease;
        }
        input:focus {
            outline: none;
            border-color: #3ad0c3;
            box-shadow: 0 0 0 6px rgba(58, 208, 195, 0.12);
            background: white;
        }
        .btn {
            padding: 16px 20px;
            border: none;
            border-radius: 18px;
            font-size: 1rem;
            font-weight: 700;
            color: white;
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 12px 30px rgba(58, 208, 195, 0.24);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 38px rgba(58, 208, 195, 0.28);
        }
        .message {
            padding: 16px 18px;
            border-radius: 18px;
            background: rgba(248, 113, 113, 0.12);
            color: #b91c1c;
            border: 1px solid rgba(248, 113, 113, 0.25);
        }
        .caption {
            font-size: 0.95rem;
            color: #64748b;
        }
        .form-footer {
            font-size: 0.95rem;
            color: #64748b;
        }
        .form-footer a {
            color: #3ad0c3;
            text-decoration: none;
            font-weight: 700;
        }
        .form-footer a:hover {
            text-decoration: underline;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-14px); }
        }
        @media (max-width: 960px) {
            .auth-card { grid-template-columns: 1fr; }
            .hero-panel, .form-panel { padding: 40px; }
        }
        @media (max-width: 640px) {
            .page-wrapper { padding: 16px; }
            .hero-panel, .form-panel { padding: 30px; }
            .hero-panel h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="auth-card">
        <div class="hero-panel">
            <h1>Ambatofly</h1>
            <div class="plane-wrapper">
                <img src="/images/plane.png" alt="Pesawat" />
            </div>
            <p class="caption">Nikmati Perjalanan yang Lebih Mudah dengan Ambatofly</p>
        </div>
        <div class="form-panel">
            <h2>Login</h2>

            @if(session('error'))
                <div class="message">{{ session('error') }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <button type="submit" class="btn">Masuk Sekarang</button>
            </form>

            <div class="form-footer">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></div>
        </div>
    </div>
</div>
</body>
</html>