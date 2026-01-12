<x-filament::card class="print:shadow-none print:border print:border-gray-400 print:p-4">

    <div id="print-area" class="flex flex-col items-center gap-4">

        {{-- QR CODE --}}
        <div class="flex flex-col items-center gap-2">
            <div class="p-2 border border-gray-300 rounded-sm">
                {!! QrCode::size(100)->margin(1)->generate($qr->kode_qr) !!}
            </div>

            <span class="text-[10px] font-mono text-gray-600 uppercase tracking-wider">
                {{ $qr->kode_qr }}
            </span>
        </div>

        {{-- GARIS PEMISAH --}}
        <div class="w-full border-t border-gray-200 print:border-gray-400"></div>

        {{-- INFORMASI --}}
        <div class="w-full text-[11px] leading-tight print:text-black">

            <h3 class="text-sm font-bold text-black text-center uppercase mb-2 tracking-tight">
                Detail Aset Kendaraan
            </h3>

            <table class="w-full">
                <tr>
                    <td class="w-24 font-medium text-gray-600">No. Seri</td>
                    <td class="w-2">:</td>
                    <td class="font-bold">{{ $record->nopol }}</td>
                </tr>
                <tr>
                    <td class="text-gray-600">Jenis</td>
                    <td>:</td>
                    <td>{{ $record->jenis_kendaraan }}</td>
                </tr>
                <tr>
                    <td class="text-gray-600">Merek</td>
                    <td>:</td>
                    <td>{{ $record->merk }}</td>
                </tr>
                <tr>
                    <td class="text-gray-600">Kondisi</td>
                    <td>:</td>
                    <td class="uppercase italic font-semibold">
                        {{ $record->keterangan }}
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-600">Pemilik</td>
                    <td>:</td>
                    <td>{{ $record->pemilik }}</td>
                </tr>
            </table>

        </div>

    </div>

</x-filament::card>

<style>
    @media print {
    .print\:shadow-none {
        break-inside: avoid;
    }
}
</style>
