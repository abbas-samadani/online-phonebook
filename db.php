<?php


class db
{
    protected $pdh;
    private $server;
    private $db;
    private $user;
    private $pass;
    private $tbl;


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

    public function setTbl($tbl)
    {
        $this->tbl = $tbl;
    }

    function select_data($name='*'){
        if(is_array($name)){
            $names = implode(",",$name);
        }else{
            $names=$name;
        }
        $sql = $this->pdh->prepare("SELECT {$names} FROM {$this->tbl}");
        $sql->execute();
        $row=$sql->fetchAll(PDO::FETCH_OBJ);
        var_dump($row);
    }

    function insert_data($field,$data){
        if(is_array($data)){
            $names = "'".implode("','",$data)."'";
            $field = implode(",",$field);
            $sql = $this->pdh->prepare("INSERT INTO {$this->tbl}($field) VALUES ($names)");
            //var_dump($sql);
            $sql->execute();

        }

    }
}

$obj = new db();
$obj->setTbl("user_tbl");
$obj->select_data();
//$obj->insert_data(['name','email','password','lastname'],['ebi','ebi@gmail.com','123','rezaie']);