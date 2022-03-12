<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    // untuk connect ke database. 
    // $dbh -> database handler. buat menampung koneksi ke database
    // stmt -> statement. untuk nyimpen query
    private $dbh;
    private $stmt;

    // lakukan koneksi ke database
    public function __construct()
    {
        // $dsn -> data source name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        // host kita sekarang localhost
        // dbname. database kita namanya apa? phpmvc
        // ini masih simpel

        // option ini untuk optimasi
        $option = [
            //untuk membuat datase kita koneksinya terjaga terus
            PDO::ATTR_PERSISTENT => true,

            // mode errornya
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // cek apakah koneksinya berhasil
        try {
            // PDO = PHP Data Object
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
            // username default: root
            // password default: (kososng) -> kalo di windows. kalo di mac, root
            // option biasanya digunakan ketika kita ingin mengoptimasi database
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    // untuk menyiapakan query
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    // untuk binding datanya
    public function bind($param, $value, $type = null)  
    {
        if( is_null($type) ) {
            switch( true ) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
        // kenapa dilakukan ini? biar aman. agar terhindar dari query injection
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        //stmt (statement)
    }

    // kalau mau ambil 1 data
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}