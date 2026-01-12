<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aset | {{ $nonElektronik->nama_barang }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-950 py-10 px-4">
<div class="max-w-3xl mx-auto">

    <a href="/" class="inline-flex items-center text-sm text-gray-500 hover:text-primary-600 mb-6 transition">
        ← Kembali ke Beranda
    </a>

    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-white/5">

        {{-- Foto Barang --}}
        <div class="relative h-64 md:h-96 bg-gray-200 dark:bg-gray-800">
            @if($nonElektronik->foto)
                <img src="{{ asset('storage/'.$nonElektronik->foto) }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6"/>
                    </svg>
                </div>
            @endif

            <div class="absolute top-4 right-4">
                <span class="px-4 py-2 rounded-full text-xs font-bold shadow-lg bg-gray-700 text-white">
                    {{ strtoupper($nonElektronik->kondisi) }}
                </span>
            </div>
        </div>

        <div class="p-8">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">
                {{ $nonElektronik->nama_barang }}
            </h1>

            <p class="text-primary-600 font-mono text-lg mb-6">
                Kode Aset: {{ $nonElektronik->kode_barang ?? '-' }}
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t pt-6 border-gray-100 dark:border-white/5">

                <div>
                    <p class="text-xs uppercase text-gray-500 font-bold">Jenis Barang</p>
                    <p class="text-gray-900 dark:text-gray-200">
                        {{ $nonElektronik->jenis_barang }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-500 font-bold">Tanggal Perolehan</p>
                    <p class="text-gray-900 dark:text-gray-200">
                        {{ optional($nonElektronik->tgl_perolehan)->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-500 font-bold">Pemilik</p>
                    <p class="text-gray-900 dark:text-gray-200">
                        {{ $nonElektronik->pemilik ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-500 font-bold">Harga</p>
                    <p class="text-gray-900 dark:text-gray-200">
                        Rp {{ number_format($nonElektronik->harga ?? 0, 0, ',', '.') }}
                    </p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-xs uppercase text-gray-500 font-bold">Keterangan</p>
                    <p class="text-gray-900 dark:text-gray-200">
                        {{ $nonElektronik->keterangan ?? 'Tidak ada keterangan' }}
                    </p>
                </div>

            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-800/50 p-6 text-center">
            <p class="text-[10px] text-gray-400">
                QR Code: {{ $qr->kode_qr }} • {{ now()->format('d/m/Y H:i') }}
            </p>
        </div>

    </div>
</div>
</body>
</html>
