<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak QR - {{ $qr->kode_qr }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <style>
        /* ===== PAGE SETUP (A6 STICKER) ===== */
        @page {
            size: A6 portrait;
            margin: 3mm;
        }

        html, body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            color: #111;
        }

        .wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f7fafc;
            padding: 12px;
        }

        /* ===== CARD ===== */
        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            max-width: 900px;
            box-sizing: border-box;
        }

        /* ===== HEADER / KOP ===== */
        .header {
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 6px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .header img {
            width: 28px;
            height: auto;
        }

        .header-text {
            line-height: 1.2;
        }

        .header-text .title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .header-text .subtitle {
            font-size: 10px;
            color: #4b5563;
        }

        /* ===== BODY ===== */
        .body {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .qr-box {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info {
            flex: 1;
            min-width: 0;
        }

        .code {
            font-family: monospace;
            font-size: 12px;
            margin-bottom: 6px;
        }

        /* ===== INFO LIST (Bukan tabel besar) ===== */
        .item {
            font-size: 12px;
            margin-bottom: 3px;
        }

        .item span {
            font-weight: 600;
            color: #4b5563;
            display: inline-block;
            width: 80px;
        }

        .value {
            font-weight: 700;
        }

        .italic {
            font-style: italic;
            text-transform: uppercase;
        }

        /* ===== ACTION BUTTON ===== */
        .controls {
            margin-top: 8px;
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        button {
            padding: 6px 10px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            background: #fff;
            font-size: 12px;
            cursor: pointer;
        }

        button#print-btn {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 640px) {
            .body {
                flex-direction: column;
                text-align: center;
            }

            .controls {
                justify-content: center;
            }

            .item span {
                width: auto;
                display: block;
            }
        }

        /* ===== PRINT MODE ===== */
        @media print {
            html, body {
                width: 105mm;
                height: 148mm;
            }

            .wrap {
                background: #fff;
                padding: 0;
            }

            .card {
                width: 95mm;
                padding: 4mm;
                border: 1px solid #111;
                border-radius: 4px;
            }

            .header {
                border-bottom: 1px solid #111;
                margin-bottom: 6px;
            }

            .header img {
                width: 24px;
            }

            .header-text .title {
                font-size: 10px;
            }

            .header-text .subtitle {
                font-size: 9px;
            }

            .qr-box svg,
            .qr-box img {
                width: 40mm !important;
                height: auto !important;
            }

            .controls {
                display: none;
            }
        }
    </style>
</head>

<body>
<div class="wrap">
    <div class="card">

        <!-- HEADER -->
        <div class="header">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo Kabupaten Tasikmalaya">
            <div class="header-text">
                <div class="title">Pemerintah Kabupaten Tasikmalaya</div>
                <div class="subtitle">Sistem Informasi Manajemen Aset Daerah</div>
            </div>
        </div>

        <!-- BODY -->
        <div class="body">

            <!-- QR -->
            <div class="qr-box">
                r{!! QrCode::size(250)->margin(1)->generate(route('non-elektronik.show',$qr->kode_qr))!!}
            </div>

            <!-- INFO -->
            <div class="info">
                <div class="code">{{ $qr->kode_qr }}</div>

                <div class="item">
                    <span>Nama</span>
                    <span class="value">{{ $record->nama_barang }}</span>
                </div>

                <div class="item">
                    <span>Jenis</span>
                    <span class="value">{{ $record->jenis_barang }}</span>
                </div>

                <div class="item">
                    <span>Merek</span>
                    <span class="value">{{ $record->merk }}</span>
                </div>

                <div class="item">
                    <span>Kondisi</span>
                    <span class="value italic">{{ $record->keterangan }}</span>
                </div>

                <div class="item">
                    <span>Pemilik</span>
                    <span class="value">{{ $record->pemilik }}</span>
                </div>

                <div class="controls">
                    <button onclick="copyQRCode(event)">Salin</button>
                    <button id="print-btn" onclick="window.print()">Print</button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function copyQRCode(evt) {
        const text = "{{ $qr->kode_qr }}";
        navigator.clipboard?.writeText(text).then(() => {
            const btn = evt.currentTarget;
            const original = btn.innerText;
            btn.innerText = 'Tersalin';
            setTimeout(() => btn.innerText = original, 1200);
        });
    }

    window.addEventListener('load', function () {
        if (new URLSearchParams(window.location.search).has('autoprint')) {
            setTimeout(() => window.print(), 200);
        }
    });
</script>
</body>
</html>
