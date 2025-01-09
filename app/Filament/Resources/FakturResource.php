<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FakturResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\{Faktur, Barang, CustomerModel, Datail, User};
use Filament\Forms\Components\{
    Card,
    Select,
    Toggle,
    Fieldset,
    Repeater,
    Textarea,
    TextInput,
    DatePicker
};
use NunoMaduro\Collision\Adapters\Phpunit\State;

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
                    Select::make('customer_id')
                        ->reactive()
                        ->label('Customer')
                        ->relationship('customer', 'nama_customer')
                        ->required()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $customer = CustomerModel::find($state);
                            if ($customer) {
                                $set('kode_customer', $customer->kode_customer);
                            }
                        })
                        ->afterStateHydrated(function ($state, callable $set) {
                            $customer = CustomerModel::find($state);
                            if ($customer) {
                                $set('kode_customer', $customer->kode_customer);
                            }
                        }),
                    TextInput::make('kode_customer')
                        ->label('Kode Customer')
                        ->disabled()
                        ->dehydrated()
                        ->required()
                        ->maxLength(255),
                ])->columns(2),

            Fieldset::make('Detail Barang')
                ->schema([
                    Repeater::make('details')
                        ->label('Barang')
                        ->relationship()
                        ->schema([
                            Select::make('barang_id')
                                ->relationship('barang', 'nama_barang')
                                ->label('Barang')
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $barang = Barang::find($state);
                                    if ($barang) {
                                        $set('nama_barang', $barang->nama_barang);
                                        $set('harga_barang', $barang->harga_barang);
                                    }
                                }),

                            TextInput::make('nama_barang')
                                ->disabled()
                                ->dehydrated()
                                ->label('Nama Barang')
                                ->required(),

                            TextInput::make('harga_barang')
                                ->prefix('Rp')
                                ->disabled()
                                ->dehydrated()
                                ->integer()
                                ->label('Harga')
                                ->required(),

                            TextInput::make('qty')
                                ->integer()
                                ->label('Qty')
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function (Set $set, $state, Get $get) {
                                    $tampungHarga = $get('harga_barang');
                                    $set('hasil_qty', intval($state * $tampungHarga));
                                }),

                            TextInput::make('hasil_qty')
                                ->numeric()
                                ->disabled()
                                ->dehydrated()
                                ->label('Hasil Qty')
                                ->required(),

                            TextInput::make('diskon')
                                ->numeric()
                                ->prefix('%')
                                ->label('Diskon')
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function (Set $set, $state, Get $get) {
                                    $hasilQTY = $get('hasil_qty');
                                    $diskon = $hasilQTY * ($state / 100);
                                    $hasil = $hasilQTY - $diskon;

                                    $set('subtotal', intval($hasil));
                                }),

                            TextInput::make('subtotal')
                                ->disabled()
                                ->dehydrated()
                                ->prefix('Rp')
                                ->numeric()
                                ->label('Subtotal')
                                ->required()
                                ->columnSpan(2)
                                ->live(),
                        ])
                        ->columns(2), // Membagi repeater menjadi dua kolom untuk setiap form baru
                ])
                ->columns(1), // Fieldset tetap satu kolom agar repeater terpisah


            Fieldset::make('Informasi Tambahan')
                ->schema([
                    Textarea::make('ket_faktur')
                        ->label('Keterangan Faktur')
                        ->columnSpan(2)
                        ->nullable()
                        ->rows(5)
                        ->maxLength(255),
                ]),

            Card::make([
                TextInput::make('total')
                    ->placeholder(function (Set $set, Get $get) {
                        $detail = collect($get('details'))->pluck('subtotal')->sum();
                        if ($detail == null) {
                            $set('total', 0);
                        } else {
                            $set('total', $detail);
                        }
                    })
                    ->disabled()
                    ->dehydrated()
                    ->label('Total')
                    ->prefix('Rp')
                    ->required()
                    ->numeric(),

                TextInput::make('nominal_charge')
                    ->label('Nominal Charge')
                    ->required()
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, $state, Get $get) {
                        $total = $get('total');
                        $charge = $total * ($state / 100);
                        $hasil = $total + $charge;

                        $set('total_final', $hasil);
                        $set('charge', $charge);
                    }),

                TextInput::make('charge')
                    ->label('Charge')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->numeric(),

                TextInput::make('total_final')
                    ->label('Total Final')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->prefix('Rp')
                    ->numeric(),
            ])->columns(2),

            Toggle::make('deleted_at')
                ->label('Soft Deleted')
                ->disabled()
                ->dehydrated()
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
