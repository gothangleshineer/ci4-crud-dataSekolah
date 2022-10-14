<?php

namespace App\Controllers;

class Murid extends BaseController
{
    function __construct()
    {
        $this->model = new \App\Models\ModelMurid();
    }
    public function simpan()
    {
        $hasil['sukses'] = true;
        $hasil['error'] = false;
        return json_encode($hasil);
    }

    public function index()
    {
        return view('murid_view');
    }
}
