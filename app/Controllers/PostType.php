<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PostTypeModel;

class PostType extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new PostTypeModel();
        $post_type = $model->where("status", 1)->findAll();

        return $this->respond([
            'code' => 200,
            'message' => 'Post Type found!',
            'data' => $post_type
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'jenis' => 'required',
            'type' => 'required',
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $data = [
            'jenis' => $this->request->getVar('jenis'),
            'post_type' => $this->request->getVar('type'),
            'status' => 1
        ];
        $model = new PostTypeModel();
        $created = $model->save($data);
        $this->respondCreated($created);
        return $this->respond([
            'code' => 200,
            'message' => 'Post Type Successfully created!'
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'id' => 'required',
            'jenis' => 'required',
            'type' => 'required',
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new PostTypeModel();
        $post_type = $model->where("id", $this->request->getVar('id'))->first();
        if(!$post_type) return $this->failNotFound('Post Type Not Found');
        
        $data = [
            'jenis' => $this->request->getVar('jenis'),
            'post_type' => $this->request->getVar('type'),
        ];

        $model->update($this->request->getVar('id'), $data);

        return $this->respond([
            'code' => 200,
            'message' => 'Post Type Successfully updated!'
        ]);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        helper(['form']);
        $rules = [
            'id' => 'required'
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new PostTypeModel();
        $post_type = $model->where("id", $this->request->getVar('id'))->first();
        if(!$post_type) return $this->failNotFound('Post Type Not Found');
        
        $data = [
            'status' => 0
        ];

        $model->update($this->request->getVar('id'), $data);

        return $this->respond([
            'code' => 200,
            'message' => 'Post Type Successfully deleted!'
        ]);
    }
}
