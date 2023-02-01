<?php

namespace App\Controllers;

use App\Models\SingerModel;
use CodeIgniter\RESTful\ResourceController;

class SingerController extends ResourceController
{
    protected $modelName = 'App\Models\SingerModel';
    protected $format    = 'json';

    // show singer list
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }

    // add user form
    public function new()
    {
        return view('../../../Frontend/views/add_singer.php');
    }

    // insert data
    public function create()
    {
        helper(['form', 'url']);

        $model = new SingerModel();        

        $data = [
            'name' => $this->request->getVar('name'),
            'birthday' => $this->request->getVar('birthday'),
            'biography' => $this->request->getVar('biography'),
            'photo' => NULL,
            'gender' => $this->request->getVar('gender'),
        ];
        $model->insert($data);

        $query = ['name' => $this->request->getVar('name'), 'birthday' => $this->request->getVar('birthday'), 'biography' => $this->request->getVar('biography')];
        $newUser = $model->where($query)->first();

        $file = $this->request->getFile('file');
        $data['fileType'] = $file->getClientMimeType();
        $ext = explode('/', $data['fileType']);
        $fileName = "photo-" . (string)$newUser['id'] . "." . $ext[1];
        $data['fileName'] = $file->getName();
        $data['randomName'] = $fileName;
        $file->move('public/uploads', $fileName);

        $data = [
            'photo'  => $fileName,
        ];
        $model->update($newUser['id'], $data);

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Singer created successfully'
            ]
        ];

        return $this->response->redirect(site_url('/'));
    }

    // show single singer
    public function show($id = null)
    {
        $model = new SingerModel();
        $data['singer_obj'] = $model->where('id', $id)->first();
        if ($data) {
            //$this->respond($data);
            return view('../../../Frontend/views/edit_singer.php', $data);
        } else {
            return $this->failNotFound('No singer found');
        }
    }

    // update singer data
    public function update($id = null)
    {
        $model = new SingerModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'birthday'  => $this->request->getVar('birthday'),
            'biography'  => $this->request->getVar('biography'),
            'photo'  => $this->request->getVar('photo'),
            'gender'  => $this->request->getVar('gender'),
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Singer updated successfully'
            ]
        ];
        return $this->response->redirect(site_url('/'));
    }

    // delete singer
    public function delete($id = null)
    {
        $model = new SingerModel();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Singer successfully deleted'
                ]
            ];
            return $this->response->redirect(site_url('/'));
        } else {
            return $this->failNotFound('No singer found');
        }
    }

    function upload() { 
        helper(['form', 'url']);
         
        $database = \Config\Database::connect();
        $db = $database->table('users');
    
        $input = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png]',
                'max_size[file,1024]',
            ]
        ]);
    
        if (!$input) {
            print_r('Choose a valid file');
        } else {
            $img = $this->request->getFile('file');
            $img->move(WRITEPATH . 'uploads');
    
            $data = [
               'name' =>  $img->getName(),
               'type'  => $img->getClientMimeType()
            ];
    
            $save = $db->insert($data);
            print_r('File has successfully uploaded');        
        }
    }
}
