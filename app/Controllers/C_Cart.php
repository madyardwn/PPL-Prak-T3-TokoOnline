<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Cart extends BaseController
{
  protected $cart;
  protected $barang;

  public function __construct()
  {
    $this->barang = new \App\Models\M_Barang();
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

      if ($index !== false) {
        $items[$index]['qty']++;
        $items[$index]['subtotal'] = $items[$index]['qty'] * $items[$index]['harga'];
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

  // checkout cart
  public function checkout()
  {
    if (session()->has('cart')) {
      // langsung checkout saja

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
