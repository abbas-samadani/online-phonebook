<?php

//$id=$_GET['id'];
$name="sara";
$lastname="rezai";
$email="sara@gmail.com";
$password="123";

$pdo=new PDO("mysql:host=localhost;dbname=phonebook","root","");
$sql=$pdo->prepare("insert into user_tbl (name,lastname,email,password) VALUES (:name,:lastname,:email,:password)");

$sql->bindParam("name",$name);
$sql->bindParam("lastname",$lastname);
$sql->bindParam("email",$email);
$sql->bindParam("password",$password);

$sql->execute();
/*
$sql->bindParam("id",$id,PDO::PARAM_INT);
$sql->execute();
$row=$sql->fetch(PDO::FETCH_OBJ);
var_dump($row);*/

