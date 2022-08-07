<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\API\ResponseTrait;

class MyApp extends BaseController
{
    protected $Mahasiswa;
    use ResponseTrait;

    public function __construct()
    {
        $this->Mahasiswa = new MahasiswaModel();
    }
    
    public function index()
    {
        $data = array(
            'mahasiswa' => $this->Mahasiswa->orderBy("nama_mahasiswa", "ASC")->paginate('10', 'mahasiswa')
        );
        return view('/myapp/index', $data);
    }

    function add()
    {
        return view('/myapp/add');
    }

    function prosesAdd()
    {
        if (!$this->request->getVar()) {
            return redirect()->to('/MyApp');
        }

        $date = date("Ymd");
        $dateTime = date("Y-m-d H:i:s");

        $nim = $this->request->getVar('nim');

        if (!$nim) {
            session()->setFlashdata('message', 'NIM tidak boleh kosong');
            return redirect()->to('/MyApp');
        }

        $cekNim  = $this->Mahasiswa->getWhere(['nim'=>$nim])->getResult();

        if ($cekNim) {
            session()->setFlashdata('message', 'NIM = "'.$nim.'" sudah digunakan');
            return redirect()->to('/MyApp');
        }

        $aSave = [
            'id' => $this->CustomLibrary->uuid(),
            'nim' => $this->request->getVar('nim'),
            'nama_mahasiswa' => $this->request->getVar('nama_mahasiswa'),
            'jurusan' => $this->request->getVar('jurusan')
        ];

        // d($aSave);
        // die();

        $this->Mahasiswa->insert($aSave);
        session()->setFlashdata('message', 'Data Berhasil Ditambahkan');
        return redirect()->to('/MyApp');
    }

    // API
    function createMahasiswa()
    {
        $data = [
            'id' => $this->CustomLibrary->uuid(),
            'nim' => $this->request->getPost('nim'),
            'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
            'jurusan' => $this->request->getPost('jurusan')
        ];
        $this->Mahasiswa->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
        return $this->respondCreated($response, 201);
    }

    function showMahasiswa($nim = null)
    {
        $getMethod = strtoupper($this->request->getMethod());
        if ($getMethod == 'GET') {
            if ($nim) {
                $data  = $this->Mahasiswa->getWhere(['nim'=>$nim])->getResult();
            } else {
                $data = $this->Mahasiswa->orderBy('nim ASC')->findAll();
            }
    
            if ($data) {
                return $this->respond($data);
            } else {
                if ($nim) {
                    $response = [
                        'status'   => 200,
                        'error'    => null,
                        'messages' => [
                            'success' => 'nim = '.$nim.', Not Found!'
                        ]
                    ];
                    return $this->respond($response);
                }
            }
        } else {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Method Only GET, Failed Request!'
                ]
            ];
            return $this->respond($response);
        }

    }

    function deleteMahasiswa($nim) 
    {
        $data = $this->Mahasiswa->getWhere(['nim' => $nim])->getResult();
        if ($data) {
            // $this->Mahasiswa->delete(['nim' => $nim]);
            $this->Mahasiswa->where('nim', $nim);
            $this->Mahasiswa->delete();
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'nim '.$nim.' Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('nim = '.$nim.', Not Found!');
        }

    }

    function updateMahasiswa($nim)
    {
        $data = $this->Mahasiswa->getWhere(['nim' => $nim])->getResult();
        if ($data) {
            $json = $this->request->getJSON();
            if($json){
                $aUpdate = [
                    'nim' => $nim,
                    'nama_mahasiswa' => $json->nama_mahasiswa,
                    'jurusan' => $json->jurusan
                ];
            }else{
                $input = $this->request->getRawInput();
                $aUpdate = [
                    'nim' => $nim,
                    'nama_mahasiswa' => $input['nama_mahasiswa'],
                    'jurusan' => $input['jurusan']
                ];
            }
                        
            $this->Mahasiswa->update($nim, $aUpdate);

            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Updated'
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('nim = '.$nim.', Not Found!');
        }
    }
    // end API
}
