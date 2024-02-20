<?php include '../conn.php'; ?>
<?php 
    $Tid = $_REQUEST['dlt_id'];
    $str = "DELETE from teacher_login WHERE id=$Tid";
    if(mysqli_query($conn, $str)){
       header('Location: teacher_list.php');
    }

?>