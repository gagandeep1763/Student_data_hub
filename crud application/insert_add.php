<?php  
include('database.php');

if(isset($_POST['add_students'])){
    $f_name=$_POST['first_name'];
    $l_name=$_POST['last_name'];
    $age=$_POST['age'];

    $query = "INSERT INTO `students` (`first_name`, `last_name`, `age`) VALUES ('$f_name', '$l_name', '$age')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        header('Location: index.php?insert_msg=You added data successfully');
    }
}
    
?>