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

    public function selectData($name='*'){
        if(is_array($name)){
            $names = implode(",",$name);
        }else{
            $names=$name;
        }
        $sql = $this->pdh->prepare("SELECT {$names} FROM {$this->tbl}");
        $sql->execute();
        $row=$sql->fetchAll(PDO::FETCH_OBJ);
        //var_dump($row);
    }

    public function insertData($field,$data){
        if(is_array($data)){
            $names = "'".implode("','",$data)."'";
            $field = implode(",",$field);
            $sql = $this->pdh->prepare("INSERT INTO {$this->tbl}($field) VALUES ($names)");
            //var_dump($sql);
            $sql->execute();

        }

    }

    public function editData($field,$data,$id){
        foreach ($field as $key=>$val){
            $txt[]=$val."='".$data[$key]."'";

        }

        $query=implode(',',$txt);
        $sql = $this->pdh->prepare("UPDATE $this->tbl SET $query WHERE id=$id");
        $sql->execute();

    }

    public function deleteData($id){
        $sql = $this->pdh->prepare("DELETE FROM {$this->tbl} WHERE id=$id");
        $sql->execute();
    }

    public function searchData($name,$value){
        $sql = $this->pdh->prepare("SELECT * FROM {$this->tbl} WHERE $name='$value'");
        $sql->execute();
        $row=$sql->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function likeData($name,$value){
        $sql = $this->pdh->prepare("SELECT * FROM {$this->tbl} WHERE $name LIKE $value");
        $sql->execute();
        $row=$sql->fetchAll(PDO::FETCH_OBJ);
    }
}

