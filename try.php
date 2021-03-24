<?php
function test($a){
    if($a>10){
        throw new Exception('عدد انتخاب شده نباید بیش از 10 باشد');
    }
}


try{
    test(4);
}catch (Exception $e){
    echo "متن خطا : ". $e->getMessage();
}
