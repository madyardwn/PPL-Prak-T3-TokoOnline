<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Barang extends BaseController
{
    private $model;

    // constructor
    public function __construct()
    {
        // Load model
        $this->model = new \App\Models\M_Barang();
    }

    public function index()
    {
        if ($this->request->getVar('keyword')) {
            $keyword = $this->request->getVar('keyword');
            $data = [
                'title' => 'Daftar Barang',
                'barang' => $this->model->search($keyword)->paginate(8, 'barang'),
                'pager' => $this->model->pager,
                'currentPage' => $this->model->getCurrentPage(),
                'keyword' => $keyword
            ];
        } else {
            $data = [
                'title' => 'Daftar Barang',
                'barang' => $this->model->paginate(8, 'barang'),
                'pager' => $this->model->pager,
                'currentPage' => $this->model->getCurrentPage(),
                'keyword' => ''
            ];
        }
        return view('barang/v_index', $data);
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Barang',
            'barang' => $this->model->find($id)
        ];
        return view('barang/v_show', $data);
    }


    public function store()
    {
        $validation = \Config\Services::validation();

        // Validasi input
        $validation->setRules([
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'uploaded[gambar]|max_size[gambar,1024]|ext_in[gambar,jpg,jpeg,png]',
            'barcode' => 'uploaded[barcode]|max_size[barcode,1024]|ext_in[barcode,jpg,jpeg,png]'
        ]);

        // Jalankan validasi
        if (!$validation->run($this->request->getPost())) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        // Ambil file yang diupload
        $file = $this->request->getFile('gambar');
        $barcode = $this->request->getFile('barcode');

        // Set nama file dan unique
        $fileName = uniqid() . '.' . $file->getClientExtension();
        $barcodeName = uniqid() . '.' . $barcode->getClientExtension();

        // Simpan file ke folder public/gambar
        $file->move(ROOTPATH . 'public/gambar', $fileName);
        $barcode->move(ROOTPATH . 'public/gambar', $barcodeName);

        // Simpan data ke database
        $barangModel = new \App\Models\M_Barang();
        $barangModel->save([
            'nama_barang' => $this->request->getVar('nama_barang'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'gambar' => $fileName,
            'barcode' => $barcodeName
        ]);

        return redirect()->to('/barang');
    }

    public function destroy($id)
    {
        // remove image 
        $barang = $this->model->find($id);

        unlink(ROOTPATH . 'public/gambar/' . $barang['gambar']);
        unlink(ROOTPATH . 'public/gambar/' . $barang['barcode']);

        $this->model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('barang'));
    }

    public function update($id)
    {
        $barang = $this->model->find($id);

        // Jika ada file gambar yang diunggah
        if ($this->request->getFile('gambar')->isValid() && !$this->request->getFile('gambar')->hasMoved()) {
            // Hapus gambar lama jika ada
            if ($barang['gambar'] && file_exists(ROOTPATH . 'public/gambar/' . $barang['gambar'])) {
                unlink(ROOTPATH . 'public/gambar/' . $barang['gambar']);
            }

            $file = $this->request->getFile('gambar');

            // Set nama file dan unique
            $fileName = uniqid() . '.' . $file->getExtension();

            // Simpan gambar ke folder public/gambar
            $file->move(ROOTPATH . 'public/gambar', $fileName);

            // Simpan data ke database
            $this->model->update($id, [
                'nama_barang' => $this->request->getVar('nama_barang'),
                'harga' => $this->request->getVar('harga'),
                'stok' => $this->request->getVar('stok'),
                'gambar' => $fileName
            ]);
        }

        // Jika tidak ada file gambar yang diunggah
        else {
            // Simpan data ke database
            $this->model->update($id, [
                'nama_barang' => $this->request->getVar('nama_barang'),
                'harga' => $this->request->getVar('harga'),
                'stok' => $this->request->getVar('stok'),
                'gambar' => $barang['gambar'] ?? null,
                'barcode' => $barang['barcode'] ?? null
            ]);
        }

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to(base_url('barang'));
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Barang',
            'barang' => $this->model->find($id)
        ];
        return view('barang/v_edit', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Barang'
        ];
        return view('barang/v_create', $data);
    }
}
