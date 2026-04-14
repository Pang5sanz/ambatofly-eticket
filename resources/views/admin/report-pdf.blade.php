<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Report Transaksi - {{ date('d M Y') }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #3ad0c3;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #3ad0c3;
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .summary {
            display: table;
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .summary-item {
            display: table-cell;
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #3ad0c3;
            display: block;
        }

        .summary-label {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #3ad0c3;
            color: white;
            font-weight: bold;
            font-size: 11px;
        }

        td {
            font-size: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .status-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-confirmed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .price {
            font-weight: bold;
            color: #3ad0c3;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Transaksi E-Ticket LSP RPL</h1>
        <p>Periode: {{ request('start_date', 'Semua') }} - {{ request('end_date', 'Semua') }}</p>
        <p>Dicetak pada: {{ date('d M Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <span class="summary-value">{{ $totalBookings }}</span>
            <span class="summary-label">Total Booking</span>
        </div>
        <div class="summary-item">
            <span class="summary-value">{{ $confirmedBookings }}</span>
            <span class="summary-label">Booking Dikonfirmasi</span>
        </div>
        <div class="summary-item">
            <span class="summary-value">Rp {{ number_format($totalRevenue) }}</span>
            <span class="summary-label">Total Pendapatan</span>
        </div>
    </div>

    @if($reports->isEmpty())
        <div style="text-align: center; padding: 50px; color: #666;">
            <p>Tidak ada data transaksi untuk periode yang dipilih.</p>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Nama User</th>
                    <th>Jadwal Penerbangan</th>
                    <th class="text-center">Jumlah Penumpang</th>
                    <th class="text-right">Total Harga</th>
                    <th class="text-center">Status</th>
                    <th>Tanggal Booking</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $index => $booking)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                    <td>
                        {{ $booking->schedule->plane_name ?? 'N/A' }}<br>
                        <small style="color: #666;">
                            {{ $booking->schedule->origin ?? 'N/A' }} → {{ $booking->schedule->destination ?? 'N/A' }}<br>
                            {{ $booking->schedule ? \Carbon\Carbon::parse($booking->schedule->departure)->format('d M Y H:i') : 'N/A' }}
                        </small>
                    </td>
                    <td class="text-center">{{ $booking->passengers ?? 1 }}</td>
                    <td class="text-right price">Rp {{ number_format($booking->total_price) }}</td>
                    <td class="text-center">
                        <span class="status-badge status-{{ strtolower($booking->status) }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        <p>Dicetak oleh Sistem E-Ticket LSP RPL - {{ date('Y') }}</p>
    </div>
</body>
</html>