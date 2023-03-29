<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_barang', 'qty'];

    public function getCart()
    {
        $sql = "SELECT c.id, b.nama_barang, b.gambar, b.harga, c.qty, c.id_barang, (b.harga * c.qty) as subtotal FROM {$this->table} c JOIN barang b ON c.id_barang = b.id";
        return $this->db->query($sql)->getResult();
    }

    public function getCartById($id)
    {
        $sql = "SELECT c.id, b.nama_barang, b.harga, c.qty, (b.harga * c.qty) as subtotal FROM {$this->table} c JOIN barang b ON c.id_barang = b.id WHERE c.id = :id:";
        return $this->db->query($sql, ['id' => $id])->getRow();
    }

    public function getCartByBarangId($id_barang)
    {
        $sql = "SELECT c.id, b.nama_barang, b.harga, c.qty, (b.harga * c.qty) as subtotal FROM {$this->table} c JOIN barang b ON c.id_barang = b.id WHERE c.id_barang = :id_barang:";
        return $this->db->query($sql, ['id_barang' => $id_barang])->getRow();
    }

    public function getCartTotal()
    {
        $sql = "SELECT SUM(b.harga * c.qty) as total FROM {$this->table} c JOIN barang b ON c.id_barang = b.id";
        return $this->db->query($sql)->getRow();
    }

    public function getCartCount()
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        return $this->db->query($sql)->getRow();
    }

    public function insertCart($data)
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function updateCart($id, $data)
    {
        $this->db->table($this->table)->update($data, ['id' => $id]);
        return $this->db->affectedRows();
    }
    public function deleteCartAll()
    {
        $this->db->table($this->table)->emptyTable();
    }
}
