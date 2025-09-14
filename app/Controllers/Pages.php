<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | My Website',
        ];
        return view('pages/v_home', $data);
        
    }

    public function about()
    {
        $data = [
            'title' => 'About | My Website',
        ];
        return view('pages/v_about', $data);

    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | My Website',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl. Merdeka No,123',
                    'kota' => 'Jakarta',
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. Sudirman No. 456',
                    'kota' => 'Bandung',
                ]
            ]
        ];
        return view('pages/v_contact', $data);
    }

}