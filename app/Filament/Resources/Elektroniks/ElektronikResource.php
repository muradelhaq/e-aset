<?php

namespace App\Filament\Resources\Elektroniks;

use App\Filament\Resources\Elektroniks\Pages\CreateElektronik;
use App\Filament\Resources\Elektroniks\RelationManagers\ServiceElektroniksRelationManager;
use App\Filament\Resources\Elektroniks\Pages\EditElektronik;
use App\Filament\Resources\Elektroniks\Pages\ListElektroniks;
use App\Filament\Resources\Elektroniks\Pages\ViewElektronik;
use App\Filament\Resources\Elektroniks\Schemas\ElektronikForm;
use App\Filament\Resources\Elektroniks\Schemas\ElektronikInfolist;
use App\Filament\Resources\Elektroniks\Tables\ElektroniksTable;
use App\Models\Elektronik;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ElektronikResource extends Resource
{
    protected static ?string $model = Elektronik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ComputerDesktop;

    protected static ?string $recordTitleAttribute = 'Data Elektronik';

    protected static string | \UnitEnum | null $navigationGroup = 'Elektronik';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Data Elektronik';

    // Label untuk judul halaman dan tombol (Singular)
    protected static ?string $modelLabel = 'Data Elektronik';

    // Label untuk data jamak (Plural)
    protected static ?string $pluralModelLabel = 'Data Elektronik';

    public static function form(Schema $schema): Schema
    {
        return ElektronikForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ElektronikInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ElektroniksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ServiceElektroniksRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => ListElektroniks::route('/'),
            'create' => CreateElektronik::route('/create'),
            'view' => ViewElektronik::route('/{record}'),
            'edit' => EditElektronik::route('/{record}/edit'),
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
