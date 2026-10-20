<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'karyawan';
    // @enddbml-sync:table-property

    protected $primaryKey = 'id_karyawan';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    // @dbml-sync:fillable
    protected $fillable = [
        'id_cabang',
		'nama',
		'jabatan',
		'no_identitas',
		'telepon',
		'email',
		'status_kerja',
		'tanggal_bergabung',
		'tanggal_keluar',
		'dibuat_pada',
		'diperbarui_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal_bergabung' => 'date',
		'tanggal_keluar' => 'date',
		'dibuat_pada' => 'datetime',
		'diperbarui_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_karyawan', 'id_karyawan');
    }

    // @enddbml-sync:relations
}