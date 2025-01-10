<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Penjualan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\PenjualanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenjualanResource\RelationManagers;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $slug = 'kelola-penjualan';
    protected static ?string $navigationLabel = 'Kelola Penjualan';
    protected static ?string $navigationGroup = 'Kelola';
    protected static ?string $label = 'Kelola Penjualan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->sortable()
                    ->searchable()
                    ->date('d F Y'),
                TextColumn::make('kode')
                    ->label('Kode Faktur')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('jumlah')
                    ->sortable()
                    ->label('Jumlah')
                    ->formatStateUsing(fn(Penjualan $record): string => 'Rp ' . number_format($record->jumlah, 0, '.', '.'))
                    ->searchable(),
                TextColumn::make('customer.nama_customer')
                    ->sortable()
                    ->searchable()
                    ->label('Nama Customer'),
                TextColumn::make('status')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'reviewing' => 'warning',
                        '1' => 'success',
                        '0' => 'danger',
                    })
                    ->formatStateUsing(fn(Penjualan $record): string => $record->status == 0 ? 'Belum Lunas' : 'Lunas')
                    ->label('Status'),
                // TextColumn::make('keterangan')
                //     ->sortable()
                //     ->searchable()
                //     ->badge()
                //     ->label('Keterangan'),

            ])
            ->emptyStateHeading('Tidak ada Data Laporan')
            ->emptyStateDescription('Silahkan Tambahkan Faktur Terlebih Dahulu')
            ->emptyStateIcon('heroicon-o-exclamation-triangle')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Buat Faktur')
                    ->url(route('filament.admin.resources.fakturs.create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
            ])

            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
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
