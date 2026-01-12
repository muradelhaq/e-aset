<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Cetak QR - Bulk</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
    /* Use A4 for multi-card pages */
    @page { size: A4 portrait; margin: 6mm; }
    html,body{margin:0;padding:0;font-family:system-ui,Segoe UI,Roboto,Arial;color:#111}
    body{background:#f7fafc;padding:8mm}

    /* page wrapper (one physical sheet) */
    .page {
        width: 210mm;
        min-height: 297mm;
        box-sizing: border-box;
        margin: 0 auto 8mm auto;
        background:#fff;
        padding: 6mm;
    }

    /* grid of stickers per page */
    :root {
        --cols: 2;        /* default columns */
        --rows: 2;        /* default rows */
        --gap: 8mm;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(var(--cols), 1fr);
        grid-auto-rows: 1fr;
        gap: var(--gap);
        height: calc(100% - 0mm);
    }

    /* sticker card inside grid cell */
    .sticker {
        box-sizing: border-box;
        border: 1px solid #111;
        border-radius: 4px;
        padding: 6mm;
        display: flex;
        gap: 8px;
        align-items:flex-start;
        background:#fff;
        overflow: hidden;
    }

    .qr { flex: 0 0 auto; }
    .qr svg, .qr img { width: 35mm; height: 35mm; display:block }

    .info { flex:1; font-size:11px; }
    .info table{width:100%;border-collapse:collapse}
    td{padding:4px 6px;vertical-align:top}
    td.label{width:35%;color:#4b5563;font-weight:600}
    td.sep{width:3%}
    td.value{font-weight:700}
    .code{font-family:monospace;margin-top:6px;font-size:12px;word-break:break-all}

    /* hide controls on print */
    .controls { position:fixed; right:12px; top:12px; z-index:999; display:flex; gap:8px; }
    .controls button{padding:8px 10px;border-radius:6px;border:1px solid #cbd5e1;background:#fff;cursor:pointer;font-size:13px}
    .controls .primary{background:#2563eb;color:#fff;border-color:#2563eb;}
    @media print { body{background:#fff;padding:0} .controls{display:none} .page{margin:0;padding:0} }

    /* ensure page breaks between pages when printing */
    .page { page-break-after: always; }
    .page:last-child { page-break-after: auto; }
</style>
</head>
<body>
@php
    // layout parameters (override via query: cols, rows, copies)
    $cols = max(1, (int) request()->query('cols', 2));
    $rows = max(1, (int) request()->query('rows', 4));
    $copies = max(1, (int) request()->query('copies', 1));

    // build linear list of cards (vehicle + qr) taking copies into account
    $cards = [];
    foreach ($vehicles as $vehicle) {
        $qr = $vehicle->qr_codes->first();
        for ($i = 0; $i < $copies; $i++) {
            $cards[] = ['vehicle' => $vehicle, 'qr' => $qr];
        }
    }

    $perPage = $cols * $rows;
    if ($perPage < 1) $perPage = 4;
    $pages = array_chunk($cards, $perPage);
    $total = count($cards);
@endphp

<div class="controls" aria-hidden="true">
    <div style="display:flex;flex-direction:column;align-items:flex-end;text-align:right">
        <small style="color:#374151">Total sticker: {{ $total }} — Halaman: {{ count($pages) }}</small>
        <div style="height:6px"></div>
        <div style="display:flex;gap:6px">
            <button onclick="window.location.reload()">Refresh</button>
            <button class="primary" id="print-btn" onclick="triggerPrint()">Print Semua</button>
        </div>
    </div>
</div>

@foreach ($pages as $pageIndex => $page)
    <div class="page" style="--cols: {{ $cols }}; --rows: {{ $rows }};">
        <div class="grid" role="group" aria-label="Page {{ $pageIndex + 1 }}">
            @foreach ($page as $card)
                @php $vehicle = $card['vehicle']; $qr = $card['qr']; @endphp
                <div class="sticker" role="region" aria-label="Sticker {{ $vehicle->nopol }}">
                    <div class="qr" aria-hidden="{{ $qr ? 'false' : 'true' }}">
                        {!! $qr ? QrCode::size(150)->margin(1)->generate($qr->kode_qr) : '' !!}
                    </div>

                    <div class="info">
                        <div class="code">{{ $qr->kode_qr ?? '-' }}</div>
                        <table class="w-full" aria-label="Informasi Kendaraan">
                            <tr>
                                <td class="label">No. Seri</td>
                                <td class="sep">:</td>
                                <td class="value">{{ $vehicle->nopol }}</td>
                            </tr>
                            <tr>
                                <td class="label">Jenis</td>
                                <td class="sep">:</td>
                                <td class="value">{{ $vehicle->jenis_kendaraan }}</td>
                            </tr>
                            <tr>
                                <td class="label">Merek</td>
                                <td class="sep">:</td>
                                <td class="value">{{ $vehicle->merk }}</td>
                            </tr>
                            <tr>
                                <td class="label">Kondisi</td>
                                <td class="sep">:</td>
                                <td class="value" style="font-style:italic;text-transform:uppercase;font-weight:600">
                                    {{ $vehicle->keterangan }}
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Pemilik</td>
                                <td class="sep">:</td>
                                <td class="value">{{ $vehicle->pemilik }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach

            {{-- fill empty cells so layout stable --}}
            @php $fill = $perPage - count($page); @endphp
            @for ($i=0;$i<$fill;$i++)
                <div class="sticker" aria-hidden="true" style="visibility:hidden"></div>
            @endfor
        </div>
    </div>
@endforeach

<script>
    function triggerPrint() {
        setTimeout(function () {
            window.print();
            setTimeout(function () { try { window.close(); } catch(e) {} }, 800);
        }, 180);
    }

    // auto print when autoprint present
    window.addEventListener('load', function () {
        const params = new URLSearchParams(window.location.search);
        if (params.has('autoprint')) {
            setTimeout(triggerPrint, 400);
        }
    });
</script>
</body>
</html>
