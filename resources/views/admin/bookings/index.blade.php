<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Transaksi - Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #3ad0c3, #b6e1ff, #ffd1c1);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h2, h3 {
            color: #333;
            margin-top: 0;
        }

        nav {
            margin-bottom: 20px;
        }

        nav a {
            text-decoration: none;
            color: #007BFF;
            font-weight: 500;
            margin-right: 10px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        hr {
            border: none;
            height: 1px;
            background: #ddd;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background: #3ad0c3;
            color: white;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        tbody tr {
            background: #f9f9f9;
            transition: 0.3s;
        }

        tbody tr:nth-child(even) {
            background: #f1f1f1;
        }

        tbody tr:hover {
            background: #e0f7f5;
        }

        .btn {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            margin: 2px;
            display: inline-block;
            transition: 0.3s;
        }

        .btn-edit {
            background: #4CAF50;
            color: white;
        }

        .btn-edit:hover {
            background: #3e9442;
        }

        .btn-delete {
            background: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background: #d32f2f;
        }

        .btn-add {
            background: #3ad0c3;
            color: white;
            padding: 8px 14px;
            border-radius: 10px;
        }

        .btn-add:hover {
            background: #2bb3a8;
        }

        /* Pagination Styles */
        .pagination {
            display: inline-flex;
            list-style: none;
            padding: 0;
            margin: 20px 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .pagination li {
            margin: 0;
        }

        .pagination li a,
        .pagination li span {
            padding: 10px 15px;
            text-decoration: none;
            color: #3ad0c3;
            background: white;
            border-right: 1px solid #ddd;
            transition: 0.3s;
        }

        .pagination li:last-child a,
        .pagination li:last-child span {
            border-right: none;
        }

        .pagination li a:hover,
        .pagination li.active span {
            background: #3ad0c3;
            color: white;
        }

        .pagination li.disabled span {
            color: #ccc;
            background: #f9f9f9;
        }

        .empty {
            text-align: center;
            padding: 20px;
            color: #777;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                background: white;
                border-radius: 10px;
                padding: 10px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            }

            td {
                text-align: left;
                padding: 8px;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                color: #555;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Riwayat Transaksi Semua User</h2>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#f8d7da; color:#721c24; padding:10px; border-radius:5px; margin-bottom:20px;">
            {{ session('error') }}
        </div>
    @endif

    <nav>
        <a href="/admin/dashboard">← Kembali ke Dashboard</a>
        <a href="/logout">Logout</a>
    </nav>

    <hr>

    @if ($bookings->isEmpty())
        <p class="empty">Belum ada transaksi untuk ditampilkan.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemesan</th>
                    <th>Maskapai</th>
                    <th>Jumlah Kursi</th>
                    <th>Total Bayar</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Verifikasi Bukti</th>
                    <th>Status Pesanan</th>
                    <th>Waktu Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $b)
                    <tr>
                        <td data-label="ID">{{ $b->id }}</td>
                        <td data-label="Nama">{{ $b->user->name }}</td>
                        <td data-label="Pesawat">{{ $b->schedule->plane_name }}</td>
                        <td data-label="Kursi">{{ $b->total_seats }}</td>
                        <td data-label="Total">Rp {{ number_format($b->total_price) }}</td>
                        <td data-label="Metode Pembayaran">
                            @if($b->payment)
                                <div>{{ ucfirst(str_replace('_', ' ', $b->payment->payment_method)) }}</div>
                            @else
                                <span style="color: #999;">Belum ada</span>
                            @endif
                        </td>
                        <td data-label="Status Pembayaran">
                            @if($b->payment && $b->payment->status == 'completed')
                                <span style="color: green; font-weight: bold;">Sudah Dibayar</span>
                            @else
                                <span style="color: red; font-weight: bold;">Belum Dibayar</span>
                            @endif
                        </td>
                        <td data-label="Verifikasi Bukti">
                            @if($b->payment && $b->payment->payment_proof)
                                <span style="@if($b->payment->payment_verification_status == 'verified') color: green; @elseif($b->payment->payment_verification_status == 'rejected') color: red; @else color: orange; @endif font-weight: bold;">
                                    {{ ucfirst($b->payment->payment_verification_status) }}
                                </span>
                                <br>
                                <a href="{{ asset('storage/' . $b->payment->payment_proof) }}" target="_blank" style="color: #007BFF; font-size: 12px;">Lihat Bukti</a>
                            @else
                                <span style="color: #999;">Belum Upload</span>
                            @endif
                        </td>
                        <td data-label="Status Pesanan">
                            @if($b->status == 'pending')
                                <span style="color: orange; font-weight: bold;">Pending</span>
                            @elseif($b->status == 'success')
                                <span style="color: green; font-weight: bold;">Dikonfirmasi</span>
                            @else
                                <span style="color: red; font-weight: bold;">{{ ucfirst($b->status) }}</span>
                            @endif
                        </td>
                        <td data-label="Waktu">{{ $b->created_at->format('d/m/Y H:i') }}</td>
                        <td data-label="Aksi">
                            @if($b->payment && ($b->payment->payment_verification_status == 'pending' || $b->payment->payment_verification_status == 'rejected'))
                                <form action="/admin/bookings/verify-payment/{{ $b->payment->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-edit" style="background: #4CAF50; font-size: 12px; padding: 5px 8px;">Verifikasi</button>
                                </form>
                                <form action="/admin/bookings/reject-payment/{{ $b->payment->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-delete" style="background: #f44336; font-size: 12px; padding: 5px 8px;" onclick="return confirm('Tolak bukti pembayaran ini?')">Tolak</button>
                                </form>
                            @elseif($b->status == 'pending' && $b->payment && $b->payment->payment_verification_status == 'verified')
                                <form action="/admin/bookings/confirm/{{ $b->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-edit">Konfirmasi Pesanan</button>
                                </form>
                            @elseif($b->status == 'pending')
                                <span class="btn" style="background:#ccc; color:#666;">Menunggu Pembayaran</span>
                            @else
                                <span class="btn" style="background:#ccc; color:#666;">Sudah Dikonfirmasi</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination untuk bookings -->
        <div style="margin-top: 20px; text-align: center;">
            {{ $bookings->links() }}
        </div>
    @endif
</div>

</body>
</html>