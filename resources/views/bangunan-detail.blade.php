<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Bangunan | {{ $bangunan->nama_bangunan }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-950 py-10 px-4">

<div class="max-w-3xl mx-auto">

    {{-- Tombol Kembali --}}
    <a href="/" class="inline-flex items-center text-sm text-gray-500 hover:text-primary-600 mb-6 transition">
        ← Kembali ke Beranda
    </a>

    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-white/5">

        {{-- Foto Bangunan --}}
        <div class="relative h-64 md:h-96 bg-gray-200 dark:bg-gray-800">
            @if($bangunan->foto)
                <img
                    src="{{ asset('storage/'.$bangunan->foto) }}"
                    alt="Foto {{ $bangunan->nama_bangunan }}"
                    class="w-full h-full object-cover"
                >
            @else
                <div class="flex items-center justify-center h-full text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 10l9-7 9 7v10a1 1 0 01-1 1h-5V14H9v7H4a1 1 0 01-1-1V10z"/>
                    </svg>
                </div>
            @endif
        </div>

        {{-- Konten --}}
        <div class="p-8">

            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">
                {{ $bangunan->nama_bangunan }}
            </h1>

            <p class="text-primary-600 font-mono text-xl mb-6 tracking-widest">
                {{ $bangunan->kode_bangunan ?? '-' }}
            </p>

{{-- Informasi Detail Bangunan --}}
<div class="mt-6 space-y-4 border-t border-gray-100 dark:border-white/5 pt-6">

    <div>
        <p class="text-xs uppercase text-gray-500 font-bold">Kode Bangunan</p>
        <p class="text-gray-900 dark:text-gray-200 font-mono tracking-wide">
            {{ $bangunan->kode_bangunan ?? '-' }}
        </p>
    </div>

    <div>
        <p class="text-xs uppercase text-gray-500 font-bold">Nama Bangunan</p>
        <p class="text-gray-900 dark:text-gray-200">
            {{ $bangunan->nama_bangunan }}
        </p>
    </div>

    <div>
        <p class="text-xs uppercase text-gray-500 font-bold">Jenis Bangunan</p>
        <p class="text-gray-900 dark:text-gray-200">
            {{ $bangunan->jenis_bangunan ?? '-' }}
        </p>
    </div>

    <div>
        <p class="text-xs uppercase text-gray-500 font-bold">Tahun Bangun</p>
        <p class="text-gray-900 dark:text-gray-200">
            {{ $bangunan->tahun_bangun ?? '-' }}
        </p>
    </div>

    <div>
        <p class="text-xs uppercase text-gray-500 font-bold">Alamat</p>
        <p class="text-gray-900 dark:text-gray-200 leading-relaxed">
            {{ $bangunan->alamat ?? '-' }}
        </p>
    </div>

    <div>
        <p class="text-xs uppercase text-gray-500 font-bold">Kondisi</p>
        <p class="text-gray-900 dark:text-gray-200 italic font-semibold uppercase">
            {{ $bangunan->kondisi ?? '-' }}
        </p>
    </div>

    <div>
        <p class="text-xs uppercase text-gray-500 font-bold">Pemilik</p>
        <p class="text-gray-900 dark:text-gray-200">
            {{ $bangunan->pemilik ?? '-' }}
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
