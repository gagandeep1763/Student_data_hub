<?php
    include('header.php');
    include('database.php');

    // Fetch the student details
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Sanitize input
        $query = "SELECT * FROM `students` WHERE `id` = $id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        } else {
            $row = mysqli_fetch_assoc($result);
        }
    }

    // Update the student details
    if (isset($_POST['update_students'])) {

        if(isset($_GET['id'])){
            $idnew=$_GET['id'];
        }
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];

        $query = "UPDATE `students` SET `first_name`='$first_name', `last_name`='$last_name', `age`='$age' WHERE `id`=$id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        } else {
            header('Location: index.php?update_msg=You have successfully updated');
            exit();
        }
    }
?>

<form action="update_page1.php?id=<?php echo $id; ?>" method="post">
    <div class="mb-3">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstName" name="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastName" name="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($row['age']); ?>" required>
    </div>
    <div>
        <input type="submit" class="btn btn-success" name="update_students" value="Update">
    </div>
</form>

<?php include('footer.php'); ?>
