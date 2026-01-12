<div class="space-y-6">
    {{-- Header Dashboard --}}
    {{-- Batas Atas Utama --}}
    <div style="border-top: 1px solid rgba(156, 163, 175, 0.2); margin-bottom: 2rem; padding-top: 1.5rem;">
    <header style="margin-bottom: 1.5rem;">
        <h1 style="font-size: 1.5rem; font-weight: 700; letter-spacing: -0.025em;" class="text-gray-950 dark:text-white">
            Dashboard Statistik Aset
        </h1>
        <p style="font-size: 0.875rem; color: #6b7280;" class="dark:text-gray-400">
            Ringkasan jumlah data aset yang terdaftar dalam sistem e-Aset.
        </p>
    </header>

    {{-- Container Grid Statistik --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">

        {{-- Card Kendaraan --}}
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10" style="padding: 0.75rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="padding: 0.5rem; border-radius: 0.5rem; background-color: rgba(37, 99, 235, 0.1);">
                    <x-heroicon-o-truck style="width: 1.5rem; height: 1.5rem;" class="text-primary-600 dark:text-primary-400" />
                </div>
                <div>
                    <p style="font-size: 0.75rem; margin: 0;" class="text-gray-500 dark:text-gray-400">Data Kendaraan</p>
                    <p style="font-size: 1.25rem; font-weight: 700; margin: 0;" class="text-gray-950 dark:text-white">{{ $totalKendaraan }}</p>
                </div>
            </div>
        </div>

        {{-- Card Tanah --}}
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10" style="padding: 0.75rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="padding: 0.5rem; border-radius: 0.5rem; background-color: rgba(22, 163, 74, 0.1);">
                    <x-heroicon-o-map style="width: 1.5rem; height: 1.5rem;" class="text-success-600 dark:text-success-400" />
                </div>
                <div>
                    <p style="font-size: 0.75rem; margin: 0;" class="text-gray-500 dark:text-gray-400">Data Tanah</p>
                    <p style="font-size: 1.25rem; font-weight: 700; margin: 0;" class="text-gray-950 dark:text-white">{{ $totalTanah }}</p>
                </div>
            </div>
        </div>

        {{-- Card Bangunan --}}
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10" style="padding: 0.75rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="padding: 0.5rem; border-radius: 0.5rem; background-color: rgba(202, 138, 4, 0.1);">
                    <x-heroicon-o-home-modern style="width: 1.5rem; height: 1.5rem;" class="text-warning-600 dark:text-warning-400" />
                </div>
                <div>
                    <p style="font-size: 0.75rem; margin: 0;" class="text-gray-500 dark:text-gray-400">Data Bangunan</p>
                    <p style="font-size: 1.25rem; font-weight: 700; margin: 0;" class="text-gray-950 dark:text-white">{{ $totalBangunan }}</p>
                </div>
            </div>
        </div>

        {{-- Card Elektronik --}}
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10" style="padding: 0.75rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="padding: 0.5rem; border-radius: 0.5rem; background-color: rgba(8, 145, 178, 0.1);">
                    <x-heroicon-o-cpu-chip style="width: 1.5rem; height: 1.5rem;" class="text-info-600 dark:text-info-400" />
                </div>
                <div>
                    <p style="font-size: 0.75rem; margin: 0;" class="text-gray-500 dark:text-gray-400">Data Elektronik</p>
                    <p style="font-size: 1.25rem; font-weight: 700; margin: 0;" class="text-gray-950 dark:text-white">{{ $totalElektronik }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
