<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'presensi';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'id_jadwal',
		'jam_masuk',
		'jam_keluar',
		'status',
		'total_jam',
		'menit_terlambat',
		'terkunci',
		'dibuat_pada',
		'diperbarui_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'jam_masuk' => 'datetime',
		'jam_keluar' => 'datetime',
		'terkunci' => 'boolean',
		'dibuat_pada' => 'datetime',
		'diperbarui_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations

    // @enddbml-sync:relations
}