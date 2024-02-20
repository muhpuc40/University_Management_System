<?php
include '../conn.php';
$cat = $_REQUEST['cat'];

$q = "SELECT * from courses";
$result = mysqli_query($conn, $q);
$data = [];
while($row = mysqli_fetch_array($result)){
    $data[] = $row;
}
echo json_encode($data);

?>