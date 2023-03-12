<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\PelajaranModel;
use CodeIgniter\RESTful\ResourceController;

class Pelajaran extends ResourceController
{
    use ResponseTrait;
    public function __construct()

    {
        $this->pelajaranModel = new PelajaranModel();
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
            'data' => $this->pelajaranModel->findAll()
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
        $data = [
            'message' => 'succes',
            'data' => $this->pelajaranModel->find($id)
        ];
        return $this->respond($data, 200);
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

        $data = $this->request->getVar();
        $this->pelajaranModel->insert($data);
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

        $data = $this->request->getVar();
        $this->pelajaranModel->update($id, $data);
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
        $this->pelajaranModel->delete($id);
        $response = [
            'message' => [
                'success' => 'data berhasil dihapus'
            ]
        ];
        return $this->respondDeleted($response);
    }

    public function validation($id = null)
    {
        return $this->validate([
            'nama_pelajaran' => [
                'rules' => "required|alpha_numeric_punct|max_length[200]|is_unique[tb_pelajaran.nama_pelajaran,id_pelajaran,{$id}]",
                'errors' => [
                    'required' => 'pelajaran harus diisi',
                    'is_unique' => 'pelajaran sudah ada'
                ]
            ]
        ]);
    }
}
