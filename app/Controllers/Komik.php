<?php

namespace App\Controllers;

use App\Models\M_komik;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new M_komik();
    }
    public function index()
    {

        $komikModel = new M_komik();
        // $komik = $this->komikModel->findAll();
        

        $komik = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];
        return view('komik/v_komik', $komik);
    }

    public function detail_komik($slug)
    {
        $komik = $this->komikModel->where(['slug' => $slug])->first();

        if(!$komik){
            throw new \Codeigniter\Exceptions\PageNotFoundException('judul komik' . $slug . 'tidak ditemukan');
        }

        $data =[
            'title' => 'Detail Komik',
            'komik' => $komik
        ];

        return view('komik/v_detail', $data);
    }
}
