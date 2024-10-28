<?php

header('Content-Type: application/json');

$aid = $_GET['aid'];

$conn = mysqli_connect("localhost","root","","repairdb");
if(!$conn){
    die("Connection failed:" . mysqli_connect_error());
}

// 查询订单数据
$sql = "SELECT * FROM tbl_admin where aid = $aid";
$res = mysqli_query($conn, $sql);

// 初始化一个数组用于保存订单数据
$repairMan = array();

//检查查询结果是否为空
if (mysqli_num_rows($res) > 0) {
    //遍历结果集，将每一行数据保存到数组中
    while ($row = mysqli_fetch_assoc($res)) {
        $repairMan[] = $row;
    }
}

// 将订单数据转换为 JSON 格式并输出
echo json_encode($repairMan);

//关闭连接
mysqli_close($conn);

?>