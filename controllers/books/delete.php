<?php 
require_once "../../functions/helpers.php";
require_once "../../functions/pdo.php";
$id=$_GET['id'];
if (isset($id) ) {
    $query="DELETE FROM `books` WHERE id = ? ";
    $stm=$conn->prepare($query);
    $stm->execute([$id]);
     redirect("view/books/index.php");
}
else{
     redirect("view/books/index.php");

}