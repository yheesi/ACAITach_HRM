<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'shift';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nama_shift',
		'jam_mulai',
		'jam_selesai',
		'lintas_tengah_malam',
		'durasi_jam',
		'toleransi_telat_menit',
		'status',
		'dibuat_pada',
		'diperbarui_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'jam_mulai' => 'datetime',
		'jam_selesai' => 'datetime',
		'lintas_tengah_malam' => 'boolean',
		'dibuat_pada' => 'datetime',
		'diperbarui_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_shift', 'id_shift');
    }

    // @enddbml-sync:relations
}