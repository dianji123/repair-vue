<?php

header('Content-Type: application/json');

// 获取请求体中的 JSON 数据
$json_data = file_get_contents('php://input');

// 将 JSON 数据解析为 PHP 数组
$data = json_decode($json_data, true);

$username = $data['username'];
$realname = $data['realname'];
$phone_num = $data['phone_num'];
$aid = $data['aid'];

$conn = mysqli_connect("localhost","root","","repairdb");
if(!$conn){
    die("Connection failed:" . mysqli_connect_error());
}

$sql = "UPDATE tbl_admin SET username = '$username',realname= '$realname',phone_num= '$phone_num' WHERE aid='$aid' ";

$result = mysqli_query($conn, $sql);
// 初始化一个数组用于保存数据
$rdata = array();

//检查查询结果是否为空
if($result > 0){
    $rdata['code'] = 1;
    $rdata['msg'] = "操作成功";
    }else{
        $rdata['code'] = 0;
        $rdata['msg'] = $sql . mysqli_error($conn);
    }

// 将订单数据转换为 JSON 格式并输出
echo json_encode($rdata);

//关闭连接
mysqli_close($conn);

?>