<?php 
require_once "../../functions/helpers.php";
require_once "../../functions/pdo.php";
if (checkmethod()) {
    $title=$_POST['title'];
    $image= $_FILES['image']['name'];
    $count=$_POST['count'];
    $row=$_POST['row'];
    $writer=$_POST['writer'];
    $genre=$_POST['genre'];
    $status=$_POST['status'];
    $location = __DIR__ . "/../../public/books/";
    move_uploaded_file($_FILES['image']['tmp_name'] , "$location".$_FILES['image']['name']);
    $query="INSERT INTO `books` (`title`, `image`, `count`, `row`, `writer`, `genre`, `status`) VALUES (? , ? , ? , ? , ? , ? , ?)";
    $stm=$conn->prepare($query);
    $stm->execute([$title , $image , $count , $row , $writer , $genre , $status ]);
     redirect("view/books/index.php");
    
}
else{
     redirect("view/books/index.php");
   
}

?>