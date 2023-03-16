<?php

namespace App\Controllers;

use App\Models\DataDiriModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class DataDiriController extends ResourceController
{
    use ResponseTrait;
    public function __construct()

    {
        $this->dataDiriModel = new DataDiriModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'message' => 'succes',
            'data' => $this->dataDiriModel->select('nama,nip,jabatan')->where('users_id', $this->user())->findAll()
        ];
        return $this->respond($data, 200);
    }
    public function indexSiswa()
    {
        $data = [
            'message' => 'succes',
            'data' => $this->dataDiriModel->select('nisn,nama,jenis_kelamin,agama,kelas,alamat')->where('users_id', $this->user())->findAll()
        ];
        return $this->respond($data, 200);
    }


    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        if (!$this->validation()) return $this->fail($this->validator->getErrors());

        $data = [
            'users_id' => $this->user(),
            'nisn' => $this->request->getVar('nisn'),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' => $this->request->getVar('agama'),
            'kelas' => $this->request->getVar('kelas'),
            'alamat' => $this->request->getVar('alamat'),
            'nip' => $this->request->getVar('nip'),
            'jabatan' => $this->request->getVar('jabatan')

        ];
        $this->dataDiriModel->insert($data);
        $response = [
            'message' => [
                'success' => 'data berhasil disimpan'
            ]
        ];
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if (!$this->validation($id)) return $this->fail($this->validator->getErrors());
        $data = [
            'nisn' => $this->request->getVar('nisn'),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' => $this->request->getVar('agama'),
            'kelas' => $this->request->getVar('kelas'),
            'alamat' => $this->request->getVar('alamat'),
            'nip' => $this->request->getVar('nip'),
            'jabatan' => $this->request->getVar('jabatan')

        ];
        $this->dataDiriModel->update($id, $data);
        $response = [
            'message' => [
                'success' => 'data berhasil diubah'
            ]
        ];
        return $this->respondUpdated($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
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
    public function validation($id = null)
    {
        return $this->validate([
            'nisn' => [
                'rules' => "permit_empty|alpha_numeric_punct|max_length[200]|is_unique[tb_data_diri.nisn,id_data_diri,{$id}]",
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'nama' => [
                'rules' => "required|alpha_numeric_punct|max_length[200]",
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => "permit_empty|alpha_numeric_punct|max_length[200]",
                'errors' => [
                    'required' => '{field} harus diisi',

                ]
            ],
            'agama' => [
                'rules' => "permit_empty|alpha_numeric_punct|max_length[200]",
                'errors' => [
                    'required' => '{field} harus diisi',

                ]
            ],
            'kelas' => [
                'rules' => "permit_empty|alpha_numeric_punct|max_length[200]",
                'errors' => [
                    'required' => '{field} harus diisi',

                ]
            ],
            'alamat' => [
                'rules' => "permit_empty|alpha_numeric_punct|max_length[200]",
                'errors' => [
                    'required' => '{field} harus diisi',

                ]
            ],
            'nip' => [
                'rules' => "permit_empty|alpha_numeric_punct|max_length[200]",
                'errors' => [
                    'required' => '{field} harus diisi',

                ]
            ],
            'jabatan' => [
                'rules' => "permit_empty|alpha_numeric_punct|max_length[200]",
                'errors' => [
                    'required' => '{field} harus diisi',

                ]
            ],

        ]);
    }
}
