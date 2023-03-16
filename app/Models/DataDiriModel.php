<?php

namespace App\Models;

use CodeIgniter\Model;


class DataDiriModel extends Model
{
    protected $table            = 'tb_data_diri';
    protected $primaryKey       = 'id_data_diri';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['users_id', 'nisn', 'nama', 'jenis_kelamin', 'agama', 'kelas', 'alamat', 'nip', 'jabatan'];
    protected $useTimestamps = true;
}
