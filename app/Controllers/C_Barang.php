<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Barang extends BaseController
{
    public function index()
    {
        $model = new \App\Models\M_Barang();
        $data = [
            'title' => 'Daftar Barang',
            'barang' => $model->findAll(),
        ];
        return view('barang/v_index', $data);
        // if ($this->request->getVar('keyword')) {
        //     $keyword = $this->request->getVar('keyword');
        //     $data = [
        //         'title' => 'Daftar Barang',
        //         'barang' => $model->search($keyword)->paginate(6, 'nama_barang'),
        //         'pager' => $model->pager,
        //         'keyword' => $keyword
        //     ];
        // } else {
        //     $data = [
        //         'title' => 'Daftar Barang',
        //         'barang' => $model->paginate(6, 'nama_barang'),
        //         'pager' => $model->pager,
        //         'currentPage' => $model->getCurrentPage(),
        //         'keyword' => ''
        //     ];
        // }
    }

    public function show($id)
    {
        $model = new \App\Models\M_Barang();
        $data = [
            'title' => 'Detail Barang',
            'barang' => $model->id($id)
        ];
        return view('barang/v_show', $data);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        // Validasi input
        $validation->setRules([
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        // Cek validasi
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Ambil gambar yang diupload
        $file = $this->request->getFile('gambar');

        // Set nama file dan unique
        $fileName = uniqid() . '.' . $file->getExtension();

        // Simpan gambar ke folder public/gambar
        $file->move(ROOTPATH . 'public/gambar', $fileName);

        // Simpan data ke database
        $barangModel = new \App\Models\M_Barang();
        $barangModel->save([
            'nama_barang' => $this->request->getVar('nama_barang'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'gambar' => $fileName
        ]);

        return redirect()->to('/barang');
    }

    public function delete($id)
    {
        $model = new \App\Models\M_Barang();
        $model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('barang'));
    }

    public function update($nim)
    {
        $model = new \App\Models\M_Barang();
        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok'),
            'gambar' => $this->request->getPost('gambar')
        ];

        $model->update($nim, $data);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to(base_url('barang'));

        // $rules = [
        //     'nim' => 'required|numeric|min_length[9]|greater_than[0]|is_unique[mahasiswa.nim,nim,' . $nim . ']',
        //     'nama' => 'required|alpha_space',
        //     'umur' => 'required|numeric|greater_than[0]'
        // ];
        //
        // $errors = [
        //     'nim' => [
        //         'required' => 'NIM harus diisi',
        //         'numeric' => 'NIM harus berupa angka',
        //         'is_unique' => 'NIM sudah digunakan',
        //         'min_length' => 'NIM harus 9 digit',
        //         'greater_than' => 'NIM tidak boleh 0 atau negatif',
        //     ],
        //     'nama' => [
        //         'required' => 'Nama harus diisi',
        //         'alpha_space' => 'Nama tidak boleh mengandung angka atau simbol',
        //     ],
        //     'umur' => [
        //         'required' => 'Umur harus diisi',
        //         'numeric' => 'Umur harus berupa angka',
        //         'greater_than' => 'Umur tidak boleh 0 atau negatif',
        //     ]
        // ];
        //
        // if (!$this->validate($rules, $errors)) {
        //     $data = [
        //         'title' => 'Edit Data Mahasiswa',
        //         'validation' => $this->validator,
        //         'mahasiswa' => $model->id($nim)
        //     ];
        //     return view('mahasiswa/v_edit', $data);
        // } else {
        //     $model->edit($data, $nim);
        //     session()->setFlashdata('pesan', 'Data berhasil diubah');
        //     return redirect()->to(base_url('mahasiswa'));
        // }
    }

    public function edit($id)
    {
        $model = new \App\Models\M_Barang();
        $data = [
            'title' => 'Edit Data Barang',
            'barang' => $model->id($id)
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
