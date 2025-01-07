<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Faktur;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FakturResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FakturResource\RelationManagers;

class FakturResource extends Resource
{
    protected static ?string $model = Faktur::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_faktur')
                    ->label('Kode Faktur')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('tanggal_faktur')
                    ->label('Tanggal Faktur')
                    ->required(),

                TextInput::make('kode_customer')
                    ->label('Kode Customer')
                    ->integer()
                    ->required()
                    ->maxLength(255),

                Select::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'nama_customer')
                    ->required(),

                Textarea::make('ket_faktur')
                    ->label('Keterangan Faktur')
                    ->nullable(),

                TextInput::make('total')
                    ->label('Total')
                    ->required()
                    ->numeric(),

                TextInput::make('nominal_charge')
                    ->label('Nominal Charge')
                    ->required()
                    ->numeric(),

                TextInput::make('charge')
                    ->label('Charge')
                    ->required()
                    ->numeric(),

                TextInput::make('total_final')
                    ->label('Total Final')
                    ->required()
                    ->numeric(),

                Toggle::make('deleted_at')
                    ->label('Soft Deleted')
                    ->disabled()
                    ->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_faktur')
                    ->label('Kode Faktur'),
                TextColumn::make('tanggal_faktur')
                    ->label('Tanggal Faktur')->date(),
                TextColumn::make('customer_id')
                    ->label('Customer ID'),
                TextColumn::make('ket_faktur')
                    ->label('Ket Faktur'),
                TextColumn::make('total')
                    ->label('Total'),
                TextColumn::make('total_final')
                    ->label('Total Final'),
                TextColumn::make('deleted_at')
                    ->label('Deleted At')
                    ->dateTime()
                    ->hidden(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListFakturs::route('/'),
            'create' => Pages\CreateFaktur::route('/create'),
            'edit' => Pages\EditFaktur::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
