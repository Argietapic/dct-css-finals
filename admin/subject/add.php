<?php
include("../../functions.php");
$error_message = '';
guard();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $subjectCode = $_POST['subjectCode'] ?? '';
    $subjectName = $_POST['subjectName'] ?? '';
    $result =insertSubject($subjectCode, $subjectName);
    $error_message=$result;
}
$Pagetitle = "Add Subject";

include("../partials/header.php");
include("../partials/side-bar.php");
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">    

<div class="container ">
        <h2 class="text-left">Add a New Subject</h2>
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb" >
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Subject</li>
            </ol>
        </nav>
        <?php if ($error_message): ?>
                <?php echo $error_message; ?>
            <?php endif; ?>
        </main>