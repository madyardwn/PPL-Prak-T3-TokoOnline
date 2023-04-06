<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;

class C_Cart extends BaseController
{
  protected $cart;
  protected $barang;
  protected $penjualan;
  protected $transaksi;

  public function __construct()
  {
    $this->barang = new \App\Models\M_Barang();
    $this->penjualan = new \App\Models\M_Penjualan();
    $this->transaksi = new \App\Models\M_Transaksi();
    $this->cart = session()->has('cart') ? session()->get('cart') : [
      'items' => [],
      'total' => 0
    ];
  }

  public function index()
  {
    $data = [
      'title' => 'Cart',
      'cart' => $this->cart['items'],
      'total' => $this->cart['total']
    ];

    return view('cart/v_index', $data);
  }

  public function add($id)
  {
    $barang = $this->barang->find($id);

    if (session()->has('cart')) {
      $items = $this->cart['items'];
      $index = array_search($id, array_column($items, 'id'));

      if (!($items[$index]['qty'] < $barang['stok'])) {
        session()->setFlashdata('pesan', 'Stok barang tidak mencukupi');
        return redirect()->to(base_url('barang/cart'));
      }

      if ($index !== false) {
        $items[$index]['qty']++;
        $items[$index]['subtotal'] += $barang['harga'];
        $this->cart['items'] = $items;
        $this->cart['total'] += $barang['harga'];
      } else {
        $data = [
          'id' => $barang['id'],
          'nama' => $barang['nama_barang'],
          'gambar' => $barang['gambar'],
          'harga' => $barang['harga'],
          'qty' => 1,
          'subtotal' => $barang['harga']
        ];

        array_push($this->cart['items'], $data);
        $this->cart['total'] += $barang['harga'];
      }
    } else {

      if (!($barang['stok'] > 0)) {
        session()->setFlashdata('pesan', 'Stok barang tidak mencukupi');
        return redirect()->to(base_url('barang/cart'));
      }

      $data = [
        'id' => $barang['id'],
        'nama' => $barang['nama_barang'],
        'gambar' => $barang['gambar'],
        'harga' => $barang['harga'],
        'qty' => 1,
        'subtotal' => $barang['harga']
      ];

      $this->cart = [
        'items' => [$data],
        'total' => $barang['harga']
      ];
    }

    session()->set('cart', $this->cart);
    return redirect()->to(base_url('barang/cart'));
  }

  public function reduce($id)
  {
    $barang = $this->barang->find($id);

    if (session()->has('cart')) {
      $items = $this->cart['items'];
      $index = array_search($id, array_column($items, 'id'));

      if ($index !== false) {
        if ($items[$index]['qty'] > 1) {
          $items[$index]['qty']--;
          $items[$index]['subtotal'] = $items[$index]['qty'] * $items[$index]['harga'];
          $this->cart['items'] = $items;
          $this->cart['total'] -= $barang['harga'];
        } else {
          array_splice($items, $index, 1);
          $this->cart['items'] = $items;
          $this->cart['total'] -= $barang['harga'];
        }
      }
    }

    session()->set('cart', $this->cart);
    return redirect()->to(base_url('barang/cart'));
  }

  public function checkoutForm()
  {
    $data = [
      'title' => 'Checkout',
      'cart' => $this->cart['items'],
      'total' => $this->cart['total']
    ];

    if (session()->has('cart')) {
      return view('cart/v_checkout', $data);
    } else {
      session()->setFlashdata('pesan', 'Cart masih kosong');
      return redirect()->to(base_url('barang'));
    }
  }

  // checkout cart
  public function checkout()
  {
    $validation = \Config\Services::validation();

    // Validasi input
    $validation->setRules([
      'nama' => [
        'label' => 'Nama Pembeli',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],
      'alamat' => [
        'label' => 'Alamat',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],
      'kecamatan' => [
        'label' => 'Kecamatan',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],
      'kota' => [
        'label' => 'Kota',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],
      'nomor_telepon' => [
        'label' => 'Nomor Telepon',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],
    ]);

    if (!$validation->run($this->request->getPost())) {
      // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
      session()->setFlashdata('nama', $validation->getErrors());
      return redirect()->to(base_url('barang/cart/checkout'));
    }

    if (session()->has('cart')) {
      $items = $this->cart['items'];

      $no_transaksi = 'TRX' . date('YmdHis');

      $data = [
        'no_transaksi' => $no_transaksi,
        'total_transaksi' => $this->cart['total'],
        'nama_pembeli' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'kecamatan' => $this->request->getPost('kecamatan'),
        'kota' => $this->request->getPost('kota'),
        'nomor_telepon' => $this->request->getPost('nomor_telepon'),
        'tanggal_transaksi' => date('Y-m-d H:i:s')
      ];
      $this->transaksi->insert($data);

      foreach ($items as $item) {
        $data = [
          'no_transaksi' => $no_transaksi,
          'id_barang' => $item['id'],
          'jumlah_jual' => $item['qty'],
          'harga_jual' => $item['harga']
        ];

        $this->barang->update($item['id'], ['stok' => $this->barang->find($item['id'])['stok'] - $item['qty']]);
        $this->penjualan->insert($data);
      }

      session()->remove('cart');
      session()->setFlashdata('pesan', 'Checkout berhasil');
      return redirect()->to(base_url('barang'));
    } else {
      session()->setFlashdata('pesan', 'Cart masih kosong');
      return redirect()->to(base_url('barang'));
    }
  }

  public function destroy()
  {
    session()->remove('cart');
    session()->setFlashdata('pesan', 'Cart berhasil dihapus');
    return redirect()->to(base_url('barang'));
  }
}
