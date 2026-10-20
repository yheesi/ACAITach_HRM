<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapBulanan extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'rekap_bulanan';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'id_cabang',
		'tanggal_mulai',
		'tanggal_selesai',
		'total_karyawan',
		'total_jam_kerja',
		'total_jam_terlambat',
		'total_jam_lembur',
		'dibuat_oleh',
		'terkunci',
		'dikunci_pada',
		'dibuat_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal_mulai' => 'date',
		'tanggal_selesai' => 'date',
		'terkunci' => 'boolean',
		'dikunci_pada' => 'datetime',
		'dibuat_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'dibuat_oleh', 'id_pengguna');
    }

    // @enddbml-sync:relations
}