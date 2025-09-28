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
                                <td><img src="<?= assets('assets/img/books/') . "/" . $book['image'] ?>" class="rounded" width="40" height="40"
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
                                    }
                                    else{
                           ?>
                           <span class="badge bg-danger">Active</span>
                           <?php
                                        
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#editBookModal"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteBookModal"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
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
                    <form id="addBookForm" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Writer</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Genre</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Count</label>
                            <input type="number" class="form-control" value="1" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Row</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Image URL</label>
                            <input type="url" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveAddBook">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBookForm" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" value="The Great Book">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Writer</label>
                            <input type="text" class="form-control" value="John Doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Genre</label>
                            <input type="text" class="form-control" value="Fiction">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Count</label>
                            <input type="number" class="form-control" value="3" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Row</label>
                            <input type="text" class="form-control" value="A-12">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Image URL</label>
                            <input type="url" class="form-control" value="assets/img/placeholder.png">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveEditBook">Update</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete this book?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBook">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end content -->


<?php

include_once "../layouts/footer.php";
