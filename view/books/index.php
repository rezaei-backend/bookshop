<?php
include_once "../layouts/header.php";
?>
<!-- sidebar -->
<?php
include_once "../layouts/sidebar.php";
?>
<!-- end sidebar -->

<!-- content -->
<div class="col-12 col-md-9 col-lg-10 p-4" id="content">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Books</h1>
        <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal"><i
                    class="bi bi-plus-lg me-1"></i>Add Book</button>
        </div>
    </div>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Writer</th>
                            <th>Genre</th>
                            <th>Count</th>
                            <th>Row</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="books-table-body">
                        <?php
                        $books = $conn->query("SELECT * FROM books")->fetchAll();
                        foreach ($books as $book) {
                        ?>
                            <tr>
                                <td><img src="<?= assets('books/') . "/" . $book['image'] ?>" class="rounded" width="40" height="40"
                                        alt="cover"></td>
                                <td><?= $book['title'] ?></td>
                                <td><?= $book['writer'] ?></td>
                                <td><?= $book['genre'] ?></td>
                                <td><?= $book['count'] ?></td>
                                <td><?= $book['row'] ?></td>
                                <td>
                                    <?php
                                    if ($book['status'] === 1) {
                                    ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge bg-danger">Active</span>
                                    <?php

                                    }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#editBookModal<?= $book['id'] ?>"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteBookModal<?= $book['id'] ?>"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="deleteBookModal<?= $book['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Book</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-0">Are you sure you want to delete<?= $book['title'] ?> this book?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <a href="<?= url("controllers/books/delete.php?id=") . $book['id'] ?>" type="button" class="btn btn-danger" id="confirmDeleteBook">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="editBookModal<?= $book['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Book <?= $book['title'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="<?= url_get("controllers/books/update.php", $book['id']) ?>" class="row g-3" enctype="multipart/form-data">
                                                <div class="col-md-6">
                                                    <label class="form-label">Title</label>
                                                    <input name="title" value="<?= $book['title'] ?>" type="text" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Writer</label>
                                                    <input type="text" class="form-control" name="writer" value="<?= $book['writer'] ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Genre</label>
                                                    <input type="text" class="form-control" name="genre" value="<?= $book['genre'] ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Count</label>
                                                    <input type="number" class="form-control" name="count" value="<?= $book['count'] ?>" min="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Row</label>
                                                    <input name="row" type="text" class="form-control" value="<?= $book['row'] ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="1" selected>Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <input type="submit" value="save" class="btn btn-primary" id="saveEditBook">
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= url("controllers/books/insertbook.php") ?>" class="row g-3" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Writer</label>
                            <input type="text" name="writer" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Genre</label>
                            <input type="text" name="genre" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Count</label>
                            <input type="number" name="count" class="form-control" value="1" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Row</label>
                            <input type="text" name="row" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" id="saveAddBook" value="save">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- end content -->
<?php
include_once "../layouts/footer.php";
