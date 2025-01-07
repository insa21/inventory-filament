<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'faktur_id',
        'diskon',
        'nama_barang',
        'harga',
        'subtotal',
        'qty',
        'hasil_qty',
    ];

    protected $table = 'details';


    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function faktur()
    {
        return $this->belongsTo(Faktur::class, 'fatur_id');
    }
}
