<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table            = 'alternatif';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'users_id', 'pend_agama', 'pend_pancasila', 'bahasa_indo',
        'mtk', 'sejarah_indo', 'bahasa_ing', 'seni_budaya', 'penjas', 'prakarya_dan_kwh',
        'biologi', 'fisika', 'kimia', 'sosiologi', 'ekonomi', 'ket_pend_agama', 'ket_pend_pancasila',
        'ket_bahasa_indo', 'ket_matematika', 'ket_sejarah_indo', 'ket_bahasa_ing',
        'ket_seni_budaya', 'ket_penjas', 'ket_prakarya_dan_kwh', 'ket_biologi', 'ket_fisika',
        'ket_kimia', 'ket_sosiologi', 'ket_ekonomi', 'pramuka', 'olahraga', 'pmr', 'sikap_spiritual', 'sikap_sosial',
        'sakit', 'izin', 'tanpa_keterangan', 'semester'
    ];
    protected $useTimestamps = false;
    // protected $returnType    = \App\Entities\User::class;
}
