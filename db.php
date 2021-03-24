<?php


class db
{
    protected $pdh;
    private $server;
    private $db;
    private $user;
    private $pass;
    public function __construct($server='localhost', $db='phonebook', $user='root', $pass='')
    {
        $this->server=$server;
        $this->db=$db;
        $this->user=$user;
        $this->pass=$pass;
        $this->connection();
    }

    function connection(){
        try {
            $this->pdh = new PDO("mysql:host=$this->server;dbname=$this->db", $this->user, $this->pass);
        }
        catch (Exception $e){
            die($e->getMessage());
        }

    }
}

$obj = new db();