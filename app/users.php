<?php

include_once 'db.php';

class user extends db{
    protected $tbl='user_tbl';
    public function login($data){
        //var_dump($data);
        $this->setTbl($this->tbl);
        $res=$this->searchData('email',$data['email']);
        //var_dump($res->password);die;
        if($res->password==$data['password']){
            //var_dump($res->password);
            session_start();
            $_SESSION['user']=$res->name;
            header("location:dashboard.php");
        }
    }

    public function logout(){
        echo 'salam';
        session_destroy();
        header('location:index.php?logout=ok');
    }




}