<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-size: 11px;
            font-family: DejaVu Sans;
            margin: 20px;
        }

        .header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .header td {
            /* border: 1px solid #000; */
            padding: 10px;
            vertical-align: top;
        }

        .logo {
            width: 250px;
        }

        .company-info {
            font-size: 10px;
            line-height: 1.6;
        }

        .company-info strong {
            font-size: 12px;
        }

        .info-section {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        .info-section td {
            /* border: 1px solid #000; */
            padding: 5px;
            font-size: 10px;
        }

        .date-box {
            text-align: center;
            /* border: 1px solid #000; */
            padding: 5px;
            margin-bottom: 5px;
        }

        .intro-text {
            margin: 10px 0;
            font-size: 10px;
            line-height: 1.5;
        }

        table.detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.detail-table th,
        table.detail-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            font-size: 10px;
        }

        table.detail-table th {
            font-weight: bold;
        }

        .total-row {
            font-weight: bold;
            text-align: right;
        }

        .notes {
            margin-top: 20px;
            font-size: 10px;
            line-height: 1.6;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
        }

        .signature img {
            width: 150px;
            margin: 10px 0;
        }

        @page {
            margin: 20px;
        }
    </style>
</head>
<body>

{{-- HEADER --}}
<table class="header" style="border: none;">
    <tr>
        <td width="40%">
            <img src="{{ public_path('assets/bagong-logo.png') }}" class="logo">
        </td>
        <td width="60%" class="company-info">
            <strong>Jl. Panglima Sudirman No. 8 Kepanjen - Malang</strong><br>
            Jawa Timur - Indonesia 65163<br>
            <strong>☎</strong> : 62 341 395 524, 393 382<br>
            <strong>Fax.</strong> : 62 341 395 724<br>
            <strong>✉</strong> : info@bagongbis.com<br>
            <strong>🌐</strong> : www.bagongbis.com
        </td>
    </tr>
</table>

{{-- DATE BOX --}}
<div class="date-box">
    <strong>Kupang, {{ \Carbon\Carbon::parse($invoice->date)->translatedFormat('d F Y') }}</strong>
</div>

{{-- INFO SECTION --}}
<table class="info-section">
    <tr>
        <td width="20%"><strong>Kode Booking</strong></td>
        <td width="30%">: {{ $invoice->invoice_code }}</td>
        <td width="50%" rowspan="3" style=""></td>
    </tr>
    <tr>
        <td><strong>Hal</strong></td>
        <td>: Invoice Pemesanan Tiket</td>
    </tr>
    <tr>
        <td><strong>Terlampir</strong></td>
        <td>: -</td>
    </tr>
</table>

{{-- INTRO TEXT --}}
<div class="intro-text">
    <strong>Dengan Hormat,</strong><br>
    Bersama ini kami lampirkan Invoice Pemesanan tiket Bus Angkutan Lintas Batas Negara (ALBN)<br>
    untuk periode pemesanan yang terinci sbb:
</div>

{{-- DETAIL TABLE --}}
<table class="detail-table">
    <thead>
        <tr>
            <th>No</th>
            <th>NAMA</th>
            <th>TUJUAN</th>
            <th>TANGGAL KEBERANGKATAN</th>
            <th>NO KURSI</th>
            <th>PRICE</th>
            <th>TARIF</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoice->tickets as $i => $ticket)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $ticket->ticket->name }} @if($ticket->ticket->passport)({{ $ticket->ticket->passport }})@endif</td>
            <td>{{ ucwords($ticket->ticket->from) }} - {{ ucwords($ticket->ticket->destination) }}</td>
            <td>{{ \Carbon\Carbon::parse($invoice->date)->translatedFormat('d F Y') }}</td>
            <td>{{ $ticket->ticket->seat_no }}</td>
            <td>Rp{{ number_format($invoice->total_price / count($invoice->tickets), 0, ',', '.') }}</td>
            <td>Rp {{ number_format($invoice->total_price / count($invoice->tickets), 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" class="total-row">TOTAL</td>
            <td class="total-row">Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</td>
        </tr>
    </tfoot>
</table>

{{-- NOTES --}}
<div class="notes">
    <strong>Terbilang:</strong><br>
    {{ ucwords(\Terbilang::make($invoice->total_price)) }} Rupiah<br><br>
    Demikian Invoice Pemesanan Tiket ini kami Ajukan, atas kerja samanya kami ucapkan terima kasih.
</div>

{{-- SIGNATURE --}}
<div class="signature">
    <div class="signature-box">
        <strong>Hormat kami,</strong><br>
        <img src="{{ public_path('assets/ttd.jpg') }}" alt="Signature"><br>
        <strong>Muhammad Deni Hasan</strong><br>
        Penanggung Jawab Operasional
    </div>
</div>

</body>
</html>