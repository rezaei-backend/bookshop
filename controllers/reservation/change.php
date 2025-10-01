<?php
require_once "../../functions/helpers.php";
require_once "../../functions/pdo.php";
$id = $_GET['id'];
if (isset($id)) {
    $reserv = $conn->query("SELECT `status` FROM `reservation` WHERE id = '$id'")->fetch();
    if ($reserv['status'] == 0) {
        $status = 1;
    } else {
        $status = 0;
    }
    $query = "UPDATE `reservation` SET  `status`=? WHERE `id`='$id' ";
    $stm = $conn->prepare($query);
    $stm->execute([$status]);

     redirect("view/reservation/index.php");

} else {
     redirect("view/reservation/index.php");

}
