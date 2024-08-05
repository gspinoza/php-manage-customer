<?php
include 'templates/actionDropdown.php';
include 'templates/createModal.php';
include 'templates/readModal.php';
include 'templates/updateModal.php';
include 'templates/deleteModal.php';

$updateModalOpen = isset($_POST['updateModal']) && $_POST['updateModal'] === 'open';
$readModalOpen = isset($_POST['readModal']) && $_POST['readModal'] === 'open';
$deleteModalOpen = isset($_POST['deleteModal']) && $_POST['deleteModal'] === 'open';

$selected = isset($_POST['selected']) ? $_POST['selected'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body class="h-screen bg-gradient-to-b from-gray-100 to-gray-300">

<?php include 'templates/header.php'; ?>

<div class='bg-white flex min-h-screen items-center justify-center'>
    <div class="container my-10 min-h-screen">
        <section class="bg-gray-50 dark:bg-gray-900 sm:p-5 antialiased rounded-lg">
            <div>
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/2">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Customers</h3>
                        </div>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <?php renderCreateModal();?>
                        </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <?php include 'templates/customerTableList.php';?>
                    </div>
                </div>
            </div>
        </section>
        <?php
            if (isset($_GET['message'])) {
                $message = htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8');
                echo "<script type='text/javascript'>
                        alert('$message');
                        window.location.href = 'index.php';
                    </script>";
            }
        ?>

    <!-- Update modal -->
    <?php renderUpdateModal($selected, $updateModalOpen);?>

    <!-- Read modal -->
    <?php renderReadModal($selected, $readModalOpen);?>

    <!-- Delete modal -->
    <?php renderDeleteModal($selected, $deleteModalOpen);?>

    </div>
</div>
  <?php include 'templates/footer.php'; ?>
</body>
</html>