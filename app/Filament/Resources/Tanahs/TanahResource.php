<?php

namespace App\Filament\Resources\Tanahs;

use App\Filament\Resources\Tanahs\Pages\CreateTanah;
use App\Filament\Resources\Tanahs\Pages\EditTanah;
use App\Filament\Resources\Tanahs\Pages\ListTanahs;
use App\Filament\Resources\Tanahs\Pages\ViewTanah;
use App\Filament\Resources\Tanahs\Schemas\TanahForm;
use App\Filament\Resources\Tanahs\Schemas\TanahInfolist;
use App\Filament\Resources\Tanahs\Tables\TanahsTable;
use App\Models\Tanah;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TanahResource extends Resource
{
    protected static ?string $model = Tanah::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static ?string $recordTitleAttribute = 'Data Tanah';

    protected static string | \UnitEnum | null $navigationGroup = 'Tanah';

    protected static ?int $navigationSort = 12;

    protected static ?string $navigationLabel = 'Data Tanah';

    // Label untuk judul halaman dan tombol (Singular)
    protected static ?string $modelLabel = 'Data Tanah';

    // Label untuk data jamak (Plural)
    protected static ?string $pluralModelLabel = 'Data Tanah';

    public static function form(Schema $schema): Schema
    {
        return TanahForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TanahInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TanahsTable::configure($table);
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
            'index' => ListTanahs::route('/'),
            'create' => CreateTanah::route('/create'),
            'view' => ViewTanah::route('/{record}'),
            'edit' => EditTanah::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
