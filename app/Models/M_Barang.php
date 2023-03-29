<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_barang', 'harga', 'stok', 'gambar', 'barcode'
    ];

    public function search($keyword)
    {
        return $this->table('barang')->like('nama_barang', $keyword)->orLike('harga', $keyword)->orLike('stok', $keyword)->orLike('gambar', $keyword);
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }


    public function getStok()
    {
        $query = $this->db->query("SELECT stok FROM barang");
        return $query->getRowArray();
    }

    public function updateBarang($id, $data)
    {
        $this->db->table($this->table)->update($data, ['id' => $id]);
    }
}
