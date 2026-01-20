<!doctype html>
<html>
<body style="font-family:Arial">

<h2>🚗 Notifikasi Pajak Kendaraan</h2>

@if($akanExpired->count())
    <h3 style="color:#d97706">⚠️ Akan Jatuh Tempo</h3>
    <ul>
        @foreach($akanExpired as $k)
            <li>{{ $k->nama_kendaraan }} — {{ $k->tgl_pajak->format('d M Y') }}</li>
        @endforeach
    </ul>
@endif

@if($sudahExpired->count())
    <h3 style="color:#dc2626">❌ Sudah Expired</h3>
    <ul>
        @foreach($sudahExpired as $k)
            <li>{{ $k->nama_kendaraan }} — {{ $k->tgl_pajak->format('d M Y') }}</li>
        @endforeach
    </ul>
@endif

<p>Silakan segera lakukan perpanjangan pajak.</p>

</body>
</html>
