<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kemeja extends Model
{
    protected $table = 'kemeja';
    protected $primaryKey = 'idkemeja';

    protected $allowedFields = [
        'namabrg',
        'harga',
        'diskon',
        'stok',
        'namafile',
        'berat'
    ];

    public function search($keyword)
    {
        return $this->table('kemeja')->like('namabrg', $keyword)->orLike('harga', $keyword);
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }


    public function getStok()
    {
        $query = $this->db->query("SELECT stok FROM kemeja");
        return $query->getRowArray();
    }

    public function updateBarang($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('idkemeja' => $id));
        return $query;
    }
}
