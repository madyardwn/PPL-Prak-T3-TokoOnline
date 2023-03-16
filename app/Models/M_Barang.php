<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_barang', 'harga', 'stok', 'gambar'
    ];

    public function get()
    {
        $sql = "SELECT * FROM {$this->table}";

        $db = db_connect();
        $data = $db->query($sql);

        return $data->getResultArray();
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (nama_barang, harga, stok, gambar) VALUES (:nama_barang:, :harga:, :stok:, :gambar:)";

        $db = db_connect();
        $db->query($sql, $data);
    }

    public function id($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = " . $id;

        $db = db_connect();
        $data = $db->query($sql);

        return $data->getRowArray();
    }

    public function edit($data, $id)
    {
        $sql = "UPDATE {$this->table} SET nama_barang = :nama_barang:, harga = :harga:, stok = :stok:, gambar = :gambar: WHERE id = " . $id;

        $db = db_connect();
        $db->query($sql, $data);
    }

    public function search($keyword)
    {
        return $this->table('barang')->like('nama_barang', $keyword)->orLike('harga', $keyword)->orLike('stok', $keyword)->orLike('gambar', $keyword);
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }
}
