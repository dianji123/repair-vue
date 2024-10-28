<?php
$username = $_POST['username'];

$conn = mysqli_connect("localhost", "root", "", "repairdb");

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}

$sql = "select * from tbl_admin where username = '$username' ";
mysqli_query($conn, "set names utf8");
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

$rdata = array();
if($count > 0){
$rdata['code'] = 2;
$rdata['msg'] = "用户名已被使用！";
}else{
    $rdata['code'] = 1;
    $rdata['msg'] = "用户名可用";
}
echo json_encode($rdata);

?>