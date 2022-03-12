<?php

class App{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = []; //patameter. ini bisa lebih dari 1s

    public function __construct()
    {
        $url = $this->parseURL();

        //ada ga sebuah file di dalam folder controller sesuai dengan nama yang user tulis di url
        //controller
        if(isset($url[0])){
            if( file_exists('../app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]); // nanti array index 0 nya ilang (home)
            }
        }
        

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // method
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // params
        if( !empty($url)){
            $this->params = array_values($url);
        }
        
        // jalankan controlled & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // fungsi untuk mengambil url dari user
    public function parseURL()
    {
        if( isset($_GET['url'])){ //untuk mengecek apakah user mengirim url
            $url = rtrim($_GET['url'], '/'); // mengambil url
            // rtrim() untuk menghapus karakter diakhir
            $url = filter_var($url, FILTER_SANITIZE_URL); //ini untuk membersihkan url dari karakter2 aneh
            $url = explode('/', $url); //pecah url dengan delimiter(pemisah)nya adalah '/'. ntar jadi elemen2 array
            return $url;
        }
    }
}
