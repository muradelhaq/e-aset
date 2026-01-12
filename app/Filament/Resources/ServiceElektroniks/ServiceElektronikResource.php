<?php

namespace App\Filament\Resources\ServiceElektroniks;

use App\Filament\Resources\ServiceElektroniks\Pages\CreateServiceElektronik;
use App\Filament\Resources\ServiceElektroniks\Pages\EditServiceElektronik;
use App\Filament\Resources\ServiceElektroniks\Pages\ListServiceElektroniks;
use App\Filament\Resources\ServiceElektroniks\Pages\ViewServiceElektronik;
use App\Filament\Resources\ServiceElektroniks\Schemas\ServiceElektronikForm;
use App\Filament\Resources\ServiceElektroniks\Schemas\ServiceElektronikInfolist;
use App\Filament\Resources\ServiceElektroniks\Tables\ServiceElektroniksTable;
use App\Models\ServiceElektronik;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServiceElektronikResource extends Resource
{
    protected static ?string $model = ServiceElektronik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::WrenchScrewdriver;

    protected static ?string $recordTitleAttribute = 'Service Elektronik';

    protected static string | \UnitEnum | null $navigationGroup = 'Elektronik';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Service Elektronik';

    // Label untuk judul halaman dan tombol (Singular)
    protected static ?string $modelLabel = 'Service Elektronik';

    // Label untuk data jamak (Plural)
    protected static ?string $pluralModelLabel = 'Service Elektronik';

    public static function form(Schema $schema): Schema
    {
        return ServiceElektronikForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ServiceElektronikInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceElektroniksTable::configure($table);
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
            'index' => ListServiceElektroniks::route('/'),
            'create' => CreateServiceElektronik::route('/create'),
            'view' => ViewServiceElektronik::route('/{record}'),
            'edit' => EditServiceElektronik::route('/{record}/edit'),
        ];
    }
}
