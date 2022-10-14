<?php

namespace App\Models;


use CodeIgniter\Model;

class ModelMurid extends Model
{
     protected $table = "murid";
     protected $primarykey = "id";
     protected $allowedFields = ['nama', 'email', 'bidang', 'alamat'];
}
