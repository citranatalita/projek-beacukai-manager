<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
    'kode_barang',
    'nama_barang',
    'id_negara_asal',
    'jumlah_barang',
    'harga_barang',
    'is_completed',
    'user_id',
];



    // Relasi dengan model NegaraAsal
    public function negaraAsal()
    {
        return $this->belongsTo(NegaraAsal::class, 'id_negara_asal');
    }
}
