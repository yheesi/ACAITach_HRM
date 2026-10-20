<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'cabang';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nama_cabang',
		'alamat',
		'kota',
		'telepon',
		'status',
		'dibuat_pada',
		'diperbarui_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'dibuat_pada' => 'datetime',
		'diperbarui_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function karyawans()
    {
        return $this->hasMany(Karyawan::class, 'id_cabang', 'id_cabang');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_cabang', 'id_cabang');
    }

    public function rekapBulanans()
    {
        return $this->hasMany(RekapBulanan::class, 'id_cabang', 'id_cabang');
    }

    // @enddbml-sync:relations
}