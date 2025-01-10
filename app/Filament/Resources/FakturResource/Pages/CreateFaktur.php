<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use App\Models\Penjualan;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFaktur extends CreateRecord
{
    protected static string $resource = FakturResource::class;

    protected function afterCreate(): void
    {
        Penjualan::create([
            'kode' => $this->record->kode_faktur,
            'tanggal' => $this->record->tanggal_faktur,
            'jumlah' => $this->record->total,
            'customer_id' => $this->record->customer_id,
            'faktur_id' => $this->record->id,
            'keterangan' => $this->record->ket_faktur,
            'status' => 0,
        ]);
    }
}
