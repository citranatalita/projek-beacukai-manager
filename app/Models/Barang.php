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
    'nilai_cukai',
    'is_completed',
    'user_id',
    'status',
];



    // Relasi dengan model NegaraAsal
    public function negaraAsal()
    {
        return $this->belongsTo(NegaraAsal::class, 'id_negara_asal');
    }

    public function user()
    {
    return $this->belongsTo(\App\Models\User::class);
}

}
