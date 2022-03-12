<?php

class Camin_model {

    private $table = 'camin';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCamin()
    {

        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();

        // udah ga pakai ini lagi. ini sudah dijalankan sama wrappingnya
        // // kita assign handler-nya. querynya harus kita prepare dulu.lalu dimasukkan query-nya
        // $this->stmt = $this->dbh->prepare('SELECT * FROM camin');
        
        // //kita jalankan datanya
        // $this->stmt->execute();

        // //Kita ambil semua datanya. kita mengembalikan datanya berupa array assosiatif. makanya pakai PDO::FETCH_ASSOC
        // return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    
    public function getCaminById($id)
    {   
        // ga langsung dimasukin $id di where nya
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);

        // pakai single karena yang direturn cuman 1 data Camin
        return $this->db->single();
    }
}