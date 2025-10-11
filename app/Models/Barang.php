<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'id_negara_asal',
        'is_completed',
        'jumlah_barang',
        'harga_barang',
    ];

    // Relasi dengan model NegaraAsal
    public function negaraAsal()
    {
        return $this->belongsTo(NegaraAsal::class, 'id_negara_asal');
    }
}
