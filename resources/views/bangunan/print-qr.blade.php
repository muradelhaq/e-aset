<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Cetak QR - {{ $qr->kode_qr }}</title>
<meta name="viewport" content="width=device-width,initial-scale=1">

<style>
/* ===== PAGE A6 ===== */
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
    background: #fff;
}

/* ===== CARD ===== */
.card {
    width: 95mm;
    border: 1px solid #111;
    border-radius: 6px;
    padding: 4mm;
    box-sizing: border-box;
    background: #fff;
}

/* ===== KOP ===== */
.header {
    display: flex;
    align-items: center;
    gap: 6px;
    padding-bottom: 4px;
    margin-bottom: 6px;
    border-bottom: 1px solid #111;
}

.header img {
    width: 20px;
    height: auto;
}

.header-text {
    line-height: 1.2;
}

.header-text .title {
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
}

.header-text .subtitle {
    font-size: 8px;
    color: #4b5563;
}

/* ===== BODY ===== */
.body {
    display: flex;
    align-items: center;
    gap: 8px;
}

.qr-box svg,
.qr-box img {
    width: 40mm !important;
    height: auto !important;
    display: block;
}

.info {
    flex: 1;
    font-size: 10px;
}

.code {
    font-family: monospace;
    font-size: 10px;
    margin-bottom: 4px;
}

/* ===== INFO LIST ===== */
.item {
    margin-bottom: 2px;
}

.item .label {
    display: inline-block;
    width: 38%;
    font-weight: 600;
    color: #4b5563;
}

.item .value {
    font-weight: 700;
}

.upper {
    text-transform: uppercase;
    font-style: italic;
}

/* ===== ACTION ===== */
.controls {
    margin-top: 6px;
    display: flex;
    justify-content: flex-end;
    gap: 6px;
}

button {
    padding: 5px 8px;
    font-size: 11px;
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    background: #fff;
    cursor: pointer;
}

#print-btn {
    background: #2563eb;
    color: #fff;
    border-color: #2563eb;
}

/* ===== PRINT ===== */
@media print {
    .controls {
        display: none;
    }
}
</style>
</head>

<body>
<div class="wrap">
    <div class="card">

        <!-- KOP -->
        <div class="header">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo Kabupaten Tasikmalaya">
            <div class="header-text">
                <div class="title">Pemerintah Kabupaten Tasikmalaya</div>
                <div class="subtitle">Sistem Informasi Manajemen Aset</div>
            </div>
        </div>

        <!-- BODY -->
        <div class="body">

            <!-- QR -->
            <div class="qr-box">
                {!! QrCode::size(250)->margin(1)->generate(route('bangunan.show',$qr->kode_qr)) !!}
            </div>

            <!-- INFO -->
            <div class="info">
                <div class="code">{{ $qr->kode_qr }}</div>

                <div class="item">
                    <span class="label">Kode</span>
                    <span class="value">{{ $record->kode_bangunan }}</span>
                </div>

                <div class="item">
                    <span class="label">Nama</span>
                    <span class="value">{{ $record->nama_bangunan }}</span>
                </div>

                <div class="item">
                    <span class="label">Jenis</span>
                    <span class="value">{{ $record->jenis_bangunan }}</span>
                </div>

                <div class="item">
                    <span class="label">Tahun</span>
                    <span class="value">{{ $record->tahun_bangun ?? '-' }}</span>
                </div>

                <div class="item">
                    <span class="label">Alamat</span>
                    <span class="value">{{ $record->alamat }}</span>
                </div>

                <div class="item">
                    <span class="label">Kondisi</span>
                    <span class="value upper">{{ $record->kondisi }}</span>
                </div>

                <div class="item">
                    <span class="label">Pemilik</span>
                    <span class="value">{{ $record->pemilik }}</span>
                </div>
            </div>
        </div>

        <!-- ACTION -->
        <div class="controls">
            <button onclick="copyQRCode()">Salin</button>
            <button id="print-btn" onclick="window.print()">Print</button>
        </div>

    </div>
</div>

<script>
function copyQRCode() {
    navigator.clipboard?.writeText("{{ $qr->kode_qr }}");
}

window.addEventListener('load', () => {
    if (new URLSearchParams(location.search).has('autoprint')) {
        setTimeout(() => {
            window.print();
            setTimeout(() => window.close(), 600);
        }, 300);
    }
});
</script>
</body>
</html>
