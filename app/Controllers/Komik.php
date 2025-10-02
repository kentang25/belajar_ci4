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
        // Aturan validasi
        $rules = [
            'judul' => [
                'rules' => 'required|is_unique[tb_komik.judul]',
                'errors' => [
                    'required'   => '{field} komik harus diisi.',
                    'is_unique'  => '{field} komik sudah terdaftar.'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'sampul' => [
                'rules' => 'is_image[sampul]|max_size[sampul,2048]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image'  => 'File harus berupa gambar.',
                    'max_size'  => 'Ukuran maksimal file 2MB.',
                    'mime_in'   => 'Tipe file tidak diizinkan.'
                ]
            ]
        ];

        // Jika gagal validasi
        if (! $this->validate($rules)) {
            return redirect()->to('/komik/create')->withInput()->with('validation', $this->validator);
        }

        // Ambil file upload
        $fileSampul = $this->request->getFile('sampul');

        if($fileSampul->getError() == 4){
            $namaSampul = 'default.jpg';
        }else{
            $namaSampul = $fileSampul->getRandomName(); // supaya nama unik
            $fileSampul->move('img', $namaSampul);
        }
        

        // Simpan ke database
        $this->komikModel->save([
            'judul'    => $this->request->getVar('judul'),
            'slug'     => url_title($this->request->getVar('judul'), '-', true),
            'penulis'  => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul'   => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/komik');
    }


    public function delete($id)
    {

        $komik = $this->komikModel->find($id);

        if($komik['sampul'] != 'default.jpg'){
            unlink('img/'. $komik['sampul']);
        }

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
        $komikLama = $this->komikModel->find($id);

        if (!$komikLama) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data komik tidak ditemukan.');
        }

        // Tentukan rules
        $rule_judul = ($komikLama['judul'] == $this->request->getVar('judul'))
            ? 'required'
            : 'required|is_unique[tb_komik.judul]';

        if (!$this->validate([
            'judul' => $rule_judul,
            'sampul' => [
                'rules' => 'is_image[sampul]|max_size[sampul,2048]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image'  => 'File harus berupa gambar.',
                    'max_size'  => 'Ukuran maksimal file 2MB.',
                    'mime_in'   => 'Tipe file tidak diizinkan.'
                ]
            ]
        ])) {
            return redirect()->to('/komik/edit/' . $id)->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        if($fileSampul->getError() == 4){
            $namaSampul = $this->request->getVar('sampulLama');
        }else{
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);
            unlink('img/'. $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            'id'        => $id,
            'judul'     => $this->request->getVar('judul'),
            'slug'      => $slug,
            'penulis'   => $this->request->getVar('penulis'),
            'penerbit'  => $this->request->getVar('penerbit'),
            'sampul'    => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diupdate.');
        return redirect()->to('/komik');
    }

}   
