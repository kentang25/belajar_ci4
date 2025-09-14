<?php

 namespace App\Models;

 use CodeIgniter\Model;

 Class M_komik extends Model{
    protected $table    = 'tb_komik';  
    protected $useTimestamps       = true;

    public function getKomik($slug = false)
    {
        if($slug == false){
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
 }

 
?>