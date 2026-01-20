<?php

namespace App\Filament\Resources\Bangunans;

use App\Filament\Resources\Bangunans\Pages\CreateBangunan;
use App\Filament\Resources\Bangunans\Pages\EditBangunan;
use App\Filament\Resources\Bangunans\Pages\ListBangunans;
use App\Filament\Resources\Bangunans\Pages\ViewBangunan;
use App\Filament\Resources\Bangunans\Schemas\BangunanForm;
use App\Filament\Resources\Bangunans\Schemas\BangunanInfolist;
use App\Filament\Resources\Bangunans\Tables\BangunansTable;
use App\Models\Bangunan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BangunanResource extends Resource
{
    protected static ?string $model = Bangunan::class;

    // Mengganti icon menjadi gedung (Home Modern / Building)
    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice;

    // Membuat Navigation Group
    protected static string | \UnitEnum | null $navigationGroup = 'Bangunan';

    // Mengubah nama di menu navigasi
    protected static ?string $navigationLabel = 'Data Bangunan';

    protected static ?int $navigationSort = 6;

    // Mengubah judul halaman (plural & singular)
    protected static ?string $pluralLabel = 'Data Bangunan';
    protected static ?string $modelLabel = 'Bangunan';

    // Atribut untuk pencarian global
    protected static ?string $recordTitleAttribute = 'nama_bangunan';

    public static function form(Schema $schema): Schema
    {
        return BangunanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BangunanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BangunansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBangunans::route('/'),
            'create' => CreateBangunan::route('/create'),
            'view' => ViewBangunan::route('/{record}'),
            'edit' => EditBangunan::route('/{record}/edit'),
        ];
    }

    /**
     * Mengaktifkan query untuk soft deletes agar data yang dihapus
     * tetap bisa diakses di halaman view/edit (Trash)
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
