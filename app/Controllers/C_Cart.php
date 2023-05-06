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
    protected $ongkir;

    public function __construct()
    {
        $this->barang = new \App\Models\M_Kemeja();
        $this->transaksi = new \App\Models\M_Transaksipjl();
        $this->penjualan = new \App\Models\M_Detailjual();
        $this->ongkir = new \App\Models\M_Ongkir();

        $this->cart = session()->has('cart') ? session()->get('cart') : [
            'items' => [],
            'total' => 0,
            'berat' => 0,
        ];
    }

    public function index()
    {
        $data = [
            'title' => 'Cart',
            'cart' => $this->cart['items'],
            'total' => $this->cart['total'],
            'berat' => $this->cart['berat'],
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
                return redirect()->to(base_url('kemeja/cart'));
            }

            if ($index !== false) {
                $items[$index]['qty']++;
                $items[$index]['subtotal'] += $barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100);
                $this->cart['items'] = $items;
                $this->cart['total'] += $barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100);
                $this->cart['berat'] += $barang['berat'];
            } else {
                $data = [
                    'id' => $barang['idkemeja'],
                    'nama' => $barang['namabrg'],
                    'namafile' => $barang['namafile'],
                    'harga' => $barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100),
                    'diskon' => $barang['diskon'],
                    'qty' => 1,
                    'subtotal' => $barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100)
                ];

                array_push($this->cart['items'], $data);
                $this->cart['total'] += $barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100);
                $this->cart['berat'] += $barang['berat'];
            }
        } else {

            if (!($barang['stok'] > 0)) {
                session()->setFlashdata('pesan', 'Stok barang tidak mencukupi');
                return redirect()->to(base_url('kemeja/cart'));
            }

            $data = [
                'id' => $barang['idkemeja'],
                'nama' => $barang['namabrg'],
                'namafile' => $barang['namafile'],
                'harga' => $barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100),
                'diskon' => $barang['diskon'],
                'qty' => 1,
                'subtotal' => $barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100),
            ];

            $this->cart = [
                'items' => [$data],
                'total' => $barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100),
                'berat' => $barang['berat'],
            ];
        }

        session()->set('cart', $this->cart);
        $count = count($this->cart['items']);
        return redirect()->to(base_url('kemeja', $count));
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
                    $items[$index]['subtotal'] = $items[$index]['qty'] * ($barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100));
                    $this->cart['items'] = $items;
                    $this->cart['total'] -= $barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100);
                    $this->cart['berat'] -= $barang['berat'];
                } else {
                    array_splice($items, $index, 1);
                    $this->cart['items'] = $items;
                    $this->cart['total'] -= $barang['harga'] - ($barang['harga'] * $barang['diskon'] / 100);
                    $this->cart['berat'] -= $barang['berat'];
                }
            }
        }

        session()->set('cart', $this->cart);
        return redirect()->to(base_url('kemeja/cart'));
    }

    public function checkoutForm()
    {
        $data = [
            'title' => 'Checkout',
            'cart' => $this->cart['items'],
            'total' => $this->cart['total'],
            'berat' => $this->cart['berat'],
            'kodepos' => $this->ongkir->findAll(),
            'ongkir' => 0,
        ];

        if (session()->has('cart')) {
            return view('cart/v_checkout', $data);
        } else {
            session()->setFlashdata('pesan', 'Cart masih kosong');
            return redirect()->to(base_url('kemeja'));
        }
    }

    // checkout cart
    public function checkout()
    {
        if (session()->has('cart')) {
            $items = $this->cart['items'];

            $no_transaksi = 'TRX' . date('YmdHis');

            $data = [
                'idtrans' => $no_transaksi,
                'nama' => $this->request->getPost('nama'),
                'total' => $this->request->getPost('total'),
                'alamat' => $this->request->getPost('alamat'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kota' => $this->request->getPost('kota'),
                'hp' => $this->request->getPost('nomor_telepon'),
                'kodepos' => $this->request->getPost('kodepos'),
            ];

            $this->transaksi->insert($data);

            foreach ($items as $item) {
                $data = [
                    'idtrans' => $no_transaksi,
                    'idkemeja' => $item['id'],
                    'hargajual' => $item['harga'],
                    'jmljual' => $item['qty'],
                ];

                $this->barang->update($item['id'], ['stok' => $this->barang->find($item['id'])['stok'] - $item['qty']]);
                $this->penjualan->insert($data);
            }

            session()->remove('cart');
            session()->setFlashdata('pesan', 'Checkout berhasil');
            return redirect()->to(base_url('kemeja'));
        } else {
            session()->setFlashdata('pesan', 'Cart masih kosong');
            return redirect()->to(base_url('kemeja'));
        }
    }

    public function destroy()
    {
        session()->remove('cart');
        session()->setFlashdata('pesan', 'Cart berhasil dihapus');
        return redirect()->to(base_url('kemeja'));
    }

    public function getOngkir()
    {
        $id = $this->request->getPost('id');
        $ongkir = $this->ongkir->find($id);

        $berat = $this->cart['berat'] / 1000;

        if ($berat - floor($berat) == 0) {
            $ongkir = $ongkir['ongkir_per_kilo'];
        } else
        if ($berat - floor($berat) < 0.3) {
            $ongkir = $ongkir['ongkir_per_kilo'] * floor($berat);
        } else {
            $ongkir = $ongkir['ongkir_per_kilo'] * floor($berat) + $ongkir['ongkir_per_kilo'];
        }


        $data = [
            'ongkir' => $ongkir,
            'total' => $this->cart['total'] + $ongkir,
        ];

        return $this->response->setJSON($data);
    }
}
