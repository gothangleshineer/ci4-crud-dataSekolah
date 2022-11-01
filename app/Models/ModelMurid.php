<?php

namespace App\Models;


use CodeIgniter\Model;

class ModelMurid extends Model
{
     protected $table = "murid";
     protected $primarykey = "id";
     protected $allowedFields = ['nama', 'email', 'bidang', 'alamat'];

     function cari($katakunci)
     {
          $builder = $this->table("murid");
          $arr_katakunci = explode(" ", $katakunci);
          for ($x = 0; $x < count($arr_katakunci); $x++) {
               $builder->like('nama', $arr_katakunci[$x]);
               $builder->orlike('email', $arr_katakunci[$x]);
               $builder->orlike('alamat', $arr_katakunci[$x]);
          }
          return $builder;
     }
}
