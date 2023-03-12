<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class Users extends ResourceController
{
    use ResponseTrait;
    public function __construct()

    {
        $this->usersModel = new UsersModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
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
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'sebagai' => $this->request->getVar("sebagai")
        ];
        $this->usersModel->insert($data);
        $response = [
            'message' => [
                'success' => 'data berhasil disimpan'
            ]
        ];
        return $this->respondCreated($response);
    }
    public function login()
    {
        $rules = [
            'username' => 'required', 'password' => 'required',
        ];
        $users = $this->usersModel->where('username', $this->request->getVar('username'))->first();
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }
        if (!$users) {
            return $this->failNotFound('user tidak terdaftar');
        }
        $db = \Config\Database::connect();
        $check = $db->table('tb_users')->where('username', $users['username'])->get()->getRow()->password;
        $password = password_verify($this->request->getVar('password'), $check);
        // if ($users['password'] != $this->request->getVar('password'))
        if (!$password) {
            return $this->failNotFound('password salah');
        }


        $key = getenv('TOKEN_SECRET');
        $payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => time(),
            'exp' => time() + (60 * 60),
            'id_users' => $users['id_users']
        ];
        $token = JWT::encode($payload, $key, 'HS256');

        $data = [
            'token' => $token
        ];
        return $this->respond($data);
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
        //
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

    public function validation($id = null)
    {
        return $this->validate([
            'username' => [
                'rules' => "required|alpha_numeric_punct|max_length[200]|is_unique[tb_users.username,id_users,{$id}]",
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'password' => [
                'rules' => "required|alpha_numeric_punct|max_length[200]",
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'sebagai' => [
                'rules' => "required|alpha_numeric_punct|max_length[200]",
                'errors' => [
                    'required' => '{field} harus diisi',

                ]
            ],

        ]);
    }
}
