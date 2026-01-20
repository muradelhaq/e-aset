<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Bagian Tabel Pemilihan --}}
        <div
            class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5
                   dark:bg-gray-900 dark:ring-white/10">
            {{ $this->table }}
        </div>

        {{-- Bagian Preview QR Code --}}
        @if (count($selectedRecords) > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 print:block">

                @foreach(\App\Models\Bangunan::whereIn('id', $selectedRecords)->get() as $item)
                    <div
                        class="p-4 bg-white dark:bg-gray-800 border border-gray-300
                               rounded-xl text-center shadow-sm break-inside-avoid
                               print:border-black print:shadow-none">

                        {{-- QR Code --}}
                        <div class="flex justify-center mb-3">
                            {!! QrCode::size(150)->generate(
                                url('/bangunan/' . optional($item->qrBangunans()->latest()->first())->kode_qr)
                            ) !!}
                        </div>

                        {{-- Info Bangunan --}}
                        <p class="text-sm font-bold text-gray-900 dark:text-white">
                            {{ $item->nama_bangunan ?? 'Bangunan' }}
                        </p>

                        <p class="text-[11px] text-gray-600 dark:text-gray-400">
                            {{ $item->lokasi ?? '-' }}
                        </p>

                        <p class="text-[10px] mt-1 font-mono text-gray-500">
                            {{ optional($item->qrBangunans()->latest()->first())->kode_qr }}
                        </p>
                    </div>
                @endforeach

            </div>

            {{-- Tombol Cetak --}}
            <x-filament::button
                onclick="window.print()"
                icon="heroicon-m-printer"
                color="success"
                class="mt-4 print:hidden">
                Cetak QR Bangunan
            </x-filament::button>
        @endif

    </div>
</x-filament-panels::page>
