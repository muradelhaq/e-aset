<?php

namespace App\Filament\Resources\NonElektroniks;

use App\Filament\Resources\NonElektroniks\Pages\CreateNonElektronik;
use App\Filament\Resources\NonElektroniks\Pages\EditNonElektronik;
use App\Filament\Resources\NonElektroniks\Pages\ListNonElektroniks;
use App\Filament\Resources\NonElektroniks\Pages\ViewNonElektronik;
use App\Filament\Resources\NonElektroniks\Schemas\NonElektronikForm;
use App\Filament\Resources\NonElektroniks\Schemas\NonElektronikInfolist;
use App\Filament\Resources\NonElektroniks\Tables\NonElektroniksTable;
use App\Models\NonElektronik;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NonElektronikResource extends Resource
{
    protected static ?string $model = NonElektronik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ComputerDesktop;

    protected static ?string $recordTitleAttribute = 'Data Non Elektronik';

    protected static string | \UnitEnum | null $navigationGroup = 'Non Elektronik';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Data Non Elektronik';

    // Label untuk judul halaman dan tombol (Singular)
    protected static ?string $modelLabel = 'Data Non Elektronik';

    // Label untuk data jamak (Plural)
    protected static ?string $pluralModelLabel = 'Data Non Elektronik';

    public static function form(Schema $schema): Schema
    {
        return NonElektronikForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return NonElektronikInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NonElektroniksTable::configure($table);
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
            'index' => ListNonElektroniks::route('/'),
            'create' => CreateNonElektronik::route('/create'),
            'view' => ViewNonElektronik::route('/{record}'),
            'edit' => EditNonElektronik::route('/{record}/edit'),
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
