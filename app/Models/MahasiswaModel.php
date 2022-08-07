<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'nim', 'nama_mahasiswa', 'jurusan', 'created_at', 'updated_at'];

    public function getMahasiswa($id = null, $from = null)
    {
        if ($id == null) {
            return $this->orderBy('nim ASC')->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }
}
