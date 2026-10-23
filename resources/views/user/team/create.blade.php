<?php
$page_title = "Add New Team Member";
?>
 @include('user.include.header')

<body>
    <div class="wrapper active">
        <div class="page-content">
            <div class="page-container p-3">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card p-4">
                            <h4 class="mb-3">Add New Member</h4>

                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter member name">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter email">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-select">
                                        <option value="">Select Role</option>
                                        <option>Admin</option>
                                        <option>Manager</option>
                                        <option>Editor</option>
                                        <option>Viewer</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Permissions</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="view" id="viewPerm">
                                        <label class="form-check-label" for="viewPerm">View Data</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="edit" id="editPerm">
                                        <label class="form-check-label" for="editPerm">Edit Data</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="delete" id="deletePerm">
                                        <label class="form-check-label" for="deletePerm">Delete Data</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark">Save Member</button>
                                <a href="team.php" class="btn btn-outline-secondary ms-2">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
</body>
@include('user.include.footer')
