<?php

namespace App\Controllers;

use App\Models\M_orang;

class Orang extends BaseController
{
    protected $orangModel;
    public function __construct()
    {
        $this->orangModel = new M_orang();
    }
    public function index()
    {

            // $orangModel = new M_orang();
        // $orang = $this->orangModel->findAll();
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;

        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $orang = $this->orangModel->search($keyword);
        }else{
            $orang = $this->orangModel;
        }

        $orang = [
            'title' => 'Daftar orang',
            'orang' => $orang->paginate(6, 'orang'),
            'pager' => $this->orangModel->pager,
            'currentPage' => $currentPage
        ];
        return view('orang/index', $orang);
    }

}   
