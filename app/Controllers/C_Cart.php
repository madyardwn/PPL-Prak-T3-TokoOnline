<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Cart extends BaseController
{
  protected $cart;
  protected $barang;

  public function __construct()
  {
    $this->cart = new \App\Models\M_Cart();
    $this->barang = new \App\Models\M_Barang();
  }

  public function index()
  {
    $data = [
      'title' => 'Cart',
      'cart' => $this->cart->getCart(),
      'total' => $this->cart->getCartTotal(),
      'count' => $this->cart->getCartCount(),
      'barang' => $this->barang->findAll(),
    ];

    return view('cart/v_index', $data);
  }

  public function add($id)
  {
    $barang = $this->barang->find($id);
    $cart = $this->cart->getCartByBarangId($id);

    if ($cart) {
      $this->cart->updateCart($cart->id, ['qty' => $cart->qty + 1]);
    } else {
      $data = [
        'id_barang' => $barang['id'],
        'qty' => 1,
      ];

      $this->cart->insertCart($data);
    }

    return redirect()->to('/barang');
  }

  public function update($id)
  {
    $qty = $this->request->getPost('qty');
    $this->cart->updateCart($id, ['qty' => $qty]);

    return redirect()->to('/cart');
  }

  public function checkout()
  {
    $cart = $this->cart->getCart();

    foreach ($cart as $c) {
      $barang = $this->barang->find($c->id_barang);
      $this->barang->updateBarang($c->id_barang, ['stok' => $barang['stok'] - $c->qty]);
    }

    $this->cart->deleteCartAll();

    return redirect()->to('/cart');
  }

  public function delete($id)
  {
    $this->cart->deleteCart($id);

    return redirect()->to('/cart');
  }
}
