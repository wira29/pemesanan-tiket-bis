<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berhasil - Modernize</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #5d87ff;
            --success-color: #13deb9;
            --warning-color: #ffae1f;
            --danger-color: #fa896b;
            --dark-color: #2a3547;
            --light-color: #ecf2ff;
            --body-color: #f6f9fc;
        }

        body {
            background: var(--body-color);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-container {
            max-width: 600px;
            width: 100%;
            animation: fadeInUp 0.6s ease;
        }

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

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .success-icon-wrapper {
            background: linear-gradient(135deg, var(--success-color) 0%, #06b899 100%);
            padding: 40px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .success-icon-wrapper::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -150px;
            right: -150px;
        }

        .success-icon-wrapper::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
            animation: scaleIn 0.5s ease 0.3s both;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .success-icon i {
            font-size: 3rem;
            color: var(--success-color);
            animation: checkmark 0.5s ease 0.8s both;
        }

        @keyframes checkmark {
            0% {
                transform: scale(0) rotate(0deg);
            }
            50% {
                transform: scale(1.2) rotate(180deg);
            }
            100% {
                transform: scale(1) rotate(360deg);
            }
        }

        .success-title {
            color: white;
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .success-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            margin-top: 10px;
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 30px;
        }

        .transaction-details {
            background: var(--light-color);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(93, 135, 255, 0.1);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #5a6a85;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .detail-value {
            color: var(--dark-color);
            font-weight: 600;
            font-size: 0.95rem;
            text-align: right;
        }

        .total-row {
            background: white;
            border-radius: 8px;
            padding: 15px 20px;
            margin: 20px 0;
            border: 2px solid var(--primary-color);
        }

        .total-row .detail-label {
            color: var(--dark-color);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .total-row .detail-value {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.3rem;
        }

        .btn-modernize {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            font-size: 0.95rem;
        }

        .btn-primary-modernize {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary-modernize:hover {
            background: #4570ea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(93, 135, 255, 0.3);
        }

        .btn-outline-modernize {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-modernize:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .action-buttons .btn {
            flex: 1;
        }

        .info-badge {
            display: inline-block;
            padding: 6px 15px;
            background: rgba(93, 135, 255, 0.1);
            color: var(--primary-color);
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(93, 135, 255, 0.2), transparent);
            margin: 20px 0;
        }

        @media (max-width: 576px) {
            .action-buttons {
                flex-direction: column;
            }

            .success-icon {
                width: 80px;
                height: 80px;
            }

            .success-icon i {
                font-size: 2.5rem;
            }

            .success-title {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 20px;
            }

            .total-row .detail-value {
                font-size: 1.1rem;
            }
        }

        /* Additional animation for confetti effect */
        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }

        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background: var(--success-color);
            animation: confetti-fall 3s linear;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="card">
            <!-- Success Header -->
            <div class="success-icon-wrapper">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h1 class="success-title">Transaksi Berhasil!</h1>
                <p class="success-subtitle">Transaksi Anda telah diproses dengan sukses</p>
            </div>

            <!-- Transaction Details -->
            <div class="card-body">
                <div class="text-center">
                    <span class="info-badge">
                        <i class="fas fa-info-circle"></i> ID Transaksi: {{ $invoice->invoice_code }}
                    </span>
                </div>

                <div class="transaction-details">
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-calendar text-primary"></i> Tanggal
                        </span>
                        <span class="detail-value">{{ $invoice->travel->date->format('d F Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-ticket text-primary"></i> No Kursi
                        </span>
                        <span class="detail-value">
                            @foreach ($invoice->tickets as $ticket)
                                {{ $ticket->ticket->seat_no . ";" }}
                            @endforeach
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-user text-primary"></i> Nama Pembeli
                        </span>
                        <span class="detail-value">{{ $invoice->tickets[0]->ticket->name }}</span>
                    </div>
                </div>

                <div class="total-row">
                    <div class="detail-row">
                        <span class="detail-label">Total Pembayaran</span>
                        <span class="detail-value">Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('landing.printInvoice', $invoice->invoice_code) }}" class="btn btn-outline-modernize" target="_blank">
                        <i class="fas fa-download"></i> Unduh Bukti
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-primary-modernize" >
                        <i class="fas fa-home"></i> Kembali
                    </a>
                </div>

                <!-- Footer Note -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        Terima kasih telah mempercayai kami.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Confetti effect on page load
        function createConfetti() {
            const colors = ['#5d87ff', '#13deb9', '#ffae1f', '#fa896b'];
            const confettiCount = 50;

            for (let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDelay = Math.random() * 2 + 's';
                confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                confetti.style.position = 'fixed';
                confetti.style.bottom = '0';
                document.body.appendChild(confetti);

                setTimeout(() => confetti.remove(), 5000);
            }
        }

        // Call confetti on load
        window.addEventListener('load', createConfetti);
    </script>
</body>
</html>