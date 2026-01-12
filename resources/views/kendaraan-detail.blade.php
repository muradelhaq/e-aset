<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kendaraan | {{ $kendaraan->nopol }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-950 py-10 px-4">

<div class="max-w-3xl mx-auto">

    {{-- Tombol Kembali --}}
    <a href="/" class="inline-flex items-center text-sm text-gray-500 hover:text-primary-600 mb-6 transition">
        ← Kembali ke Beranda
    </a>

    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-white/5">

        {{-- Foto Kendaraan --}}
        <div class="relative h-64 md:h-96 bg-gray-200 dark:bg-gray-800">
            @if($kendaraan->foto)
                <img
                    src="{{ asset('storage/'.$kendaraan->foto) }}"
                    alt="Foto {{ $kendaraan->nopol }}"
                    class="w-full h-full object-cover"
                >
            @else
                <div class="flex items-center justify-center h-full text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 13l2-2m0 0l7-7 7 7m-9 2v6m4-6v6"/>
                    </svg>
                </div>
            @endif

            {{-- Badge Status Pajak --}}
            @php
                $isExpired = $kendaraan->tgl_pajak
                    ? \Carbon\Carbon::parse($kendaraan->tgl_pajak)->isPast()
                    : false;
            @endphp

            <div class="absolute top-4 right-4">
                <span class="px-4 py-2 rounded-full text-xs font-bold shadow-lg
                    {{ $isExpired ? 'bg-red-600 text-white' : 'bg-green-600 text-white' }}">
                    {{ $isExpired ? 'PAJAK MATI' : 'PAJAK AKTIF' }}
                </span>
            </div>
        </div>

        {{-- Konten --}}
        <div class="p-8">

            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">
                {{ $kendaraan->nama_kendaraan ?? $kendaraan->jenis_kendaraan }}
            </h1>

            <p class="text-primary-600 font-mono text-xl mb-6 tracking-widest">
                {{ $kendaraan->nopol }}
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-100 dark:border-white/5 pt-6">

                <div>
                    <p class="text-xs uppercase text-gray-500 font-bold">Jenis Kendaraan</p>
                    <p class="text-gray-900 dark:text-gray-200">
                        {{ $kendaraan->jenis_kendaraan }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-500 font-bold">Merk / Tipe</p>
                    <p class="text-gray-900 dark:text-gray-200">
                        {{ $kendaraan->merk }} {{ $kendaraan->tipe }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-500 font-bold">Tahun</p>
                    <p class="text-gray-900 dark:text-gray-200">
                        {{ $kendaraan->tahun ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-500 font-bold">Pemilik</p>
                    <p class="text-gray-900 dark:text-gray-200">
                        {{ $kendaraan->pemilik ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-500 font-bold">Masa Berlaku Pajak</p>
                    <p class="text-gray-900 dark:text-gray-200">
                        {{ $kendaraan->tgl_pajak
                            ? \Carbon\Carbon::parse($kendaraan->tgl_pajak)->translatedFormat('d F Y')
                            : '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-500 font-bold">Kondisi</p>
                    <p class="text-gray-900 dark:text-gray-200 italic font-medium">
                        {{ $kendaraan->keterangan ?? '-' }}
                    </p>
                </div>

            </div>
        </div>

        {{-- Footer --}}
        <div class="bg-gray-50 dark:bg-gray-800/50 p-6 text-center">
            <p class="text-[10px] text-gray-400">
                QR Code: {{ $qr->kode_qr }} •
                Dicetak {{ now()->format('d/m/Y H:i') }}
            </p>
        </div>

    </div>
</div>

</body>
</html>
