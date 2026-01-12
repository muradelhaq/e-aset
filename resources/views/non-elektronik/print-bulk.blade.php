<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Cetak QR - Non Elektronik (Bulk)</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
@page { size: A4 portrait; margin: 6mm; }
html,body{margin:0;padding:0;font-family:system-ui,Segoe UI,Roboto,Arial;color:#111}
body{background:#f7fafc;padding:8mm}

.page{
    width:210mm;min-height:297mm;
    box-sizing:border-box;
    margin:0 auto 8mm auto;
    background:#fff;padding:6mm
}

:root{--cols:2;--rows:4;--gap:8mm}
.grid{
    display:grid;
    grid-template-columns:repeat(var(--cols),1fr);
    gap:var(--gap);
    height:100%
}

.sticker{
    border:1px solid #111;border-radius:4px;
    padding:6mm;display:flex;gap:8px;
    align-items:flex-start;background:#fff
}

.qr svg{width:35mm;height:35mm}
.info{font-size:11px;flex:1}
.info table{width:100%;border-collapse:collapse}
td{padding:3px 6px;vertical-align:top}
td.label{width:35%;color:#4b5563;font-weight:600}
td.sep{width:3%}
td.value{font-weight:700}
.code{font-family:monospace;font-size:12px;margin-bottom:6px}

.controls{
    position:fixed;right:12px;top:12px;
    display:flex;gap:8px;z-index:999
}
.controls button{
    padding:8px 10px;border-radius:6px;
    border:1px solid #cbd5e1;background:#fff;cursor:pointer
}
.controls .primary{background:#2563eb;color:#fff;border-color:#2563eb}

@media print{
    body{background:#fff;padding:0}
    .controls{display:none}
    .page{margin:0;padding:0}
}
.page{page-break-after:always}
.page:last-child{page-break-after:auto}
</style>
</head>
<body>

@php
$cols   = max(1,(int)request('cols',2));
$rows   = max(1,(int)request('rows',4));
$copies = max(1,(int)request('copies',1));

$cards = [];
foreach ($things as $item) {
    $qr = $item->qrCode;
    for ($i=0;$i<$copies;$i++) {
        $cards[] = compact('item','qr');
    }
}

$perPage = $cols * $rows;
$pages   = array_chunk($cards,$perPage);
$total   = count($cards);
@endphp

<div class="controls">
    <div>
        <small>Total Stiker: {{ $total }} | Halaman: {{ count($pages) }}</small><br><br>
        <button onclick="location.reload()">Refresh</button>
        <button class="primary" onclick="printAll()">Print Semua</button>
    </div>
</div>

@foreach($pages as $page)
<div class="page" style="--cols:{{ $cols }};--rows:{{ $rows }}">
    <div class="grid">
        @foreach($page as $card)
        @php $item=$card['item']; $qr=$card['qr']; @endphp
        <div class="sticker">
            <div class="qr">
                {!! $qr ? QrCode::size(140)->margin(1)->generate(route('non-elektronik.show',$qr->kode_qr)) : '' !!}
            </div>

            <div class="info">
                <div class="code">{{ $qr->kode_qr ?? '-' }}</div>
                <table>
                    <tr>
                        <td class="label">Nama Barang</td>
                        <td class="sep">:</td>
                        <td class="value">{{ $item->nama_barang }}</td>
                    </tr>
                    <tr>
                        <td class="label">Jenis</td>
                        <td class="sep">:</td>
                        <td class="value">{{ $item->jenis_barang }}</td>
                    </tr>
                    <tr>
                        <td class="label">Merk</td>
                        <td class="sep">:</td>
                        <td class="value">{{ $item->merk ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Kondisi</td>
                        <td class="sep">:</td>
                        <td class="value" style="text-transform:uppercase">
                            {{ $item->kondisi }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Pemilik</td>
                        <td class="sep">:</td>
                        <td class="value">{{ $item->pemilik }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach

        {{-- isi kosong agar grid rapi --}}
        @for($i=0;$i<($perPage-count($page));$i++)
            <div class="sticker" style="visibility:hidden"></div>
        @endfor
    </div>
</div>
@endforeach

<script>
function printAll(){
    setTimeout(()=>{
        window.print();
        setTimeout(()=>{window.close()},800)
    },200)
}

window.onload=function(){
    if(new URLSearchParams(location.search).has('autoprint')){
        setTimeout(printAll,400)
    }
}
</script>
</body>
</html>
