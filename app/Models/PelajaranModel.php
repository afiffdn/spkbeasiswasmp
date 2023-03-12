<?php

namespace App\Models;

use CodeIgniter\Model;

class PelajaranModel extends Model
{
    protected $table            = 'tb_pelajaran';
    protected $primaryKey       = 'id_pelajaran';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nama_pelajaran'];
    protected $useTimestamps = true;
}
