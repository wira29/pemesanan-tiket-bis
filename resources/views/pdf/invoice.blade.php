<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-size: 11px;
            font-family: DejaVu Sans;
            margin-top: 120px;
        }

        .header {
            position: fixed;
            top: -10px;
            left: 0;
            right: 0;
            height: 110px;
        }

        .header table {
            width: 100%;
            border: none;
        }

        .header td {
            border: none;
            vertical-align: top;
        }

        .logo {
            width: 300px;
        }

        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #c40000;
        }

        .company-info {
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        th {
            text-align: center;
        }

        .no-border td {
            border: none;
            padding: 2px;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        @page {
            margin: 40px 30px 40px 30px;
        }
    </style>
</head>
<body>

{{-- HEADER --}}
<div class="header">
    <table>
        <tr>
            <td width="60%">
                <img src="{{ public_path('assets/bagong-logo.png') }}" class="logo">
            </td>
            <td width="40%" class="company-info">
                Jl. Panglima Sudirman No. 8 Kepanjen - Malang<br>
                Jawa Timur - Indonesia 65163<br>
                Telp : 62 341 395 524, 393 382<br>
                Fax  : 62 341 395 724<br>
                Email: info@bagongbis.com<br>
                Web  : www.bagongbis.com
            </td>
        </tr>
    </table>
</div>

{{-- INFO INVOICE --}}
<table class="no-border">
    <tr>
        <td width="25%">Invoice No</td>
        <td width="35%">: <strong>{{ $invoice->invoice_code }}</strong></td>
        <td width="15%">Tanggal</td>
        <td width="25%">: {{ \Carbon\Carbon::parse($invoice->date)->translatedFormat('d F Y') }}</td>
    </tr>
    <tr>
        <td>Rute</td>
        <td>: {{ strtoupper($travel->from) }} - {{ strtoupper($travel->destination) }}</td>
        <td>Kendaraan</td>
        <td>: {{ $travel->vehicle_number }}</td>
    </tr>
</table>

<br>

<p class="center">
    <strong>
        INVOICE<br>
        PT. BAGONG DEKAKA MAKMUR
    </strong>
</p>

{{-- TABEL DETAIL PENUMPANG --}}
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis<br>Kelamin</th>
            <th>Umur</th>
            <th>No Kursi</th>
            <th>No Passport</th>
            <th>Whatsapp</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoice->tickets as $i => $ticket)
        <tr>
            <td class="center">{{ $i + 1 }}</td>
            <td>{{ $ticket->ticket->name }}</td>
            <td class="center">{{ strtoupper($ticket->ticket->gender) }}</td>
            <td class="center">{{ $ticket->ticket->age }}</td>
            <td class="center">{{ $ticket->ticket->seat_no }}</td>
            <td>{{ $ticket->ticket->passport ?? '-' }}</td>
            <td>{{ $ticket->ticket->whatsapp }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6" class="right">TOTAL</th>
            <th class="right">
                Rp {{ number_format($invoice->total_price, 0, ',', '.') }}
            </th>
        </tr>
    </tfoot>
</table>

<br><br>

{{-- TANDA TANGAN --}}
<table class="no-border">
    <tr>
        <td width="60%"></td>
        <td class="center">
            Kupang, {{ \Carbon\Carbon::parse($invoice->date)->translatedFormat('d F Y') }}
            <br><br>
            <img src="{{ public_path('assets/ttd.jpg') }}" width="100" alt="">
            <br>
            <strong>
                Muhammad Deni Hasan, S.Tr.E<br>
                (Penanggung Jawab Operasional)
            </strong>
        </td>
    </tr>
</table>

</body>
</html>
