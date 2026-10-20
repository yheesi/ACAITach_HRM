<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'pengguna';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'id_karyawan',
		'username',
		'password',
		'peran',
		'aktif',
		'terakhir_login',
		'dibuat_pada',
		'diperbarui_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'aktif' => 'boolean',
		'terakhir_login' => 'datetime',
		'dibuat_pada' => 'datetime',
		'diperbarui_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'dibuat_oleh', 'id_pengguna');
    }

    public function lemburs()
    {
        return $this->hasMany(Lembur::class, 'disetujui_oleh', 'id_pengguna');
    }

    public function rekapBulanans()
    {
        return $this->hasMany(RekapBulanan::class, 'dibuat_oleh', 'id_pengguna');
    }

    public function logAudits()
    {
        return $this->hasMany(LogAudit::class, 'id_pengguna', 'id_pengguna');
    }

    // @enddbml-sync:relations
}