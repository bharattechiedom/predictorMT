<?php
$page_title = "Edit Team Member";
?>

@include('user.include.header')
<body>
    <div class="wrapper active">
        <div class="page-content">
            <div class="page-container p-3">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card p-4">
                            <h4 class="mb-3">Edit Member Details</h4>

                            <form>
                                <!-- Full Name -->
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" value="Pankaj Kumar">
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" value="pankaj@example.com">
                                </div>

                                <!-- Role -->
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-select">
                                        <option>Admin</option>
                                        <option selected>Manager</option>
                                        <option>Editor</option>
                                        <option>Viewer</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select">
                                        <option selected>Active</option>
                                        <option>Inactive</option>
                                        <option>Pending</option>
                                    </select>
                                </div>

                                <!-- Permissions -->
                                <div class="mb-3">
                                    <label class="form-label">Permissions</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permView" checked>
                                        <label class="form-check-label" for="permView">View Data</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permEdit" checked>
                                        <label class="form-check-label" for="permEdit">Edit Data</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permDelete">
                                        <label class="form-check-label" for="permDelete">Delete Data</label>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <button type="submit" class="btn btn-dark">
                                    <i class="bi bi-save me-1"></i> Update Member
                                </button>
                                <a href="index.php" class="btn btn-outline-secondary ms-2">
                                    <i class="bi bi-arrow-left me-1"></i> Back to List
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>

@include('user.include.footer')