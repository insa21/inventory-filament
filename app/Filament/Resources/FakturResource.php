<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Faktur;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\{Card, Select, Toggle, Fieldset, Repeater, Textarea, TextInput, DatePicker};
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FakturResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FakturResource extends Resource
{
    protected static ?string $model = Faktur::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make([
                TextInput::make('kode_faktur')
                    ->label('Kode Faktur')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('tanggal_faktur')
                    ->label('Tanggal Faktur')
                    ->required(),
            ])->columns(2),

            Fieldset::make('Informasi Customer')
                ->schema([
                    TextInput::make('kode_customer')
                        ->label('Kode Customer')
                        ->integer()
                        ->required()
                        ->maxLength(255),

                    Select::make('customer_id')
                        ->label('Customer')
                        ->relationship('customer', 'nama_customer')
                        ->required(),
                ])->columns(2),

            Fieldset::make('Detail Barang')
                ->schema([
                    Repeater::make('details')
                        ->relationship()
                        ->schema([
                            Select::make('barang_id')
                                ->relationship('barang', 'nama_barang')
                                ->label('Barang')
                                ->required(),

                            TextInput::make('diskon')
                                ->numeric()
                                ->label('Diskon')
                                ->required(),

                            TextInput::make('nama_barang')
                                ->label('Nama Barang')
                                ->required(),

                            TextInput::make('harga')
                                ->numeric()
                                ->label('Harga')
                                ->required(),

                            TextInput::make('subtotal')
                                ->numeric()
                                ->label('Subtotal')
                                ->required(),

                            TextInput::make('qty')
                                ->numeric()
                                ->label('Qty')
                                ->required(),

                            TextInput::make('hasil_qty')
                                ->numeric()
                                ->label('Hasil Qty')
                                ->required(),
                        ])
                ])->columns(2),

            Fieldset::make('Informasi Tambahan')
                ->schema([
                    Textarea::make('ket_faktur')
                        ->label('Keterangan Faktur')
                        ->nullable()
                        ->rows(5)
                        ->maxLength(255),
                ]),

            Card::make([
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
            ])->columns(2),

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
                    ->label('Tanggal Faktur')
                    ->date(),

                TextColumn::make('kode_customer')
                    ->label('Kode Customer'),

                TextColumn::make('customer.nama_customer')
                    ->label('Nama Customer'),

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
        return [];
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
