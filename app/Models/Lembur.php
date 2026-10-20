<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'lembur';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'id_jadwal',
		'tanggal_lembur',
		'jam_lembur',
		'alasan',
		'status',
		'disetujui_oleh',
		'disetujui_pada',
		'terkunci',
		'dibuat_pada',
		'diperbarui_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal_lembur' => 'date',
		'disetujui_pada' => 'datetime',
		'terkunci' => 'boolean',
		'dibuat_pada' => 'datetime',
		'diperbarui_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'disetujui_oleh', 'id_pengguna');
    }

    // @enddbml-sync:relations
}