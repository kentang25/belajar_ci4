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

            // $komikModel = new M_komik();
        // $komik = $this->komikModel->findAll();
        

        $komik = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];
        return view('komik/v_komik', $komik);
    }

    public function detail_komik($slug)
    {
        $komik = $this->komikModel->getKomik($slug);
        // dd($komik);
        if(!$komik){
            throw new \Codeigniter\Exceptions\PageNotFoundException('judul komik' . $slug . 'tidak ditemukan');
        }

        $data =[
            'title' => 'Detail Komik',
            'komik' => $komik
        ];
        

        return view('komik/v_detail', $data);
    }

    public function create()
    {
        session();
        $data = [
            'title' => 'Form Tambah Data Komik',
            'validation'  => session()->getFlashdata('validation') ?? \Config\Services::validation()
        ];
        return view('komik/v_create', $data);
    }

    public function save()
    {
        if(!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[tb_komik.judul]',
                'errors' => [
                    'required' => '{field}  komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar.'
                ]
            ],
            'penulis' => 'required',
            'penerbit' => 'required',
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'judul' => $this->request->getVar('judul'),
            'slug' => url_title($this->request->getVar('judul'), '-', true),
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ];

        $this->komikModel->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
        'title' => 'Form Edit Data Komik',
        'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/v_edit', $data);
    }

    public function update($id)
    {

        $slug = $this->request->getVar('slug');
        if (!$slug) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Slug tidak ditemukan pada permintaan.');
        }
        $komikLama = $this->komikModel->getKomik($slug);
        // dd($komikLama);
        if($komikLama && $komikLama['judul'] == $this->request->getVar('judul')){
            $rule_judul = 'required';
        }else{
            $rule_judul = 'required|is_unique[tb_komik.judul]';
        }

         if(!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field}  komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar.'
                ]
            ],
            'penulis' => 'required',
            'penerbit' => 'required',
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $data = [
            'id'    => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => url_title($this->request->getVar('judul'), '-', true),
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ];

        $this->komikModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/komik');
    }
}   
