<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
    {
        $this->model = new \App\Models\ModelMurid();
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
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $bidang = $this->request->getPost('bidang');
            $alamat = $this->request->getPost('alamat');

            $data = [
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
    public function index()
    {
        $jumlahBaris = 2;
        $data['dataMurid'] = $this->model->orderBy('id', 'desc')->findAll();

        return view('murid_view', $data);
    }
}
