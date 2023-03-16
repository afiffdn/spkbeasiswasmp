<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        dd($db->table('tb_nilai')->selectMax('nilai')->where('pelajaran_id', 1)->get()->getRow()->nilai);
        $data = [];
        foreach ($db->table('tb_nilai')->get()->getResult() as $nilai) :
            $data[] = ['id' => $nilai->users_id];
        endforeach;
        // dd($data);
    }
}
