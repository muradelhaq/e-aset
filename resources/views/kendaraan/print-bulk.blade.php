<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Cetak QR - Kendaraan (Bulk)</title>
<meta name="viewport" content="width=device-width,initial-scale=1">

<style>
@page { size: A4 portrait; margin: 6mm; }

html,body{
    margin:0;padding:0;
    font-family:system-ui,Segoe UI,Roboto,Arial;
    color:#111
}
body{background:#f7fafc;padding:8mm}

/* ===== PAGE ===== */
.page{
    width:210mm;
    min-height:297mm;
    box-sizing:border-box;
    margin:0 auto 8mm auto;
    background:#fff;
    padding:6mm;
}

/* ===== GRID ===== */
:root{--cols:2;--rows:4;--gap:8mm}

.grid{
    display:grid;
    grid-template-columns:repeat(var(--cols),1fr);
    gap:var(--gap);
}

/* ===== STICKER ===== */
.sticker{
    border:1px solid #111;
    border-radius:4px;
    padding:5mm;
    display:flex;
    flex-direction:column;
    background:#fff;
}

/* ===== HEADER / KOP ===== */
.header{
    display:flex;
    align-items:center;
    gap:6px;
    padding-bottom:4px;
    margin-bottom:6px;
    border-bottom:1px solid #111;
}
.header img{width:20px;height:auto}
.header-text{line-height:1.2}
.header-text .title{
    font-size:9px;
    font-weight:700;
    text-transform:uppercase;
}
.header-text .subtitle{
    font-size:8px;
    color:#4b5563;
}

/* ===== BODY ===== */
.body{
    display:flex;
    gap:8px;
    align-items:flex-start;
}

.qr svg,.qr img{
    width:32mm;
    height:32mm;
}

.info{
    font-size:10px;
    flex:1;
}

.code{
    font-family:monospace;
    font-size:10px;
    margin-bottom:4px;
}

/* ===== INFO LIST ===== */
.item{margin-bottom:2px}
.item span{
    display:inline-block;
    width:72px;
    font-weight:600;
    color:#4b5563;
}
.value{font-weight:700}
.upper{text-transform:uppercase}

/* ===== CONTROLS ===== */
.controls{
    position:fixed;
    right:12px;
    top:12px;
    z-index:999;
}
.controls button{
    padding:8px 10px;
    border-radius:6px;
    border:1px solid #cbd5e1;
    background:#fff;
    cursor:pointer;
}
.controls .primary{
    background:#2563eb;
    color:#fff;
    border-color:#2563eb;
}

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

$cards=[];
foreach($vehicles as $vehicle){
    $qr=$vehicle->qr_codes->first();
    for($i=0;$i<$copies;$i++){
        $cards[]=compact('vehicle','qr');
    }
}

$perPage=$cols*$rows;
$pages=array_chunk($cards,$perPage);
$total=count($cards);
@endphp

<div class="controls">
    <small>Total: {{ $total }} stiker | {{ count($pages) }} halaman</small><br><br>
    <button onclick="location.reload()">Refresh</button>
    <button class="primary" onclick="printAll()">Print Semua</button>
</div>

@foreach($pages as $page)
<div class="page" style="--cols:{{ $cols }};--rows:{{ $rows }}">
    <div class="grid">

        @foreach($page as $card)
        @php $vehicle=$card['vehicle']; $qr=$card['qr']; @endphp

        <div class="sticker">

            <!-- HEADER -->
            <div class="header">
                <img src="{{ asset('storage/images/logo.png') }}">
                <div class="header-text">
                    <div class="title">Pemerintah Kabupaten Tasikmalaya</div>
                    <div class="subtitle">SIM Aset Daerah</div>
                </div>
            </div>

            <!-- BODY -->
            <div class="body">
                <div class="qr">
                    {!! $qr ? QrCode::size(140)->margin(1)->generate(route('kendaraan.show',$qr->kode_qr)) : '' !!}
                </div>

                <div class="info">
                    <div class="code">{{ $qr->kode_qr ?? '-' }}</div>

                    <div class="item">
                        <span>No. Polisi</span>
                        <span class="value">{{ $vehicle->nopol }}</span>
                    </div>

                    <div class="item">
                        <span>Jenis</span>
                        <span class="value">{{ $vehicle->jenis_kendaraan }}</span>
                    </div>

                    <div class="item">
                        <span>Merek</span>
                        <span class="value">{{ $vehicle->merk }}</span>
                    </div>

                    <div class="item">
                        <span>Kondisi</span>
                        <span class="value upper">{{ $vehicle->keterangan }}</span>
                    </div>

                    <div class="item">
                        <span>Pemilik</span>
                        <span class="value">{{ $vehicle->pemilik }}</span>
                    </div>
                </div>
            </div>

        </div>
        @endforeach

        {{-- pengisi kosong --}}
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
        setTimeout(()=>window.close(),800);
    },200);
}

window.onload=function(){
    if(new URLSearchParams(location.search).has('autoprint')){
        setTimeout(printAll,400);
    }
}
</script>
</body>
</html>
