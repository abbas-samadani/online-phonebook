<?php

$stu=array('a','sd','wret','2131','asdfqwer');
/*$student="ssss";
echo is_array($student);*/

/*$str = "asd asdf a sdf asd afqwertwerg wer twetr we tr wertw";
$array=explode(" ",$str);
var_dump($array);*/
var_dump($stu);
$newstu="'".implode("','",$stu)."'";
echo $newstu;
/*
$data=array("alireza",28,"rezai","aaaaaa","as$asd3");
mysqli_query("INSERT INTO users (name) VALUES ($data[0],)");*/