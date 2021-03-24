<?php

class db
{
    protected $pdo;
    private $db;
    private $user;
    private $pass;
    private $tbl;

    public function __construct($db='phonebook',$user='root',$pass='')
    {
        $this->db=$db;
        $this->user=$user;
        $this->pass=$pass;
        $this->connection();
    }

    public function connection(){
        try{
            $this->pdo = new PDO("mysql:host=localhost;dbname={$this->db}", $this->user, $this->pass);
        }
        catch(Exception $e){
            die($e->getMessage());
        }

    }
    public function setTbl($tbl)
    {
        $this->tbl = $tbl;
    }
    public function selectData($name){
        if(is_array($name)){
            $names="'" .implode("','", $name)."'" ;
            $stm=$this->pdo->prepare("select {$names} FROM {$this->tbl}");
        }
        else{
            $stm=$this->pdo->prepare("select {$name} FROM {$this->tbl}");
        }
        $stm->execute();
        $row=$stm->fetchAll(PDO::FETCH_OBJ);
        return $row;
    }
    public function insertData($filds,$data){
        if(is_array($data)){
            $names="'" .implode("','", $data)."'" ;
            $filds=implode(",", $filds);
            $sql=$this->pdo->prepare("insert into {$this->tbl} ($filds) VALUES ($names)");
            $sql->execute();
        }
    }
    public function editData($filds,$data,$id){
        foreach ($filds as $key=>$val){
            $txt[]=$val."='".$data[$val]."'";
        }
        $query=implode(",",$txt);
        $sql=$this->pdo->prepare("update {$this->tbl} set ".$query."where id ='$id'");
        //var_dump($sql);die;
        $sql->execute();
    }

    public function deleteData($id){
        $sql=$this->pdo->prepare("delete from {$this->tbl} where id='$id'");
        $sql->execute();
    }
    public function searchData($name,$value){
        $sql=$this->pdo->prepare("select * FROM {$this->tbl} where $name='$value'");
        $sql->execute();
        $results=$sql->fetch(PDO::FETCH_OBJ);
        return $results;

    }
    public function likeData($name,$value){
        $sql=$this->pdo->prepare("select * FROM {$this->tbl} where $name LIKE '%$value%'");
        $sql->execute();
        $results=$sql->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    public function showEditData($id){
        $sql=$this->pdo->prepare("select * FROM {$this->tbl} where id='$id'");
        $sql->execute();
        $results=$sql->fetch(PDO::FETCH_ASSOC);

        return $results;
    }
}





