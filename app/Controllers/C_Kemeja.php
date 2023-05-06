<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Kemeja extends BaseController
{
    private $model;

    // constructor
    public function __construct()
    {
        // Load model
        $this->model = new \App\Models\M_Kemeja();
    }

    public function index()
    {
        if ($this->request->getVar('keyword')) {
            $keyword = $this->request->getVar('keyword');
            $data = [
                'title' => 'Daftar Kemeja',
                'kemeja' => $this->model->search($keyword)->paginate(8, 'kemeja'),
                'pager' => $this->model->pager,
                'currentPage' => $this->model->getCurrentPage(),
                'keyword' => $keyword
            ];
        } else {
            $data = [
                'title' => 'Daftar Kemeja',
                'kemeja' => $this->model->paginate(8, 'kemeja'),
                'pager' => $this->model->pager,
                'currentPage' => $this->model->getCurrentPage(),
                'keyword' => '',
            ];
        }
        return view('kemeja/v_index', $data);
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Kemeja',
            'barang' => $this->model->find($id)
        ];
        return view('kemeja/v_show', $data);
    }


    public function store()
    {

        $rules = [
            'namabrg' => 'required|min_length[3]',
            'harga' => 'required|numeric',
            'diskon' => 'required|numeric',
            'stok' => 'required|numeric',
            'namafile' => 'uploaded[namafile]|max_size[namafile,1024]|is_image[namafile]|mime_in[namafile,image/jpg,image/jpeg,image/png]',
            'berat' => 'required|numeric',
        ];

        $errors = [
            'namabrg' => [
                'required' => 'Nama barang harus diisi',
                'min_length' => 'Nama barang minimal 3 karakter'
            ],
            'harga' => [
                'required' => 'Harga harus diisi',
                'numeric' => 'Harga harus berupa angka'
            ],
            'diskon' => [
                'required' => 'Diskon harus diisi',
                'numeric' => 'Diskon harus berupa angka'
            ],
            'stok' => [
                'required' => 'Stok harus diisi',
                'numeric' => 'Stok harus berupa angka'
            ],
            'berat' => [
                'required' => 'Berat harus diisi',
                'numeric' => 'Berat harus berupa angka'
            ],
        ];

        if (!$this->validate($rules, $errors)) {
            $data = [
                'title' => 'Tambah Kemeja',
                'validation' => $this->validator
            ];

            return view('kemeja/v_create', $data);
        }

        // Ambil file yang diupload
        $file = $this->request->getFile('namafile');

        // Set nama file dan unique
        $fileName = uniqid() . '.' . $file->getClientExtension();

        // Simpan file ke folder public/gambar
        $file->move(ROOTPATH . 'public/namafile', $fileName);

        // Simpan data ke database
        $data = [
            'namabrg' => $this->request->getVar('namabrg'),
            'harga' => $this->request->getVar('harga'),
            'diskon' => $this->request->getVar('diskon'),
            'stok' => $this->request->getVar('stok'),
            'namafile' => $fileName,
            'berat' => $this->request->getVar('berat'),
        ];

        $this->model->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('kemeja'));
    }

    public function destroy($id)
    {
        // remove image 
        $barang = $this->model->find($id);

        unlink(ROOTPATH . 'public/namafile/' . $barang['namafile']);

        $this->model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('kemeja'));
    }

    public function update($id)
    {
        $data = [
            'namabrg' => $this->request->getVar('namabrg'),
            'harga' => $this->request->getVar('harga'),
            'diskon' => $this->request->getVar('diskon'),
            'stok' => $this->request->getVar('stok'),
            'namafile' => $this->request->getVar('namafile'),
            'berat' => $this->request->getVar('berat'),
        ];

        $rules = [
            'namabrg' => 'required|min_length[3]',
            'harga' => 'required|numeric',
            'diskon' => 'required|numeric',
            'stok' => 'required|numeric',
            'namafile' => 'max_size[namafile,1024]|is_image[namafile]|mime_in[namafile,image/jpg,image/jpeg,image/png]',
            'berat' => 'required|numeric',
        ];

        $errors = [
            'namabrg' => [
                'required' => 'Nama barang harus diisi',
                'min_length' => 'Nama barang minimal 3 karakter'
            ],
            'harga' => [
                'required' => 'Harga harus diisi',
                'numeric' => 'Harga harus berupa angka'
            ],
            'diskon' => [
                'required' => 'Diskon harus diisi',
                'numeric' => 'Diskon harus berupa angka'
            ],
            'stok' => [
                'required' => 'Stok harus diisi',
                'numeric' => 'Stok harus berupa angka'
            ],
            'berat' => [
                'required' => 'Berat harus diisi',
                'numeric' => 'Berat harus berupa angka'
            ],
        ];

        if (!$this->validate($rules, $errors)) {
            $data = [
                'title' => 'Edit Kemeja',
                'barang' => $this->model->find($id)
            ];

            return view('kemeja/v_edit', $data);
        }

        $barang = $this->model->find($id);

        // Jika ada file gambar yang diunggah
        if ($this->request->getFile('namafile')->getError() == 0) {
            // Hapus gambar lama jika ada
            if ($barang['namafile'] != '') {
                unlink(ROOTPATH . 'public/namafile/' . $barang['namafile']);
            }

            // Ambil file yang diupload
            $file = $this->request->getFile('namafile');

            // Set nama file dan unique
            $fileName = uniqid() . '.' . $file->getExtension();

            // Simpan gambar ke folder public/gambar
            $file->move(ROOTPATH . 'public/namafile', $fileName);

            // Simpan data ke database
            $this->model->update(
                $id,
                [
                    'namabrg' => $this->request->getVar('namabrg'),
                    'harga' => $this->request->getVar('harga'),
                    'diskon' => $this->request->getVar('diskon'),
                    'stok' => $this->request->getVar('stok'),
                    'namafile' => $fileName,
                    'berat' => $this->request->getVar('berat'),
                ]
            );
        }

        // Jika tidak ada file gambar yang diunggah
        else {
            // Simpan data ke database
            $this->model->update(
                $id,
                [
                    'namabrg' => $this->request->getVar('namabrg'),
                    'harga' => $this->request->getVar('harga'),
                    'diskon' => $this->request->getVar('diskon'),
                    'stok' => $this->request->getVar('stok'),
                    'berat' => $this->request->getVar('berat'),
                ]
            );
        }

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to(base_url('kemeja'));
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kemeja',
            'barang' => $this->model->find($id)
        ];

        return view('kemeja/v_edit', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kemeja',
        ];

        return view('kemeja/v_create', $data);
    }
}
