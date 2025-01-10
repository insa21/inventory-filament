<?php

namespace App\Models;

use App\Models\CustomerModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faktur extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'kode_faktur',
        'tanggal_faktur',
        'kode_customer',
        'customer_id',
        'ket_faktur',
        'total',
        'nominal_charge',
        'charge',
        'total_final',
    ];


    protected $table = 'fakturs';

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'faktur_id');
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'faktur_id');
    }
}
