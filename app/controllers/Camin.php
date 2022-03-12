<?php

class Camin extends Controller{
    public function index()
    {
        $data['judul'] = 'Daftar Calon Admin';
        $data['mhs'] = $this->model('Camin_model')->getAllCamin();
        $this->view('templates/header', $data);
        $this->view('camin/index', $data);
        $this->view('templates/footer');       
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Camin';
        $data['mhs'] = $this->model('Camin_model')->getCaminById($id);
        $this->view('templates/header', $data);
        $this->view('camin/detail', $data);
        $this->view('templates/footer');       
    }
}