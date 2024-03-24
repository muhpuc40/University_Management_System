<?php include '../conn.php'; ?>
<?php 
    $id = $_REQUEST["dlt_id"];
    $str = "DELETE from sessions WHERE id=$id";
    if(mysqli_query($conn, $str)){
       header('Location: session_list.php');
    }

?>