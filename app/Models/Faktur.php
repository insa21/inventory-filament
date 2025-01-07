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

    protected $guarded = [];

    protected $table = 'fakturs';

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'faktur_id');
    }
}
