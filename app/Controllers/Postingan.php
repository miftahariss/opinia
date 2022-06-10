<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PostinganModel;
use App\Models\PostTypeModel;
use App\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Postingan extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new PostinganModel();
        $postingan = $model->where("status", 1)->orderBy('id', 'DESC')->findAll();

        foreach($postingan as $key => $value){
            $model2 = new PostTypeModel();
            $post_type = $model2->where("id", $value['post_type'])->first();

            if($post_type){
                $postingan[$key]['post_type'] = array('jenis' => $post_type['jenis'], 'post_type' => $post_type['post_type']);
            } else {
                $postingan[$key]['post_type'] = "Unknown";
            }

            $model3 = new UserModel();
            $user = $model3->where("id", $value['user'])->first();

            if($user){
                $postingan[$key]['user'] = array('fullname' => $user['fullname'], 'phone' => $user['phone'], 'email' => $user['email']);
            } else {
                $postingan[$key]['user'] = "Unknown";
            }
        }

        return $this->respond([
            'code' => 200,
            'message' => 'Postingan found!',
            'data' => $postingan
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
            'title' => 'required',
            'description' => 'required',
            'post_type_id' => 'required',
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $key = getenv('TOKEN_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        $token = explode(' ', $header)[1];
        $decoded = JWT::decode($token, new Key($key, 'HS256'));

        $data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'post_type' => $this->request->getVar('post_type_id'),
            'user' => $decoded->uid,
            'status' => 1
        ];
        $model = new PostinganModel();
        $created = $model->save($data);
        $this->respondCreated($created);
        return $this->respond([
            'code' => 200,
            'message' => 'Postingan Successfully created!'
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
            'title' => 'required',
            'description' => 'required',
            'post_type_id' => 'required',
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new PostinganModel();
        $postingan = $model->where("id", $this->request->getVar('id'))->first();
        if(!$postingan) return $this->failNotFound('Postingan Not Found');

        $model2 = new PostTypeModel();
        $post_type = $model2->where("id", $this->request->getVar('post_type_id'))->first();
        if(!$post_type) return $this->failNotFound('Post Type Not Found');
        
        $data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'post_type' => $this->request->getVar('post_type_id')
        ];

        $model->update($this->request->getVar('id'), $data);

        return $this->respond([
            'code' => 200,
            'message' => 'Postingan Successfully updated!'
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

        $model = new PostinganModel();
        $postingan = $model->where("id", $this->request->getVar('id'))->first();
        if(!$postingan) return $this->failNotFound('Postingan Not Found');
        
        $data = [
            'status' => 0
        ];

        $model->update($this->request->getVar('id'), $data);

        return $this->respond([
            'code' => 200,
            'message' => 'Postingan Successfully deleted!'
        ]);
    }
}
