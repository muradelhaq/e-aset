<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Bagian Tabel Pemilihan --}}
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            {{ $this->table }}
        </div>

        {{-- Bagian Preview QR Code --}}
        @if(count($selectedRecords) > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 print:block">
                @foreach(\App\Models\Kendaraan::whereIn('id', $selectedRecords)->get() as $item)
                    <div class="p-4 bg-white dark:bg-gray-800 border rounded-xl text-center shadow-sm break-inside-avoid">
                        <div class="flex justify-center mb-2">
                            {!! QrCode::size(150)->generate(url('/kendaraan/' . $item->id)) !!}
                        </div>
                        <p class="text-sm font-bold dark:text-white">{{ $item->nopol }}</p>
                        <p class="text-[10px] text-gray-500">{{ $item->jenis_kendaraan }}</p>
                    </div>
                @endforeach
            </div>

            <x-filament::button
                onclick="window.print()"
                icon="heroicon-m-printer"
                class="mt-4">
                Cetak QR Code
            </x-filament::button>
        @endif
    </div>
</x-filament-panels::page>
