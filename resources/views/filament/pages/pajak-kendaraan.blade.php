<x-filament-panels::page>
    <div class="space-y-6">

        {{-- ========================================== --}}
        {{-- BAGIAN 1: STATS CARDS --}}
        {{-- ========================================== --}}
        {{-- Kita gunakan CSS Grid manual agar layout terbentuk --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            @php
                $stats = $this->getStatsData();
                $cards = [
                    [
                        'label' => 'Total Kendaraan',
                        'value' => $stats['total'],
                        'icon' => 'heroicon-o-truck',
                        'color' => '#2563eb', // Blue
                        'bg' => 'rgba(37, 99, 235, 0.1)',
                    ],
                    [
                        'label' => 'Pajak Terlambat',
                        'value' => $stats['expired'],
                        'icon' => 'heroicon-o-exclamation-triangle',
                        'color' => '#dc2626', // Red
                        'bg' => 'rgba(220, 38, 38, 0.1)',
                    ],
                    [
                        'label' => 'Akan Tempo',
                        'value' => $stats['will_expire'],
                        'icon' => 'heroicon-o-clock',
                        'color' => '#ca8a04', // Yellow
                        'bg' => 'rgba(202, 138, 4, 0.1)',
                    ],
                    [
                        'label' => 'Bulan Ini',
                        'value' => $stats['this_month'],
                        'icon' => 'heroicon-o-calendar-days',
                        'color' => '#16a34a', // Green
                        'bg' => 'rgba(22, 163, 74, 0.1)',
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10" style="padding: 1.5rem; display: flex; flex-direction: column; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        {{-- PEMBAIKAN ICON: Memaksa ukuran container dan icon --}}
                        <div style="background-color: {{ $card['bg'] }}; color: {{ $card['color'] }}; padding: 0.5rem; border-radius: 0.5rem; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            @svg($card['icon'], 'w-6 h-6', ['style' => 'width: 24px; height: 24px;'])
                        </div>
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">
                            {{ $card['label'] }}
                        </span>
                    </div>

                    <div style="margin-top: 1rem;">
                        <span class="text-2xl font-bold text-gray-950 dark:text-white">
                            {{ $card['value'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ========================================== --}}
        {{-- BAGIAN 2: FILTER TABS --}}
        {{-- ========================================== --}}
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;">

            <div style="overflow-x: auto; padding-bottom: 4px;">
                <div class="bg-gray-100 dark:bg-gray-800 ring-1 ring-gray-950/5 dark:ring-white/10" style="display: inline-flex; padding: 0.25rem; border-radius: 0.5rem;">
                    @php
                        $filters = [
                            'all' => 'Semua',
                            'expired' => 'Terlambat',
                            'will_expire' => 'Jatuh Tempo',
                            'this_month' => 'Bulan Ini',
                        ];
                    @endphp

                    @foreach ($filters as $key => $label)
                        <button
                            wire:click="setFilter('{{ $key }}')"
                            class="transition-all duration-200 {{ $selectedFilter === $key ? 'bg-white dark:bg-gray-700 shadow-sm' : '' }}"
                            style="padding: 0.375rem 0.75rem; font-size: 0.75rem; font-weight: 500; border-radius: 0.375rem; white-space: nowrap; border: none; cursor: pointer; color: inherit;"
                        >
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div wire:loading class="text-xs text-primary-600 dark:text-primary-400 font-medium">
                Memproses...
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- BAGIAN 3: KALENDER PAJAK --}}
        {{-- ========================================== --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10" style="overflow: hidden;">

            {{-- Header --}}
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; border-bottom: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <x-heroicon-o-calendar style="width: 1rem; height: 1rem; color: #9ca3af;" />
                    <span class="text-sm font-semibold text-gray-950 dark:text-white">
                        {{ $this->getCurrentMonthName() }}
                    </span>
                </div>

                <div style="display: flex; gap: 0.25rem;">
                    <button wire:click="previousMonth" style="padding: 0.375rem; border-radius: 0.5rem; border: none; background: transparent; cursor: pointer;">
                        <x-heroicon-o-chevron-left style="width: 1rem; height: 1rem;" />
                    </button>
                    <button wire:click="nextMonth" style="padding: 0.375rem; border-radius: 0.5rem; border: none; background: transparent; cursor: pointer;">
                        <x-heroicon-o-chevron-right style="width: 1rem; height: 1rem;" />
                    </button>
                </div>
            </div>

            {{-- Body Grid --}}
            <div style="padding: 1rem; overflow-x: auto;">
                <div style="min-width: 600px;">

                    @php
                        $calendarData = $this->getCalendarData();
                        $startOfMonth = \Carbon\Carbon::create($currentYear, $currentMonth, 1);
                        $startDate = $startOfMonth->copy()->startOfWeek();
                        $endDate = $startOfMonth->copy()->endOfMonth()->endOfWeek();
                        $days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
                    @endphp

                    {{-- Nama Hari --}}
                    {{-- Grid Manual 7 Kolom --}}
                    <div style="display: grid; grid-template-columns: repeat(7, 1fr); margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e5e7eb;">
                        @foreach ($days as $day)
                            <div style="text-align: center; font-size: 0.65rem; font-weight: bold; color: #9ca3af; text-transform: uppercase;">
                                {{ $day }}
                            </div>
                        @endforeach
                    </div>

                    {{-- Kotak Tanggal --}}
                    {{-- Grid Manual 7 Kolom --}}
                    <div style="display: grid; grid-template-columns: repeat(7, 1fr); border: 1px solid #e5e7eb; border-radius: 0.5rem; background-color: #f9fafb;">
                        @for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay())
                            @php
                                $isCurrentMonth = $date->month === $currentMonth;
                                $isToday = $date->isToday();
                                $pajakData = $calendarData->get($date->day, collect());

                                // Warna Background
                                $bgClass = $isCurrentMonth ? 'background-color: #ffffff;' : 'background-color: #f9fafb;';
                            @endphp

                            <div style="min-height: 90px; border-right: 1px solid #e5e7eb; border-bottom: 1px solid #e5e7eb; padding: 0.375rem; {{ $bgClass }}">

                                {{-- Angka Tanggal --}}
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.25rem;">
                                    <span style="font-size: 0.65rem; font-weight: 500; border-radius: 9999px; width: 1.25rem; height: 1.25rem; display: flex; align-items: center; justify-content: center; {{ $isToday ? 'background-color: #2563eb; color: white;' : 'color: #374151;' }}">
                                        {{ $date->day }}
                                    </span>
                                </div>

                                {{-- Event --}}
                                @if ($isCurrentMonth && $pajakData->isNotEmpty())
                                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                        @foreach ($pajakData->take(2) as $kendaraan)
                                            @php
                                                $tgl = \Carbon\Carbon::parse($kendaraan->tgl_pajak);
                                                // Warna Badge Manual
                                                if($tgl->isPast()) {
                                                    $badgeStyle = 'background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca;';
                                                } elseif($tgl->diffInDays(now()) <= 7) {
                                                    $badgeStyle = 'background-color: #fefce8; color: #a16207; border: 1px solid #fde047;';
                                                } else {
                                                    $badgeStyle = 'background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0;';
                                                }
                                            @endphp

                                            <div style="font-size: 0.55rem; padding: 2px 4px; border-radius: 4px; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; {{ $badgeStyle }}">
                                                {{ $kendaraan->nopol }}
                                            </div>
                                        @endforeach

                                        @if ($pajakData->count() > 2)
                                            <div style="font-size: 0.55rem; color: #9ca3af; padding-left: 2px;">
                                                +{{ $pajakData->count() - 2 }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </div>

                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- BAGIAN 4: TABEL --}}
        {{-- ========================================== --}}
        {{ $this->table }}

    </div>
</x-filament-panels::page>
