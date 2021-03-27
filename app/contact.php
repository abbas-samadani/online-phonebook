<?php
include_once 'db.php';

class Contact extends db
{
    protected $tbl='contact_tbl';
    public function addContact($data){
        $this->setTbl($this->tbl);
        $field=array_keys($data);
        $this->insertData($field,$data);

    }

    public function listContact(){
        $this->setTbl($this->tbl);
        $res=$this->selectData();
        return $res;
    }

    public function deleteContact($id){
        $this->setTbl($this->tbl);
        $this->deleteData($id);

    }


}