<?php

namespace App\Controllers;

use App\Models\NilaiModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class NilaiController extends ResourceController
{
    use ResponseTrait;
    public function __construct()

    {
        $this->nilaiModel = new NilaiModel();
    }
    private function user()
    {
        $key = getenv('TOKEN_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if (!$header) return $this->failUnauthorized('Token required');
        $token = explode(' ', $header)[1];

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $response = [
                'id'          => $decoded->id,
                'sebagai'    => $decoded->sebagai,
            ];
            return $response['id'];
        } catch (\Exception $th) {
            return $this->fail('Invalid Tokean');
        }
    }



    public function index()
    {
        $data = [
            'message' => 'succes',
            'data' => $this->nilaiModel
                // ->select('nama,nama_pelajaran,nilai,username')
                ->join('alternatif', 'tb_users.id_users=alternatif.users_id')
                ->join('tb_data_diri', 'tb_data_diri.users_id=tb_nilai.users_id', 'left')
                ->join('tb_users', 'tb_users.id_users=tb_nilai.users_id', 'left')
                ->findAll()
        ];
        return $this->respond($data, 200);
    }

    public function create()
    {
        $data = [
            'pend_agama' => $this->request->getVar('pend_agama'),
            'pend_pancasila' => $this->request->getVar('pend_pancasila'),
            'bahasa_indo' => $this->request->getVar('bahasa_indo'),
            'mtk' => $this->request->getVar('mtk'),
            'sejarah_indo' => $this->request->getVar('sejarah_indo'),
            'bahasa_ing' => $this->request->getVar('bahasa_ing'),
            'seni_budaya' => $this->request->getVar('seni_budaya'),
            'penjas' => $this->request->getVar('penjas'),
            'prakarya_dan_kwh' => $this->request->getVar('prakarya_dan_kwh'),
            'biologi' => $this->request->getVar('biologi'),
            'fisika' => $this->request->getVar('fisika'),
            'kimia' => $this->request->getVar('kimia'),
            'sosiologi' => $this->request->getVar('sosiologi'),
            'ekonomi' => $this->request->getVar('ekonomi'),
            'ket_pend_agama' => $this->request->getVar('ket_pend_agama'),
            'ket_pend_pancasila' => $this->request->getVar('ket_pend_pancasila'),
            'ket_bahasa_indo' => $this->request->getVar('ket_bahasa_indo'),
            'ket_matematika' => $this->request->getVar('ket_matematika'),
            'ket_sejarah_indo' => $this->request->getVar('ket_sejarah_indo'),
            'ket_bahasa_ing' => $this->request->getVar('ket_bahasa_ing'),
            'ket_seni_budaya' => $this->request->getVar('ket_seni_budaya'),
            'ket_penjas' => $this->request->getVar('ket_penjas'),
            'ket_prakarya_dan_kwh' => $this->request->getVar('ket_prakarya_dan_kwh'),
            'ket_biologi' => $this->request->getVar('ket_biologi'),
            'ket_fisika' => $this->request->getVar('ket_fisika'),
            'ket_kimia' => $this->request->getVar('ket_kimia'),
            'ket_sosiologi' => $this->request->getVar('ket_sosiologi'),
            'ket_ekonomi' => $this->request->getVar('ket_ekonomi'),
            'pramuka' => $this->request->getVar('pramuka'),
            'olahraga' => $this->request->getVar('olahraga'),
            'pmr' => $this->request->getVar('pmr'),
            'sikap_spiritual' => $this->request->getVar('sikap_spiritual'),
            'sikap_sosial' => $this->request->getVar('sikap_sosial'),
            'sakit' => $this->request->getVar('sakit'),
            'izin' => $this->request->getVar('izin'),
            'tanpa_keterangan' => $this->request->getVar('tanpa_keterangan'),
            'semester' => $this->request->getVar('semester'),
            'users_id' => $this->user()
        ];
        $this->nilaiModel->insert($data);
        $response = [
            'message' => [
                'success' => 'data berhasil disimpan'
            ]
        ];
        return $this->respondCreated($response);
    }
    public function update($id = null)
    {
        $data = [
            'pend_agama' => $this->request->getVar('pend_agama'),
            'pend_pancasila' => $this->request->getVar('pend_pancasila'),
            'bahasa_indo' => $this->request->getVar('bahasa_indo'),
            'mtk' => $this->request->getVar('mtk'),
            'sejarah_indo' => $this->request->getVar('sejarah_indo'),
            'bahasa_ing' => $this->request->getVar('bahasa_ing'),
            'seni_budaya' => $this->request->getVar('seni_budaya'),
            'penjas' => $this->request->getVar('penjas'),
            'prakarya_dan_kwh' => $this->request->getVar('prakarya_dan_kwh'),
            'biologi' => $this->request->getVar('biologi'),
            'fisika' => $this->request->getVar('fisika'),
            'kimia' => $this->request->getVar('kimia'),
            'sosiologi' => $this->request->getVar('sosiologi'),
            'ekonomi' => $this->request->getVar('ekonomi'),
            'ket_pend_agama' => $this->request->getVar('ket_pend_agama'),
            'ket_pend_pancasila' => $this->request->getVar('ket_pend_pancasila'),
            'ket_bahasa_indo' => $this->request->getVar('ket_bahasa_indo'),
            'ket_matematika' => $this->request->getVar('ket_matematika'),
            'ket_sejarah_indo' => $this->request->getVar('ket_sejarah_indo'),
            'ket_bahasa_ing' => $this->request->getVar('ket_bahasa_ing'),
            'ket_seni_budaya' => $this->request->getVar('ket_seni_budaya'),
            'ket_penjas' => $this->request->getVar('ket_penjas'),
            'ket_prakarya_dan_kwh' => $this->request->getVar('ket_prakarya_dan_kwh'),
            'ket_biologi' => $this->request->getVar('ket_biologi'),
            'ket_fisika' => $this->request->getVar('ket_fisika'),
            'ket_kimia' => $this->request->getVar('ket_kimia'),
            'ket_sosiologi' => $this->request->getVar('ket_sosiologi'),
            'ket_ekonomi' => $this->request->getVar('ket_ekonomi'),
            'pramuka' => $this->request->getVar('pramuka'),
            'olahraga' => $this->request->getVar('olahraga'),
            'pmr' => $this->request->getVar('pmr'),
            'sikap_spiritual' => $this->request->getVar('sikap_spiritual'),
            'sikap_sosial' => $this->request->getVar('sikap_sosial'),
            'sakit' => $this->request->getVar('sakit'),
            'izin' => $this->request->getVar('izin'),
            'tanpa_keterangan' => $this->request->getVar('tanpa_keterangan'),
            'semester' => $this->request->getVar('semester'),

        ];
        $this->nilaiModel->update($id, $data);
        $response = [
            'message' => [
                'success' => 'data berhasil diubah'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function getNilai()
    {
        $data = [
            'message' => 'succes',
            'data' => $this->nilaiModel
                ->select('nama,pend_agama,pend_pancasila,bahasa_indo,
                mtk,sejarah_indo,bahasa_ing,seni_budaya,penjas,prakarya_dan_kwh,
                biologi,fisika,kimia,sosiologi,ekonomi,ket_pend_agama,ket_pend_pancasila,
                ket_bahasa_indo,ket_matematika,ket_sejarah_indo,ket_bahasa_ing,
                ket_seni_budaya,ket_penjas,ket_prakarya_dan_kwh,ket_biologi,ket_fisika,
                ket_kimia,ket_sosiologi,ket_ekonomi,pramuka,olahraga,pmr,sikap_spiritual,sikap_sosial,
                sakit,izin,tanpa_keterangan,semester')
                // ->join('alternatif', 'tb_users.id_users=alternatif.users_id')
                ->join('tb_users', 'tb_users.id_users=alternatif.users_id', 'left')
                ->join('tb_data_diri', 'tb_data_diri.users_id=tb_users.id_users', 'left')
                ->where('alternatif.users_id', $this->user())->findAll()
        ];
        return $this->respond($data, 200);
    }
    public function minMax()
    {
        $db = \Config\Database::connect();
        $agama = $db->table('alternatif')->selectMax('pend_agama')->get()->getRow()->pend_agama;
        $pancasila = $db->table('alternatif')->selectMax('pend_pancasila')->get()->getRow()->pend_pancasila;
        $bindo = $db->table('alternatif')->selectMax('bahasa_indo')->get()->getRow()->bahasa_indo;
        $mtk = $db->table('alternatif')->selectMax('mtk')->get()->getRow()->mtk;
        $sejarah = $db->table('alternatif')->selectMax('sejarah_indo')->get()->getRow()->sejarah_indo;
        $bing = $db->table('alternatif')->selectMax('bahasa_ing')->get()->getRow()->bahasa_ing;
        $seniBudaya = $db->table('alternatif')->selectMax('seni_budaya')->get()->getRow()->seni_budaya;
        $penjas = $db->table('alternatif')->selectMax('penjas')->get()->getRow()->penjas;
        $prakarya_dan_kwh = $db->table('alternatif')->selectMax('prakarya_dan_kwh')->get()->getRow()->prakarya_dan_kwh;
        $biologi = $db->table('alternatif')->selectMax('biologi')->get()->getRow()->biologi;
        $fisika = $db->table('alternatif')->selectMax('fisika')->get()->getRow()->fisika;
        $kimia = $db->table('alternatif')->selectMax('kimia')->get()->getRow()->kimia;
        $sosiologi = $db->table('alternatif')->selectMax('sosiologi')->get()->getRow()->sosiologi;
        $ekonomi = $db->table('alternatif')->selectMax('ekonomi')->get()->getRow()->ekonomi;
        $ketAgama = $db->table('alternatif')->selectMax('ket_pend_agama')->get()->getRow()->ket_pend_agama;
        $ketPancasila = $db->table('alternatif')->selectMax('ket_pend_pancasila')->get()->getRow()->ket_pend_pancasila;
        $kBindo = $db->table('alternatif')->selectMax('ket_bahasa_indo')->get()->getRow()->ket_bahasa_indo;
        $kMtk = $db->table('alternatif')->selectMax('ket_matematika')->get()->getRow()->ket_matematika;
        $kSejarah = $db->table('alternatif')->selectMax('ket_sejarah_indo')->get()->getRow()->ket_sejarah_indo;
        $kBing = $db->table('alternatif')->selectMax('ket_bahasa_ing')->get()->getRow()->ket_bahasa_ing;
        $kSeniBudaya = $db->table('alternatif')->selectMax('ket_seni_budaya')->get()->getRow()->ket_seni_budaya;
        $kPenjas = $db->table('alternatif')->selectMax('ket_penjas')->get()->getRow()->ket_penjas;
        $kPrakarya_dan_kwh = $db->table('alternatif')->selectMax('ket_prakarya_dan_kwh')->get()->getRow()->ket_prakarya_dan_kwh;
        $kBiologi = $db->table('alternatif')->selectMax('ket_biologi')->get()->getRow()->ket_biologi;
        $kFisika = $db->table('alternatif')->selectMax('ket_fisika')->get()->getRow()->ket_fisika;
        $kKimia = $db->table('alternatif')->selectMax('ket_kimia')->get()->getRow()->ket_kimia;
        $kSosiologi = $db->table('alternatif')->selectMax('ket_sosiologi')->get()->getRow()->ket_sosiologi;
        $kEkonomi = $db->table('alternatif')->selectMax('ket_ekonomi')->get()->getRow()->ket_ekonomi;
        $pramuka = $db->table('alternatif')->selectMax('pramuka')->get()->getRow()->pramuka;
        $olahraga = $db->table('alternatif')->selectMax('olahraga')->get()->getRow()->olahraga;
        $pmr = $db->table('alternatif')->selectMax('pmr')->get()->getRow()->pmr;
        $sikapSpiritual = $db->table('alternatif')->selectMax('sikap_spiritual')->get()->getRow()->sikap_spiritual;
        $sikapSosial = $db->table('alternatif')->selectMax('sikap_sosial')->get()->getRow()->sikap_sosial;
        $sakit = $db->table('alternatif')->selectMax('sakit')->get()->getRow()->sakit;
        $izin = $db->table('alternatif')->selectMin('izin')->get()->getRow()->izin;
        $tanpaKet = $db->table('alternatif')->selectMax('tanpa_keterangan')->get()->getRow()->tanpa_keterangan;

        $bobot = 0.0277777777777778;
        $bobotAbsen = -0.0277777777777778;

        // foreach ($db->table('alternatif')->get()->getResult() as $nilai) :
        //     $data[] = [
        //         'users_id' => $nilai->users_id,
        //         // 'pend_agama' => $nilai->pend_agama / $agama,
        //         // 'pend_pancasila' => $nilai->pend_pancasila / intval($pancasila),
        //         // 'izin' => $izin / intval($nilai->izin),
        //         'hasil' => (($nilai->pend_agama / $agama) * $bobot) + ($nilai->pend_pancasila / intval($pancasila) * $bobot) + ($izin / intval($nilai->izin) * $bobot)
        //     ];
        // endforeach;
        $data = $db->table('alternatif')->select('
        alternatif.users_id,tb_data_diri.nama,
        ((pend_agama / ' . $agama . ') * ' . $bobot . ')+
        ((pend_pancasila / ' . $pancasila . ')* ' . $bobot . ')+
        ((bahasa_indo / ' . $bindo . ') * ' . $bobot . ')+
        ((mtk / ' . $mtk . ')* ' . $bobot . ')+
        ((sejarah_indo / ' . $sejarah . ') * ' . $bobot . ')+
        ((bahasa_ing / ' . $bing . ')* ' . $bobot . ')+
        ((seni_budaya / ' . $seniBudaya . ') * ' . $bobot . ')+
        ((penjas / ' . $penjas . ')* ' . $bobot . ')+
        ((prakarya_dan_kwh / ' . $prakarya_dan_kwh . ') * ' . $bobot . ')+
        ((biologi / ' . $biologi . ')* ' . $bobot . ')+
        ((fisika / ' . $fisika . ') * ' . $bobot . ')+
        ((kimia / ' . $kimia . ')* ' . $bobot . ')+
        ((sosiologi / ' . $sosiologi . ') * ' . $bobot . ')+
        ((ekonomi / ' . $ekonomi . ')* ' . $bobot . ')+
        ((ket_pend_agama / ' . $ketAgama . ') * ' . $bobot . ')+
        ((ket_pend_pancasila / ' . $ketPancasila . ')* ' . $bobot . ')+
        ((ket_bahasa_indo / ' . $kBindo . ') * ' . $bobot . ')+
        ((ket_matematika / ' . $kMtk . ')* ' . $bobot . ')+
        ((ket_sejarah_indo / ' . $kSejarah . ') * ' . $bobot . ')+
        ((ket_bahasa_ing / ' . $kBing . ')* ' . $bobot . ')+
        ((ket_seni_budaya / ' . $kSeniBudaya . ') * ' . $bobot . ')+
        ((ket_penjas / ' . $kPenjas . ')* ' . $bobot . ')+
        ((ket_prakarya_dan_kwh / ' . $kPrakarya_dan_kwh . ') * ' . $bobot . ')+
        ((ket_biologi / ' . $kBiologi . ')* ' . $bobot . ')+
        ((ket_fisika / ' . $kFisika . ') * ' . $bobot . ')+
        ((ket_kimia / ' . $kKimia . ')* ' . $bobot . ')+
        ((ket_sosiologi / ' . $kSosiologi . ') * ' . $bobot . ')+
        ((ket_ekonomi / ' . $kEkonomi . ')* ' . $bobot . ')+
        ((pramuka / ' . $pramuka . ')* ' . $bobot . ')+
        ((olahraga / ' . $olahraga . ') * ' . $bobot . ')+
        ((pmr / ' . $pmr . ')* ' . $bobot . ')+
        ((sikap_spiritual / ' . $sikapSpiritual . ') * ' . $bobot . ')+
        ((sikap_sosial / ' . $sikapSosial . ')* ' . $bobot . ')+
        ((' . $sakit . '/sakit  ) * ' . $bobotAbsen . ')+
        ((' . $izin . ' / izin) * ' . $bobotAbsen . ')+
        ((' . $tanpaKet . ' /tanpa_keterangan )* ' . $bobotAbsen . ')
        as hasil
         ', false)
            ->join('tb_data_diri', 'tb_data_diri.users_id=alternatif.users_id', 'left')
            ->orderBy('hasil', 'desc')->get()->getResultArray();
        return $this->respond($data, 200);
    }
    public function getDetail($id = null)
    {
        $data = [
            'message' => 'succes',
            'data' => $this->nilaiModel
                ->select('nama,nisn,pend_agama,pend_pancasila,bahasa_indo,
                    mtk,sejarah_indo,bahasa_ing,seni_budaya,penjas,prakarya_dan_kwh,
                    biologi,fisika,kimia,sosiologi,ekonomi,ket_pend_agama,ket_pend_pancasila,
                    ket_bahasa_indo,ket_matematika,ket_sejarah_indo,ket_bahasa_ing,
                    ket_seni_budaya,ket_penjas,ket_prakarya_dan_kwh,ket_biologi,ket_fisika,
                    ket_kimia,ket_sosiologi,ket_ekonomi,pramuka,olahraga,pmr,sikap_spiritual,sikap_sosial,
                    sakit,izin,tanpa_keterangan,semester')
                ->join('tb_data_diri', 'tb_data_diri.users_id=alternatif.users_id', 'left')
                ->where('alternatif.users_id', $id)->findAll()
        ];
        return $this->respond($data, 200);
    }
}
