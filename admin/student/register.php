<?php

$Pagetitle = "Register Student";
include("../partials/header.php");
include("../partials/side-bar.php");
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">    
<div class="container">
    <h2>Register a New Student</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Register Student</li>
        </ol>
    </nav>

   
    <?php if (!empty($message)): ?>
        <div class="alert <?php echo (strpos($message, 'successfully') !== false) ? 'alert-info' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
   
    <div class="card">
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="studentId" name="studentId" placeholder="Enter Student ID" maxlength="4">
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" >
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" >
                </div>
                <button type="submit" class="btn btn-primary">Add Student</button>
            </form>
        </div>
    </div>
   
    <div class="card mt-4">
        <div class="card-header">Student List</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Student ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>      
             </table>
            </div>
        </div>
    </div>
</div>
</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php 
include("../partials/footer.php");
?>