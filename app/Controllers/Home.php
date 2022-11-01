<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
    {
        $this->model = new \App\Models\ModelMurid();
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('home');
    }

    public function edit($id)
    {
        return json_encode($this->model->find($id));
    }

    public function simpan()
    {
        $validasi = \config\Services::validation();
        $aturan = [
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum Karakter Untuk Field {field} Adalah 5 Karakter'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|min_length[5]|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum Karakter Untuk Field {field} Adalah 5 Karakter',
                    'valid_email' => 'Email Yang Kamu Masukan Tidak Valid'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum Karakter Untuk Field {field} Adalah 5 Karakter'

                ]
            ]
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $id = $this->request->getPost('id');
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $bidang = $this->request->getPost('bidang');
            $alamat = $this->request->getPost('alamat');

            $data = [
                'is' => $id,
                'nama' => $nama,
                'email' => $email,
                'bidang' => $bidang,
                'alamat' => $alamat
            ];

            $this->model->save($data);

            $hasil['sukses'] = "Berhasil Memasukan Data";
            $hasil['error'] = true;
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }


        return json_encode($hasil);
    }
    public function login()
    {
        $jumlahBaris = 2;
        // $katakunci = $this->request->getGet('katakunci');
        // if ($katakunci) {
        //     $pencarian = $this->model->cari($katakunci);
        // } else {
        //     $pencarian = $this->model;
        // }

        $data['dataMurid'] = $this->model->orderBy('id', 'desc')->findAll();
        $data['nomor'] =   ($this->request->getVar('page') == 1) ? '0' : $this->request->getVar('page');

        return view('auth/login', $data);
    }
    public function index()
    {
        $jumlahBaris = 2;
        // $katakunci = $this->request->getGet('katakunci');
        // if ($katakunci) {
        //     $pencarian = $this->model->cari($katakunci);
        // } else {
        //     $pencarian = $this->model;
        // }

        $data['dataMurid'] = $this->model->orderBy('id', 'desc')->findAll();
        $data['nomor'] =   ($this->request->getVar('page') == 1) ? '0' : $this->request->getVar('page');

        return view('murid_view', $data);
    }

    // public function register()
    // {
    //     return view('auth/register');
    // }
}
