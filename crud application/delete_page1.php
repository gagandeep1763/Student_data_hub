<?php
    include('header.php');
    include('database.php');

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Sanitize input
        $query = "DELETE FROM `students` WHERE `id` = '$id'"; // Use correct syntax with backticks
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        } else {
            header('Location: index.php?delete_msg=You have successfully deleted the record'); // Corrected message
            exit();
        }
    }
?>

<?php include('footer.php'); ?>
