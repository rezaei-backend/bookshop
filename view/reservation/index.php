<?php
include_once "../layouts/header.php";
?>
<!-- sidebar -->
<?php
include_once "../layouts/sidebar.php";
?>
<!-- end sidebar -->
<div class="col-12 col-md-9 col-lg-10 p-4" id="content">
    <h1 class="h4 mb-3">Reservations</h1>
    <div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addreservationmodal"><i
                class="bi bi-plus-lg me-1"></i>Add reservation</button>
    </div>
    <br>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book</th>
                            <th>User</th>
                            <th>Delivery date</th>
                            <th>Return date</th>
                            <th>Status</th>
                            <th>change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $reservations = $conn->query("SELECT * FROM `reservation`")->fetchAll();
                        foreach ($reservations as $reservation) {
                        ?>
                            <tr>
                                <td><?= $reservation['id'] ?></td>
                                <td><?= $reservation['book_id'] ?></td>
                                <td><?= $reservation['user_id'] ?></td>
                                <td><?= $reservation['delivery_date'] ?></td>
                                <td><?= $reservation['return_date'] ?></td>
                                <td>
                                    <?php
                                    if ($reservation['status'] == 1) {
                                    ?>
                                        <span class="badge bg-success">
                                            retunrned
                                        </span>
                                </td>
                            <?php
                                    } else {
                            ?>
                                <span class="badge bg-danger">
                                    Not retunrned
                                </span>
                            <?php
                                    }
                            ?>
                            <td><a class="btn btn-primary" href="<?=url_get("controllers/reservation/change.php" , $reservation['id']) ?>">change</a></td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addreservationmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= url("controllers/reservation/insert.php") ?>" class="row g-3" enctype="multipart/form-data">
                    <div class="col-md-3">
                        <label class="form-label">user</label>
                        <input type="text" name="user_id" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">book</label>
                        <input type="text" name="book_id" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Delivery date</label>
                        <input type="date" name="delivery_date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Return date</label>
                        <input type="date" name="return_date" class="form-control" required>
                    </div>
                    <!-- <div class="col-md-6">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" id="saveAddBook" value="save">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../layouts/footer.php";
?>