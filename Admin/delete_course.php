<?php include '../conn.php'; ?>
<?php 
    $Cid = $_REQUEST['dlt_id'];
    $q = "DELETE from courses WHERE id=$Cid";
    if(mysqli_query($conn, $q)){
       header('Location: course_list.php');
    }

?>