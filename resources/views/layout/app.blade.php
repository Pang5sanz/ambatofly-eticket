<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Ticketing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Navbar atas -->
    <nav class="navbar">
        <button class="toggle-sidebar" aria-label="Menu ☰">☰</button>
        <h2 class="logo">E-Ticketing</h2>
        <div class="nav-right">
            <a href="/logout" class="logout">Logout</a>
        </div>
    </nav>

    <!-- Layout dengan sidebar dan konten -->
    <div class="layout">
        <aside class="sidebar">
            <a href="/dashboard">🏠 Dashboard</a>
            <a href="/booking_details">🎫 Booking</a>
            <a href="/history">📜 History</a>
        </aside>

        <main class="content">
            @yield('content')
        </main>
    </div>

    <!-- Script toggle sidebar (opsional) -->
    <script>
        const btn = document.querySelector('.toggle-sidebar');
        const sidebar = document.querySelector('.sidebar');
        btn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>
</body>
</html>
