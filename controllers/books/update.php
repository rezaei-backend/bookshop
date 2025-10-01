<?php
require_once "../../functions/helpers.php";
require_once "../../functions/pdo.php";
$id = $_GET['id'];
if (checkmethod()) {
    $title = $_POST['title'];
    $count = $_POST['count'];
    $row = $_POST['row'];
    $writer = $_POST['writer'];
    $genre = $_POST['genre'];
    $status = $_POST['status'];
    $location = __DIR__ . "/../../public/books/";
    if (isset($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "$location" . $_FILES['image']['name']);
        $query = "UPDATE `books` SET  `title`=?,`image`=?,`count`=?,`row`=?,`writer`=?,`genre`=?,`status`=?  WHERE `id`='$id' ";
        $stm = $conn->prepare($query);
        $stm->execute([$title, $image, $count, $row, $writer, $genre, $status]);
        redirect("view/books/index.php");
    } else {
        $query = "UPDATE `books` SET  `title`=?,`count`=?,`row`=?,`writer`=?,`genre`=?,`status`=? WHERE `id`='$id' ";
        $stm = $conn->prepare($query);
        $stm->execute([$title, $count, $row, $writer, $genre, $status]);
        redirect("view/books/index.php");
    }
} else {
    redirect("view/books/index.php");
}
