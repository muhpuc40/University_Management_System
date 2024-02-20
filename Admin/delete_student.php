<?php include '../conn.php'; ?>
<?php 
    $id = $_REQUEST["dlt_id"];
    $str = "DELETE from student_login WHERE id=$id";
    if(mysqli_query($conn, $str)){
       header('Location: student_list.php');
    }

?>