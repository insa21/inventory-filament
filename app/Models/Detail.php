<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'details';


    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function faktur()
    {
        return $this->belongsTo(Faktur::class, 'id');
    }
}
