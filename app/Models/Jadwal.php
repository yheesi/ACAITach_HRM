<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'jadwal';
    // @enddbml-sync:table-property

    protected $primaryKey = 'id_jadwal';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    // @dbml-sync:fillable
    protected $fillable = [
        'id_karyawan',
		'id_cabang',
		'id_shift',
		'tanggal',
		'status',
		'dibuat_oleh',
		'dibuat_pada',
		'diperbarui_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal' => 'date',
		'dibuat_pada' => 'datetime',
		'diperbarui_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift', 'id_shift');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'dibuat_oleh', 'id_pengguna');
    }

    public function lemburs()
    {
        return $this->hasMany(Lembur::class, 'id_jadwal', 'id_jadwal');
    }

    // @enddbml-sync:relations
}