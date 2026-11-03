<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan Masjid Al-Munawwaroh</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #065f46; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #065f46; text-transform: uppercase; }
        .header p { margin: 5px 0; font-size: 12px; color: #666; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f8fafc; color: #64748b; text-transform: uppercase; font-size: 10px; letter-spacing: 1px; padding: 12px; border: 1px solid #e2e8f0; }
        td { padding: 12px; border: 1px solid #e2e8f0; font-size: 13px; }
        
        .total-row { background-color: #ecfdf5; font-weight: bold; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; font-size: 11px; text-align: right; italic; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Kas Masjid</h2>
        <p>Dicetak pada: {{ $tanggal }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Keterangan Sumber Dana</th>
                <th class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Donasi Digital (Sistem Web)</td>
                <td class="text-right">Rp {{ number_format($donations->sum('amount'), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kas Fisik (Kotak Amal)</td>
                <td class="text-right">Rp {{ number_format($dataBank->total_kas_fisik ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="color: #e11d48;">Total Pengeluaran</td>
                <td class="text-right" style="color: #e11d48;">- Rp {{ number_format($dataBank->total_pengeluaran ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>SALDO AKHIR KAS</td>
                <td class="text-right">Rp {{ number_format($saldo, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        *Laporan ini dihasilkan secara otomatis oleh Sistem Informasi Masjid.
    </div>
</body>
</html>