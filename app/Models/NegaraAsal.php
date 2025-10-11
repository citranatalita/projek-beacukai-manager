<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class NegaraAsal extends Model
{
    use HasFactory;

    protected $table = 'negara_asal';

    protected $fillable = [
    'nama_negara',
    'simbol',
    'kode_mata_uang',
];


    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_negara_asal');
    }
}
