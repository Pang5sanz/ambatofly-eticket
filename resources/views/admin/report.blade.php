<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report Transaksi - Admin</title>

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

        /* Header Section */
        .header-section {
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

        .header-content {
            text-align: center;
        }

        .header-content h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-content p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 20px;
        }

        /* Filter Section */
        .filter-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .filter-input {
            padding: 12px 16px;
            border: 2px solid rgba(58, 208, 195, 0.2);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .filter-input:focus {
            outline: none;
            border-color: #3ad0c3;
            box-shadow: 0 0 0 3px rgba(58, 208, 195, 0.1);
            background: white;
        }

        .filter-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-btn, .export-btn {
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

        .filter-btn {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            box-shadow: 0 4px 15px rgba(58, 208, 195, 0.3);
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(58, 208, 195, 0.4);
        }

        .export-btn {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
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

        /* Table Section */
        .table-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        thead {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 0.9rem;
            font-weight: 600;
        }

        td {
            padding: 12px 15px;
            background: white;
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
        }

        tbody tr {
            transition: 0.3s;
        }

        tbody tr:hover {
            background: #f5faff;
            transform: scale(1.01);
        }

        /* Status Badge */
        .badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .badge-confirmed {
            background: #d4edda;
            color: #155724;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        .badge-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* Price */
        .price {
            font-weight: bold;
            color: #3ad0c3;
        }

        /* Actions */
        .actions {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3ad0c3, #007BFF);
            color: white;
            box-shadow: 0 4px 15px rgba(58, 208, 195, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(58, 208, 195, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #3ad0c3;
        }

        .empty-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }

        .empty-text {
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .header-section, .filter-section, .table-section {
                padding: 20px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .stats-section {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header Section -->
    <div class="header-section">
        <div class="header-content">
            <h1><i class="fas fa-chart-line"></i> Report Transaksi</h1>
            <p>Kelola dan pantau semua transaksi pengguna dalam sistem e-ticket</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('admin.report') }}" class="filter-form">
            <div class="filter-group">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="filter-input">
            </div>
            <div class="filter-group">
                <label for="end_date">Tanggal Akhir</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="filter-input">
            </div>
            <div class="filter-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="filter-input">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="user_id">User</label>
                <select id="user_id" name="user_id" class="filter-input">
                    <option value="">Semua User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="filter-btn">
                    <i class="fas fa-search"></i> Filter
                </button>
                @if(request()->hasAny(['start_date', 'end_date', 'status', 'user_id']))
                    <a href="{{ route('admin.report') }}" class="export-btn">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Stats Section -->
    @if($reports->isNotEmpty())
    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-number">{{ $reports->count() }}</div>
            <div class="stat-label">Total Transaksi</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $reports->where('status', 'confirmed')->count() }}</div>
            <div class="stat-label">Transaksi Dikonfirmasi</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-number">Rp {{ number_format($reports->sum('total_price')) }}</div>
            <div class="stat-label">Total Pendapatan</div>
        </div>
    </div>
    @endif

    <!-- Table Section -->
    <div class="table-section">
        @if($reports->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <h3 class="empty-title">Tidak Ada Data Transaksi</h3>
                <p class="empty-text">
                    @if(request()->hasAny(['start_date', 'end_date', 'status', 'user_id']))
                        Tidak ada transaksi yang sesuai dengan filter yang dipilih.
                    @else
                        Belum ada transaksi yang tercatat dalam sistem.
                    @endif
                </p>
            </div>
        @else
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Jadwal Penerbangan</th>
                            <th>Jumlah Penumpang</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $booking->user->name ?? 'N/A' }}</td>
                            <td>
                                <div>
                                    <strong>{{ $booking->schedule->plane_name ?? 'N/A' }}</strong><br>
                                    <small style="color: #666;">
                                        {{ $booking->schedule->origin ?? 'N/A' }} → {{ $booking->schedule->destination ?? 'N/A' }}<br>
                                        {{ $booking->schedule ? \Carbon\Carbon::parse($booking->schedule->departure)->format('d M Y H:i') : 'N/A' }}
                                    </small>
                                </div>
                            </td>
                            <td>{{ $booking->passengers ?? 1 }}</td>
                            <td class="price">Rp {{ number_format($booking->total_price) }}</td>
                            <td>
                                <span class="badge badge-{{ $booking->status }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>

            @if($reports->isNotEmpty())
                <a href="{{ route('admin.report.pdf', request()->query()) }}" class="btn btn-primary">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
            @endif

            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    </div>
</div>

</body>
</html>