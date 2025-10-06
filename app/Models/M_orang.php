<?php

 namespace App\Models;

 use CodeIgniter\Model;

 Class M_orang extends Model{
    protected $table    = 'orang';  
    protected $useTimestamps       = true;
    protected $allowedFields = ['nama', 'alamat'];

    public function search($keyword){
        return $this->table('orang')->like('nama', $keyword)->orLike('alamat', $keyword);
    }

 }

 
?>