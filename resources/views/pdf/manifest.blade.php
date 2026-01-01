<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-size: 11px;
            font-family: DejaVu Sans;
            margin-top: 120px; /* ruang untuk kop */
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

    @page {
        margin: 40px 30px 40px 30px;
    }
</style>
</head>
<body>

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


<table class="no-border">
    <tr>
        <td>Hari/Tanggal</td>
        <td>: {{ \Carbon\Carbon::parse($travel->date)->translatedFormat('l, d F Y') }}</td>
    </tr>
    <tr>
        <td>Nomor Kendaraan</td>
        <td>: {{ $travel->vehicle_number }}</td>
    </tr>
    <tr>
        <td>Asal</td>
        <td>: {{ strtoupper($travel->from) }}</td>
    </tr>
    <tr>
        <td>Tujuan</td>
        <td>: {{ strtoupper($travel->destination) }}</td>
    </tr>
</table>

<br>

<p class="center"><strong>
    MANIFEST PENUMPANG<br>
    PT. BAGONG DEKAKA MAKMUR
</strong></p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis<br>Kelamin</th>
            <th>Dewasa<br>/ Anak</th>
            <th>Kewarganegaraan<br>& Info Telp</th>
            <th>Asal - Tujuan</th>
            <th>No Paspor</th>
            <th>No Kursi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $i => $ticket)
        <tr>
            <td class="center">{{ $i + 1 }}</td>
            <td>{{ $ticket->name }}</td>
            <td class="center">{{ strtoupper($ticket->gender) }}</td>
            <td class="center">{{ ucfirst($ticket->age) }}</td>
            <td>
                {{ $ticket->citizenship ?? 'WNI' }}<br>
                {{ $ticket->whatsapp }}
            </td>
            <td>{{ ($ticket->from != null && $ticket->destination != null) ? $ticket->from . ' - '  . $ticket->destination : $travel->from . ' - ' . $travel->destination }} <strong style="color: rgb(190, 171, 3);">{{ $ticket->pickup ? '(' . $ticket->pickup . ')' : '' }}</strong></td>
            <td>{{ $ticket->passport }}</td>
            <td class="center">{{ $ticket->seat_no }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br><br>

<table class="no-border">
    <tr>
        <td width="60%"></td>
        <td class="center">
            Kupang, {{ \Carbon\Carbon::parse($travel->date)->translatedFormat('d F Y') }}
            <!-- <br><br><br><br><br><br> -->
             <br>
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
