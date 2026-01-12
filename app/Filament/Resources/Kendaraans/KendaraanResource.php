<?php

namespace App\Filament\Resources\Kendaraans;

use App\Filament\Resources\Kendaraans\RelationManagers\ServicesRelationManager;
use App\Filament\Resources\Kendaraans\Pages\CreateKendaraan;
use App\Filament\Resources\Kendaraans\Pages\EditKendaraan;
use App\Filament\Resources\Kendaraans\Pages\ListKendaraans;
use App\Filament\Resources\Kendaraans\Pages\ViewKendaraan;
use App\Filament\Resources\Kendaraans\Schemas\KendaraanForm;
use App\Filament\Resources\Kendaraans\Schemas\KendaraanInfolist;
use App\Filament\Resources\Kendaraans\Tables\KendaraansTable;
use App\Models\Kendaraan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Truck;

    protected static ?string $recordTitleAttribute = 'Data Kendaraan';

    protected static string | \UnitEnum | null $navigationGroup = 'Kendaraan';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Data Kendaraan';

    // Label untuk judul halaman dan tombol (Singular)
    protected static ?string $modelLabel = 'Data Kendaraan';

    // Label untuk data jamak (Plural)
    protected static ?string $pluralModelLabel = 'Data Kendaraan';

    public static function form(Schema $schema): Schema
    {
        return KendaraanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KendaraanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KendaraansTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKendaraans::route('/'),
            'create' => CreateKendaraan::route('/create'),
            'view' => ViewKendaraan::route('/{record}'),
            'edit' => EditKendaraan::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    public static function getRelations(): array
    {
    return [
        ServicesRelationManager::class,
    ];
    }
}
