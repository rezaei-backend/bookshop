<?php 
require_once "../../functions/helpers.php";
require_once "../../functions/pdo.php";
if (checkmethod()) {
    $user_id=$_POST['user_id'];
    $book_id=$_POST['book_id'];
    $delivery_date=$_POST['delivery_date'];
    $return_date=$_POST['return_date'];
    $query="INSERT INTO `reservation` (`user_id`, `book_id`, `delivery_date`, `return_date`) VALUES (? , ? , ? , ?)";
    $stm=$conn->prepare($query);
    $stm->execute([$user_id , $book_id , $delivery_date , $return_date]);
     redirect("view/reservation/index.php");
    
}
else{
     redirect("view/reservation/index.php");
   
}

?>