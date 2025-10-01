<?php

define("BASE_URL", "http://localhost/bookshop/");

function url($url){
    return trim(BASE_URL," /"). "/".trim ($url,"/");
}

function assets($path){
    return trim(BASE_URL," /"). "/public". "/".trim ($path,"/");
}

function dd($data){
    echo "<pre>";
var_dump($data);
    exit();
}
function redirect($url){
    $address=trim(BASE_URL," /"). "/".trim ($url," /");
    header("location: $address") ;
    exit();
}

function checkmethod(){
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        return true;
    }
    else{
        return false;
    }
}



?>